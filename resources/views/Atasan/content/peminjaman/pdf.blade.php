<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Cetak Daftar Peminjaman</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 20px;
            color: #333;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            font-size: 14px;
        }

        table th,
        table td {
            border: 1px solid #444;
            padding: 8px;
            text-align: left;
        }

        table th {
            background-color: #04AA6D;
            color: white;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        /* Agar rapi saat cetak */
        @media print {
            body {
                margin: 0;
            }

            h2 {
                margin: 10px 0;
            }

            table {
                page-break-inside: auto;
            }

            tr {
                page-break-inside: avoid;
                page-break-after: auto;
            }
        }
    </style>
</head>

<body>

    <h2>Daftar Peminjaman</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Detail Kegiatan</th>
                <th>Peminjam</th>
                <th>Barang</th>
                <th>Jumlah</th>
                <th>Tanggal Peminjaman</th>
                <th>Batas Peminjaman</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @php $no=1; @endphp
            @foreach($data as $row)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $row->detail_kegiatan}}</td>
                <td>{{ $row->pengguna}}</td>
                <td>{{ $row->barang }}</td>
                <td>{{ $row->jumlah_pinjam}}</td>
                <td>{{ $row->tgl_peminjaman}}</td>
                <td>{{ $row->batas_peminjaman}}</td>
                <td>{{ $row->keterangan}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>