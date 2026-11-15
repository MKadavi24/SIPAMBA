
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Monitoring SIPAMBA</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 9px;
            color: #222;
        }

        .header {
            text-align: center;
            margin-bottom: 18px;
        }

        .header h2 {
            margin-bottom: 5px;
            font-size: 16px;
        }

        .header p {
            margin: 3px 0;
        }

        .info {
            margin-bottom: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #555;
            padding: 6px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background-color: #e5e7eb;
            text-align: center;
        }

        .footer {
            margin-top: 15px;
            text-align: right;
            font-size: 9px;
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>LAPORAN MONITORING PEMBANGUNAN</h2>
        <h3>SIPAMBA</h3>
        <p>Sistem Informasi Pengawasan dan Monitoring Pembangunan</p>
        <hr>
    </div>

    <div class="info">
        <strong>Tanggal Cetak:</strong>
        {{ now()->format('d-m-Y H:i') }}
        <br>
        <strong>Total Laporan:</strong>
        {{ $laporan->count() }} laporan
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pembangunan</th>
                <th>Tanggal Laporan</th>
                <th>Periode</th>
                <th>Sumber Informasi</th>
                <th>Ringkasan</th>
                <th>Progres Dilaporkan</th>
                <th>Status Tindak Lanjut</th>
            </tr>
        </thead>

        <tbody>
            @forelse($laporan as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->pembangunan->nama_pembangunan ?? '-' }}</td>
                    <td>{{ $item->tanggal_laporan }}</td>
                    <td>{{ $item->periode_laporan ?? '-' }}</td>
                    <td>{{ $item->sumber_informasi }}</td>
                    <td>{{ $item->ringkasan }}</td>
                    <td>
                        {{ $item->progres_dilaporkan !== null
                            ? $item->progres_dilaporkan . '%'
                            : '-' }}
                    </td>
                    <td>{{ $item->status_tindak_lanjut }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align:center;">
                        Belum ada laporan monitoring.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Dicetak melalui Sistem SIPAMBA
    </div>

</body>
</html>
