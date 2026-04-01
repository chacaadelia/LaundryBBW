<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data Member</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
            vertical-align: middle; /* Agar foto berada di tengah vertikal */
        }
        th {
            background-color: #f2f2f2;
            text-align: center;
        }
        .foto-siswa {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 50%; /* Opsional: membuat foto bulat */
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>Laporan Data Member</h2>
        <p>Data Member</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%">No</th>
                <th>Nama Member</th>
                <th>No Telepon</th>
            </tr>
        </thead>
        <tbody>
            @foreach($members as $index => $member)
            <tr>
                <td style="text-align: center;">{{ $index + 1 }}</td>
                        {{-- Gunakan public_path agar DOMPDF bisa membaca file lokal --}}
                        {{-- Asumsi kamu menyimpan file di folder public/storage/fotos atau sejenisnya --}}
                <td>{{ $member->nama_member }}</td>
                <td>{{ $member->no_telepon }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html