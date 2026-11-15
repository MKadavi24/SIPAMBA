
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Riwayat Pengawasan SIPAMBA</title>

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
        <h2>LAPORAN RIWAYAT PENGAWASAN</h2>
        <h3>SIPAMBA</h3>
        <p>Sistem Informasi Pengawasan dan Monitoring Pembangunan</p>
        <hr>
    </div>

    <div class="info">
        <strong>Tanggal Cetak:</strong>
        {{ now()->format('d-m-Y H:i') }}
        <br>
        <strong>Total Riwayat:</strong>
        {{ $riwayat->count() }} data
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pembangunan</th>
                <th>Tanggal Tindak Lanjut</th>
                <th>Status</th>
                <th>Catatan</th>
                <th>Sumber Informasi</th>
                <th>Petugas Pencatat</th>
            </tr>
        </thead>

        <tbody>
            @forelse($riwayat as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        {{ $item->laporanMonitoring->pembangunan->nama_pembangunan ?? '-' }}
                    </td>
                    <td>{{ $item->tanggal_tindak_lanjut }}</td>
                    <td>{{ $item->status }}</td>
                    <td>{{ $item->catatan }}</td>
                    <td>{{ $item->sumber_informasi ?? '-' }}</td>
                    <td>{{ $item->user->name ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align:center;">
                        Belum ada riwayat pengawasan.
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
