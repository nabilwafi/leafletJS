@extends('../layout')
@section('content')
<form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
  @csrf

  <div>
    <label for="nama_gedung">Nama Gedung</label>
    <input type="text" name="nama_gedung" id="nama_gedung">
  </div>

  <div>
    <label for="alamat">Alamat</label>
    <input type="text" name="alamat" id="alamat">
  </div>
  
  <div>
    <label for="deskripsi">Deskripsi</label>
    <input type="text" name="deskripsi" id="deskripsi">
  </div>

  <div>
    <label for="foto">Foto Lahan</label>
    <input type="file" name="foto" id="foto">
  </div>

  <div>
    <label for="latitude">Latitude</label>
    <input type="text" name="latitude" id="latitude">
  </div>

  <div>
    <label for="longitude">Longitude</label>
    <input type="text" name="longitude" id="longitude">
  </div>

  <div>
    <button type="submit">Submit</button>
  </div>
</form>

@endsection