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
      <button type="button" class="btn btn-outline-success mx-auto w-100" data-bs-toggle="modal" data-bs-target="#create-modal">
        Create new data +
      </button>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th class="col-auto">No.</th>
              <th class="col-auto">Foto</th>
              <th class="col-auto">Nama</th>
              <th class="col-auto">NIK</th>
              <th class="col-auto">Tanggal Lahir</th>
              <th class="col-auto">Jurusan</th>
              <th class="col-auto">Angkatan</th>
              <th class="col-auto">Alamat</th>
              {{-- This will be the edit and delete button --}}
              <th class="col-auto">Opsi</th>
            </tr>
          </thead>
          <tbody>
            @if (count($siswas) > 0)
              @foreach($siswas as $s)
              <tr>
                <td class="col-auto">{{ $loop->iteration }}</td>
                <td class="col-auto">
                  @if ($s->photo == null)
                    <img src="{{asset('avtr.jpg')}}" alt="default" class="avtr-img">
                  @else
                    <img src="{{asset('uploads/'.$s->photo)}}" alt="" class="avtr-img">  
                  @endif
                </td>
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
                <td class="text-center col-auto">
                  {{-- Using form instead of a tag or other to safely secure the function --}}
                  <button data-dir="{{route('siswa.delete',$s->id)}}" type="submit" class="delete-siswa btn btn-sm btn-danger mb-1">Delete</button>
                  <br>
                  <!-- Edit button -->
                  <button type="button" data-bs-toggle="modal" data-bs-target="#modal-edit_{{$s->id}}" class="edit-siswa btn btn-sm btn-primary mt-1">Update</button>
                </td>
              </tr>
              <!-- #modal-edit -->
              <div class="modal fade" id="modal-edit_{{$s->id}}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="editModalLabel">Edit data</h5>
                    </div>
                    <form method="POST" action="{{route('siswa.update', $s->id)}}" enctype="multipart/form-data">
                      @csrf
                      @method('PUT')
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="input-group mb-3">
                              <span class="input-group-text">Nama</span>
                              <input type="text" id="i-edit-nama" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{$s->nama}}" placeholder="Masukkan Namamu..." required>
                              @error('nama')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                              @enderror
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="input-group mb-3">
                              <span class="input-group-text">Jenis Kelamin</span>
                              <select id="i-edit-jenkel" name="id_jenkel" class="form-select" required>
                                <option selected disabled>-- Pilih Jenis Kelamin --</option>
                                @foreach ($jenkel as $gender)
                                  {{-- if id_jenkel from $s variable is the same from $gender->id then the element will be selected else nothing happen --}}
                                  <option value="{{$gender->id}}" {{$s->id_jenkel == $gender->id ? 'selected' : ''}}>{{$gender->jenkel}}</option>
                                  {{-- $gender->id = variable gender is a jenis_kelamin table; $s->id_jenkel = variable s is a siswas table --}}
                                @endforeach
                              </select>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="input-group mb-3">
                              <span class="input-group-text">NIK</span>
                              <input type="text" id="i-edit-nik" name="nik" class="form-control @error('nik') is-invalid @enderror" value="{{$s->nik}}" placeholder="Masukkan NIK..." required>
                              @error('nik')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                              @enderror
                            </div>
                          </div>
                          <div class="col-md-6">          
                            <div class="input-group">
                              <span class="input-group-text">Tanggal Lahir</span>
                              <input type="date" id="i-edit-tgl-lahir" name="tgl_lahir" class="form-control" value="{{$s->tgl_lahir}}">
                            </div>
                            <label class="mb-3 text-warning" style="font-size: .85rem">*Tinggalkan tanggal lahir apabila tidak ingin di isi</label>
                          </div>
                          <div class="col-md-6">
                            <div class="input-group mb-3">
                              <span class="input-group-text">Jurusan</span>
                              <input type="text" id="i-edit-jurusan" name="jurusan" class="form-control @error('jurusan') is-invalid @enderror" value="{{$s->jurusan}}" placeholder="Nama Jurusan..." required>
                              @error('jurusan')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                              @enderror
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="input-group mb-3">
                              <span class="input-group-text">Angkatan</span>
                              <input type="text" id="i-edit-angkatan" name="angkatan" class="form-control @error('angkatan') is-invalid @enderror" value="{{$s->angkatan}}" placeholder="Angkatan ke..." required>
                              @error('angkatan')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                              @enderror
                            </div>
                          </div>
                          <div class="col-md-12">
                            @if ($s->photo == null)
                              <img id="previewImg-edit" src="{{asset('avtr.jpg')}}" class="avtr-img" alt="">
                            @else
                              <img id="previewImg-edit" src="{{asset('uploads/'.$s->photo)}}" class="avtr-img" alt="">  
                            @endif
                            <label for="i-photo" class="form-label">Foto</label>
                            <div class="input-group">
                              {{-- <span class="input-group-text">Foto</span> --}}
                              <input class="form-control uploads" name="photo" id="i-edit-photo" type="file">
                            </div>
                            <label class="mb-3 text-warning" style="font-size: .85rem">*Biarkan kosong jika tidak ingin di isi</label>
                          </div>
                          <div class="col-md-12">
                            <div class="input-group mb-3">
                              <span class="input-group-text">Alamat</span>
                              <textarea style="resize: none" id="i-edit-alamat" name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="5" required>{{$s->alamat}}</textarea>
                              @error('alamat')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                              @enderror
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              @endforeach
            @else
              <tr>
                <td colspan="8" class="text-center">No data found</td>
              </tr>
            @endif
          </tbody>
        </table>
        <div class="text-center my-3">
          {{$siswas->render()}}
        </div>
      </div>
      <!-- #create-modal -->
      <div class="modal fade" id="create-modal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="createModalLabel">Create a data</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post" action="{{route('siswa.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="input-group mb-3">
                  <span class="input-group-text">Nama</span>
                  <input type="text" id="i-nama" name="nama" class="form-control @error('nama') is-invalid @enderror" placeholder="Masukkan Namamu..." required>
                  @error('nama')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <div class="input-group mb-3">
                  <span class="input-group-text">Jenis Kelamin</span>
                  <select id="i-jenkel" name="id_jenkel" class="form-select @error('id_jenkel') is-invalid @enderror" required>
                    <option selected disabled>-- Pilih Jenis Kelamin --</option>
                    @foreach ($jenkel as $gender)
                      <option value="{{$gender->id}}">{{$gender->jenkel}}</option>
                    @endforeach
                  </select>
                  @error('id_jenkel')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <div class="input-group mb-3">
                  <span class="input-group-text">NIK</span>
                  <input type="text" id="i-nik" name="nik" class="form-control @error('nik') is-invalid @enderror" placeholder="Masukkan NIK..." required>
                  @error('nik')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <div class="input-group">
                  <span class="input-group-text">Tanggal Lahir</span>
                  <input type="date" id="i-tgl-lahir" name="tgl_lahir" class="form-control">
                </div>
                <label class="mb-3 text-warning" style="font-size: .85rem">*Tinggalkan tanggal lahir apabila tidak ingin di isi</label>
                <div class="input-group mb-3">
                  <span class="input-group-text">Jurusan</span>
                  <input type="text" id="i-jurusan" name="jurusan" class="form-control @error('jurusan') is-invalid @enderror" placeholder="Nama Jurusan..." required>
                  @error('jurusan')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <div class="input-group mb-3">
                  <span class="input-group-text">Angkatan</span>
                  <input type="text" id="i-angkatan" name="angkatan" class="form-control @error('angkatan') is-invalid @enderror" placeholder="Angkatan ke..." required>
                  @error('angkatan')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <div class="col-md-12">
                  <img id="previewImg" src="{{asset('avtr.jpg')}}" class="avtr-img" alt="">
                  <label for="i-photo" class="form-label">Foto</label>
                  <div class="input-group">
                    {{-- <span class="input-group-text">Foto</span> --}}
                    <input class="form-control uploads" name="photo" id="i-photo" type="file">
                  </div>
                  <label class="mb-3 text-warning" style="font-size: .85rem">*Biarkan kosong jika tidak ingin di isi</label>
                </div>
                <div class="input-group mb-3">
                  <span class="input-group-text">Alamat</span>
                  <textarea name="alamat" id="i-alamat" class="form-control @error('alamat') is-invalid @enderror" style="resize: none" rows="5" required></textarea>
                  @error('alamat')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
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