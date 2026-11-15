
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Data Pembangunan SIPAMBA</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            color: #222;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            margin-bottom: 5px;
            font-size: 17px;
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
        <h2>LAPORAN DATA PEMBANGUNAN</h2>
        <h3>SIPAMBA</h3>
        <p>Sistem Informasi Pengawasan dan Monitoring Pembangunan</p>
        <hr>
    </div>

    <div class="info">
        <strong>Tanggal Cetak:</strong>
        {{ now()->format('d-m-Y H:i') }}
        <br>
        <strong>Total Data:</strong>
        {{ $pembangunans->count() }} data
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pembangunan</th>
                <th>Kategori</th>
                <th>Lokasi</th>
                <th>Tahun Anggaran</th>
                <th>Instansi Pelaksana</th>
                <th>Sumber Informasi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($pembangunans as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->nama_pembangunan }}</td>
                    <td>{{ $item->kategori }}</td>
                    <td>{{ $item->lokasi }}</td>
                    <td>{{ $item->tahun_anggaran }}</td>
                    <td>{{ $item->instansi_pelaksana }}</td>
                    <td>{{ $item->sumber_informasi }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align:center;">
                        Belum ada data pembangunan.
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
