<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $startInput = $request->input('start_date');
        $endInput = $request->input('end_date');

        // Izinkan input tanggal dalam format dd/mm/yyyy atau yyyy-mm-dd
        $startDate = $this->normalizeDate($startInput);
        $endDate = $this->normalizeDate($endInput);

        // Ambil semua data terlebih dahulu, lalu filter di level koleksi
        // agar perhitungan tabel, total, dan grafik selalu sinkron.
        $allSales = Sale::orderBy('sale_date')->get();

        $sales = $allSales->filter(function (Sale $sale) use ($startDate, $endDate) {
            $date = $sale->sale_date->format('Y-m-d');

            if ($startDate && $endDate) {
                return $date >= $startDate && $date <= $endDate;
            } elseif ($startDate) {
                return $date === $startDate;
            } elseif ($endDate) {
                return $date <= $endDate;
            }

            // Jika tidak ada filter, tampilkan semua
            return true;
        })->values();

        // Total penjualan = jumlah * harga
        $totalSales = $sales->reduce(function ($carry, Sale $sale) {
            return $carry + ($sale->quantity * $sale->price);
        }, 0);

        // Data untuk Chart.js: total per tanggal
        $chartData = $sales
            ->groupBy(fn (Sale $sale) => $sale->sale_date->format('Y-m-d'))
            ->map(function ($items, $date) {
                $total = $items->reduce(function ($carry, Sale $sale) {
                    return $carry + ($sale->quantity * $sale->price);
                }, 0);

                return [
                    'date' => $date,
                    'total' => $total,
                ];
            })
            ->values();

        $chartLabelsRaw = $chartData->pluck('date');
        $chartValues = $chartData->pluck('total');

        // Tampilkan label tanggal grafik sebagai yyyy/mm/dd
        $chartLabels = $chartLabelsRaw->map(function (string $date) {
            try {
                return Carbon::createFromFormat('Y-m-d', $date)->format('Y/m/d');
            } catch (\Throwable $e) {
                return $date;
            }
        });

        return view('dashboard', [
            'sales' => $sales,
            'totalSales' => $totalSales,
            // Kirim kembali nilai asli dari input agar tetap muncul di form
            'startDate' => $startInput,
            'endDate' => $endInput,
            'chartLabels' => $chartLabels,
            'chartValues' => $chartValues,
        ]);
    }

    /**
     * Menerima string tanggal dari form dan mengubah ke format yyyy-mm-dd.
     * Format input yang digunakan di form: yyyy/mm/dd.
     */
    private function normalizeDate(?string $value): ?string
    {
        $value = $value !== null ? trim($value) : null;

        if (empty($value)) {
            return null;
        }

        try {
            // Jika ada tanda '/', anggap format yyyy/mm/dd (tahun/bulan/hari)
            if (str_contains($value, '/')) {
                $parts = explode('/', $value);

                if (count($parts) === 3) {
                    [$year, $month, $day] = array_map('trim', $parts);

                    if (ctype_digit($day) && ctype_digit($month) && ctype_digit($year)) {
                        return sprintf('%04d-%02d-%02d', (int) $year, (int) $month, (int) $day);
                    }
                }
            }

            // Fallback ke format standar (yyyy-mm-dd) bila user mengetik manual
            return Carbon::parse($value)->format('Y-m-d');
        } catch (\Throwable $e) {
            return null;
        }
    }
}


