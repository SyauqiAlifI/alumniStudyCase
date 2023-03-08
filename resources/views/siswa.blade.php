<!DOCTYPE html>
<html lang="en">
  {{-- For managing css --}}
  @include('layout.css')
  <body>
    <h1 class="text-center my-4">Data Alumni</h1>
    <div class="w-100 container px-2 mb-4">
      @if (session('success'))
        <div class="alert alert-success">
          <p class="text-center m-0">{{ session('success') }}</p>
        </div>
      @endif
      @if (session('error'))
        <div class="alert alert-success">
          <p class="text-center m-0">{{ session('error') }}</p>
        </div>
      @endif
    </div>
    <!-- Create a table -->
    <div class="container">  
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-outline-success mx-auto" data-bs-toggle="modal" data-bs-target="#create-modal">
        Create
      </button>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>No.</th>
              <th>Nama</th>
              <th>NIK</th>
              <th>Tanggal Lahir</th>
              <th>Jurusan</th>
              <th>Angkatan</th>
              <th>Alamat</th>
            </tr>
          </thead>
          <tbody>
            @if (count($siswas) > 0)
              @foreach($siswas as $s)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $s->nama }}</td>
                <td>{{ $s->nik }}</td>
                <td>{{ $s->tgl_lahir }}</td>
                <td>{{ $s->jurusan }}</td>
                <td>{{ $s->angkatan }}</td>
                <td>{{ $s->alamat }}</td>
              </tr>
              @endforeach
            @else
              <tr>
                <td colspan="7" class="text-center">No data found</td>
              </tr>
            @endif
          </tbody>
        </table>
      </div>
      <!-- Modal -->
      <div class="modal fade" id="create-modal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="createModalLabel">Create a data</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post" action="{{route('siswa.store')}}">
                @csrf
                <div class="input-group mb-3">
                  <span class="input-group-text">Nama</span>
                  <input type="text" id="i-nama" name="nama" class="form-control" placeholder="Masukkan Namamu...">
                </div>
                <div class="input-group mb-3">
                  <span class="input-group-text">Jenis Kelamin</span>
                  <select id="i-jenkel" name="id_jenkel" class="form-select">
                    <option selected disabled>-- Pilih Jenis Kelamin --</option>
                    @foreach ($jenkel as $gender)
                      <option value="{{$gender->id}}">{{$gender->jenkel}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="input-group mb-3">
                  <span class="input-group-text">NIK</span>
                  <input type="text" id="i-nik" name="nik" class="form-control" placeholder="Masukkan NIK...">
                </div>
                <div class="input-group mb-3">
                  <span class="input-group-text">Tanggal Lahir</span>
                  <input type="date" id="i-tgl-lahir" name="tgl_lahir" class="form-control">
                </div>
                <div class="input-group mb-3">
                  <span class="input-group-text">Jurusan</span>
                  <input type="text" id="i-jurusan" name="jurusan" class="form-control" placeholder="Nama Jurusan...">
                </div>
                <div class="input-group mb-3">
                  <span class="input-group-text">Angkatan</span>
                  <input type="text" id="i-angkatan" name="angkatan" class="form-control" placeholder="Angkatan ke...">
                </div>
                <div class="input-group mb-3">
                  <span class="input-group-text">Alamat</span>
                  <textarea name="alamat" id="i-alamat" class="form-control" style="resize: none" rows="5"></textarea>
                </div>
                <button type="submit" class="btn btn-primary w-100">Save</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- For managing js --}}
    @include('layout.js')
  </body>
</html>