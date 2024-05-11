<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF</title>
    <style>
        h1 {
          text-transform: uppercase;
          text-align: center;
        }

        table {
          border-collapse: collapse;
          width: 100%;
        }

        th, td {
          text-align: left;
          padding: 8px;
        }

        tr:nth-child(even){background-color: rgb(241, 241, 241)}

        th {
          background-color: #ac6ccb;
          color: white;
        }

      </style>
</head>
<body>
    <h1>Anggota Pengunjung</h1>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">NO</th>
            <th scope="col">Nama</th>
            <th scope="col">Username</th>
            <th scope="col">Kelas</th>
          </tr>
        </thead>
        <tbody>
          @php( $ids = 1 )
          @foreach ( $anggotaPengunjung as $aP)
          @csrf
          <tr>
            <td scope="row">{{ $ids ++ }}</td>
            <td>{{ $aP->name }}</td>
            <td>{{ $aP->username }}</td>
            <td>{{ $aP->kelas->name}}</td>
            <td>{{ $aP->password}}</td>
          </tr>
          @endforeach
        </tbody>
    </table>
</body>
</html>
