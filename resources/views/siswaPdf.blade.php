<!DOCTYPE html>
<html lang="en">
  {{-- For managing css --}}
  <head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Data Alumni</title>
  </head>
  <body>
    <style>
      .pagination {
        justify-content: center;
      }
      .avtr-img {
        width: 5rem;
        margin-right: .35rem;
        margin-bottom: .35rem;
      }
    </style>
    <h1 class="text-center my-4">Data Alumni</h1>
    <!-- Create a table -->
    <div class="container">
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th class="col-auto">No.</th>
              <th class="col-auto">Nama</th>
              <th class="col-auto">NIK</th>
              <th class="col-auto">Tanggal Lahir</th>
              <th class="col-auto">Jurusan</th>
              <th class="col-auto">Angkatan</th>
              <th class="col-auto">Alamat</th>
            </tr>
          </thead>
          <tbody>
            @if (count($siswas) > 0)
              @foreach($siswas as $s)
              <tr>
                <td class="col-auto">{{ $loop->iteration }}</td>
                <td class="col-auto">{{ $s->nama }}</td>
                <td class="col-auto">{{ $s->nik }}</td>
                <td class="col-auto">
                  @if (isset($s->tgl_lahir))
                    {{ $s->tgl_lahir }}
                  @else
                    Empty
                  @endif
                </td>
                <td class="col-auto">{{ $s->jurusan }}</td>
                <td class="col-auto">{{ $s->angkatan }}</td>
                <td class="col-auto">{{ $s->alamat }}</td>
              </tr>
              @endforeach
            @else
              <tr>
                <td colspan="8" class="text-center">No data found</td>
              </tr>
            @endif
          </tbody>
        </table>
      </div>
    </div>
    {{-- For managing js --}}
    @include('layout.js')
  </body>
</html>