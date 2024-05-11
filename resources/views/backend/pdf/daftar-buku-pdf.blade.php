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

      /* .foto {
        float: right;
        height: auto;
        width: auto;
        top: 100px;
      } */

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
    {{-- <div class="container">
      <img src="{{ public_path('Backend/assets/img/logo-perpus.png') }}" alt="" class="foto">
    </div> --}}
    <h1>Daftar Buku </h1>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">NO</th>
            <th scope="col">Kode Buku</th>
            <th scope="col">Judul</th>
            <th scope="col">Pengarang</th>
            <th scope="col">Penerbit</th>
            <th scope="col">Kategori</th>
            <th scope="col">Tanggal Terbit</th>
          </tr>
        </thead>
        <tbody>
          @php( $ids = 1 )
          @foreach ( $daftarBuku as $db)
          @csrf
          <tr>
            <td scope="row">{{ $ids ++ }}</td>
            <td>{{ $db->kode_buku }}</td>
            <td>{{ $db->judul }}</td>
            <td>{{ $db->pengarang }}</td>
            <td>{{ $db->penerbit }}</td>
            <td>{{ $db->kategoriBuku->name }}</td>
            <td>{{ Carbon\Carbon::parse($db->tanggal_terbit)->format('d-m-Y') }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
</body>
</html>
