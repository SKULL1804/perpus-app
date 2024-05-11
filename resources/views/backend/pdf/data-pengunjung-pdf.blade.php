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
</head>
<body>
    <h1>Daftar Buku </h1>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">NO</th>
            <th scope="col">Nama</th>
            <th scope="col">Kelas</th>
          </tr>
        </thead>
        <tbody>
          @php( $ids = 1 )
          @foreach ( $dataPengunjung as $dP)
          @csrf
          <tr>
            <td scope="row">{{ $ids ++ }}</td>
            <td>{{ $dP->name }}</td>
            <td>{{ $dP->kelas->name}}</td>
          </tr>
          @endforeach
        </tbody>
    </table>
</body>
</html>
