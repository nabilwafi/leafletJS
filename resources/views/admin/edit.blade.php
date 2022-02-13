@extends('../layout')
@section('content')
<form action="{{ route('admin.update', $data->id) }}" method="POST" enctype="multipart/form-data">
  @csrf

  <div>
    <label for="nama_gedung">Nama Lahan</label>
    <input type="text" name="nama_gedung" id="nama_gedung" value="{{ $data->nama_gedung }}">
  </div>

  <div>
    <label for="alamat">Alamat</label>
    <input type="text" name="alamat" id="alamat" value="{{ $data->alamat }}">
  </div>
  
  <div>
    <label for="deskripsi">Deksripsi</label>
    <textarea type="text" name="deskripsi" id="deskripsi">{{ $data->deskripsi }}</textarea>
  </div>

  <div>
    <label for="foto">Foto Gedung</label>
    <input type="hidden" name="old_foto" value="{{ $data->foto }}" />
    <input type="file" name="foto" id="foto">
  </div>

  <div>
    <label for="latitude">Latitude</label>
    <input type="text" name="latitude" id="latitude" value="{{ $data->latitude }}">
  </div>

  <div>
    <label for="longitude">Longitude</label>
    <input type="text" name="longitude" id="longitude" value="{{ $data->longitude }}">
  </div>

  <div>
    <button type="submit">Submit</button>
  </div>
</form>

@endsection