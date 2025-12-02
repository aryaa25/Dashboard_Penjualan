<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Penjualan</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            margin: 0;
            font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
            background: #0f172a;
            color: #0f172a;
        }
        .page {
            min-height: 100vh;
            padding: 24px;
            background: radial-gradient(circle at top left, #1d4ed8 0, #020617 50%, #020617 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .container {
            width: 100%;
            max-width: 1100px;
            background: #0b1220;
            border-radius: 18px;
            padding: 24px 24px 28px;
            box-shadow:
                0 24px 60px rgba(15,23,42,0.9),
                0 0 0 1px rgba(148,163,184,0.15);
            border: 1px solid rgba(148,163,184,0.25);
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 16px;
            margin-bottom: 20px;
        }
        .title {
            color: #e5e7eb;
            font-size: 22px;
            font-weight: 600;
            letter-spacing: -0.02em;
        }
        .subtitle {
            color: #9ca3af;
            font-size: 13px;
        }
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 10px;
            border-radius: 999px;
            background: rgba(15,118,110,0.18);
            color: #6ee7b7;
            font-size: 11px;
            font-weight: 500;
            border: 1px solid rgba(16,185,129,0.25);
        }
        .badge-dot {
            width: 7px;
            height: 7px;
            border-radius: 999px;
            background: #6ee7b7;
            box-shadow: 0 0 0 4px rgba(45,212,191,0.25);
        }
        .grid {
            display: grid;
            grid-template-columns: 1.3fr 1fr;
            gap: 18px;
        }
        @media (max-width: 900px) {
            .grid {
                grid-template-columns: 1fr;
            }
        }
        .card {
            background: radial-gradient(circle at top, rgba(59,130,246,0.18), rgba(15,23,42,0.95));
            border-radius: 16px;
            padding: 16px 16px 14px;
            border: 1px solid rgba(148,163,184,0.25);
        }
        .card--right {
            background: radial-gradient(circle at top, rgba(52,211,153,0.12), rgba(15,23,42,0.95));
        }
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }
        .card-title {
            font-size: 14px;
            font-weight: 500;
            color: #d1d5db;
        }
        .card-subtitle {
            font-size: 11px;
            color: #9ca3af;
        }
        .total-value {
            font-size: 24px;
            font-weight: 600;
            color: #f9fafb;
            letter-spacing: -0.03em;
        }
        .total-helper {
            font-size: 11px;
            color: #9ca3af;
            margin-top: 2px;
        }
        .filters {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
        }
        .filters form {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            align-items: center;
        }
        .field-group {
            display: flex;
            flex-direction: column;
            gap: 3px;
        }
        .field-label {
            font-size: 11px;
            color: #9ca3af;
        }
        .field-input {
            background: rgba(15,23,42,0.9);
            border-radius: 999px;
            border: 1px solid rgba(55,65,81,0.9);
            padding: 5px 10px;
            color: #e5e7eb;
            font-size: 12px;
            min-width: 130px;
        }
        .field-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 1px rgba(59,130,246,0.5);
        }
        .btn {
            border-radius: 999px;
            border: none;
            padding: 7px 14px;
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.15s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .btn-primary {
            background: linear-gradient(to right, #2563eb, #4f46e5);
            color: white;
            box-shadow:
                0 12px 25px rgba(37,99,235,0.55),
                0 0 0 1px rgba(129,140,248,0.4);
        }
        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow:
                0 18px 35px rgba(37,99,235,0.65),
                0 0 0 1px rgba(129,140,248,0.7);
        }
        .btn-ghost {
            background: rgba(15,23,42,0.9);
            color: #e5e7eb;
            border: 1px solid rgba(75,85,99,0.9);
        }
        .btn-ghost:hover {
            background: rgba(31,41,55,1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }
        thead {
            background: linear-gradient(to right, rgba(15,23,42,0.95), rgba(30,64,175,0.85));
        }
        th, td {
            padding: 8px 10px;
            text-align: left;
            white-space: nowrap;
        }
        th {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #9ca3af;
            border-bottom: 1px solid rgba(55,65,81,0.9);
        }
        tbody tr:nth-child(even) {
            background: rgba(15,23,42,0.9);
        }
        tbody tr:nth-child(odd) {
            background: rgba(15,23,42,0.75);
        }
        td {
            color: #e5e7eb;
            border-bottom: 1px solid rgba(30,41,59,0.9);
        }
        .text-right {
            text-align: right;
        }
        .text-muted {
            color: #9ca3af;
        }
        .pill {
            display: inline-flex;
            align-items: center;
            padding: 3px 9px;
            border-radius: 999px;
            font-size: 11px;
            background: rgba(30,64,175,0.5);
            color: #bfdbfe;
        }
        .chart-wrapper {
            margin-top: 6px;
            padding-top: 6px;
            border-top: 1px dashed rgba(75,85,99,0.85);
        }
        .chart-canvas {
            width: 100%;
            height: 210px;
        }
        .empty {
            padding: 20px;
            text-align: center;
            color: #9ca3af;
            font-size: 13px;
        }
        .footer {
            margin-top: 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 11px;
            color: #6b7280;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<div class="page">
    <div class="container">
        <div class="header">
            <div>
                <div class="badge">
                    <span class="badge-dot"></span>
                    Realtime Sales Snapshot
                </div>
                <h1 class="title">Dashboard Penjualan</h1>
                <p class="subtitle">
                    Ringkasan performa penjualan berdasarkan data transaksi yang tersimpan di database.
                </p>
            </div>
            <div class="filters">
                <form method="GET" action="{{ route('dashboard') }}">
                    <div class="field-group">
                        <label class="field-label" for="start_date">Tanggal mulai (yyyy/mm/dd)</label>
                        <input
                            id="start_date"
                            type="text"
                            name="start_date"
                            class="field-input"
                            placeholder="yyyy/mm/dd"
                            inputmode="numeric"
                            pattern="\d{4}/\d{2}/\d{2}"
                            value="{{ $startDate }}"
                        >
                    </div>
                    <div class="field-group">
                        <label class="field-label" for="end_date">Tanggal akhir (yyyy/mm/dd)</label>
                        <input
                            id="end_date"
                            type="text"
                            name="end_date"
                            class="field-input"
                            placeholder="yyyy/mm/dd"
                            inputmode="numeric"
                            pattern="\d{4}/\d{2}/\d{2}"
                            value="{{ $endDate }}"
                        >
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Terapkan filter
                    </button>
                    <a href="{{ route('dashboard') }}" class="btn btn-ghost">
                        Reset
                    </a>
                </form>
            </div>
        </div>

        <div class="grid">
            <!-- Tabel Penjualan -->
            <div class="card">
                <div class="card-header">
                    <div>
                        <div class="card-title">Data Penjualan</div>
                        <div class="card-subtitle">
                            Menampilkan {{ $sales->count() }} transaksi
                            @if($startDate || $endDate)
                                <span class="pill">
                                    Filter:
                                    @if($startDate) {{ $startDate }} @else - @endif
                                    &nbsp;&rarr;&nbsp;
                                    @if($endDate) {{ $endDate }} @else - @endif
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                @if($sales->count() === 0)
                    <div class="empty">
                        Tidak ada data penjualan untuk rentang tanggal yang dipilih.
                    </div>
                @else
                    <div style="overflow-x:auto; border-radius: 10px; border: 1px solid rgba(31,41,55,0.9);">
                        <table>
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Produk</th>
                                <th>Tanggal Penjualan</th>
                                <th class="text-right">Jumlah</th>
                                <th class="text-right">Harga (Rp)</th>
                                <th class="text-right">Subtotal (Rp)</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sales as $index => $sale)
                                <tr>
                                    <td class="text-muted">{{ $index + 1 }}</td>
                                    <td>{{ $sale->product_name }}</td>
                                    <td class="text-muted">{{ $sale->sale_date->format('Y/m/d') }}</td>
                                    <td class="text-right">{{ $sale->quantity }}</td>
                                    <td class="text-right">{{ number_format($sale->price, 0, ',', '.') }}</td>
                                    <td class="text-right">
                                        {{ number_format($sale->quantity * $sale->price, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            <!-- Ringkasan & Grafik -->
            <div class="card card--right">
                <div class="card-header">
                    <div>
                        <div class="card-title">Total Penjualan</div>
                        <div class="card-subtitle">Akumulasi nilai transaksi pada periode terpilih</div>
                    </div>
                </div>
                <div>
                    <div class="total-value">
                        Rp {{ number_format($totalSales, 0, ',', '.') }}
                    </div>
                    <div class="total-helper">
                        Dihitung dari {{ $sales->count() }} transaksi<br>
                        (rumus: jumlah × harga per baris)
                    </div>
                </div>

                <div class="chart-wrapper">
                    <div class="card-title" style="margin-bottom: 2px;">Grafik Tren Penjualan</div>
                    <div class="card-subtitle">Total penjualan per tanggal (Rp)</div>
                    <div class="chart-canvas">
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer">
            <span>Data sumber: tabel <code style="color:#e5e7eb;">sales</code> di database MySQL.</span>
            <span>Laravel Dashboard Penjualan · {{ now()->format('Y') }}</span>
        </div>
    </div>
</div>

<script>
    const labels = @json($chartLabels);
    const values = @json($chartValues);

    if (labels.length > 0) {
        const ctx = document.getElementById('salesChart').getContext('2d');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels,
                datasets: [{
                    label: 'Total Penjualan',
                    data: values,
                    borderColor: 'rgba(59,130,246,1)',
                    backgroundColor: 'rgba(59,130,246,0.2)',
                    tension: 0.35,
                    fill: true,
                    pointRadius: 4,
                    pointBackgroundColor: 'rgba(59,130,246,1)',
                    pointBorderColor: '#0b1120',
                    pointHoverRadius: 5,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        grid: {
                            display: false,
                        },
                        ticks: {
                            color: '#9ca3af',
                            font: { size: 11 },
                        }
                    },
                    y: {
                        grid: {
                            color: 'rgba(31,41,55,0.9)',
                        },
                        ticks: {
                            color: '#9ca3af',
                            font: { size: 11 },
                            callback: function (value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            color: '#e5e7eb',
                            font: { size: 11 }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                const value = context.parsed.y || 0;
                                return 'Total: Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });
    } else {
        const canvas = document.getElementById('salesChart');
        if (canvas) {
            const ctx = canvas.getContext('2d');
            ctx.fillStyle = '#9ca3af';
            ctx.font = '12px Inter, system-ui';
            ctx.textAlign = 'center';
            ctx.fillText('Tidak ada data untuk ditampilkan.', canvas.width / 2, canvas.height / 2);
        }
    }
</script>
</body>
</html>

