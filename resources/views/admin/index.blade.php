@extends('../layout')
@section('content')
  <div>
    <a href="{{ route('admin.create') }}">Tambah</a>
    <table border="1">
      <thead>
        <tr>
          <th>Nama Gedung</th>
          <th>Alamat Gedung</th>
          <th>Deksripsi</th>
          <th>Foto Lahan</th>
          <th>Latitude</th>
          <th>Longitude</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $item)
          <tr>
            <td>{{ $item->nama_gedung }}</td>
            <td>{{ $item->alamat }}</td>
            <td>{{ $item->deskripsi }}</td>
            <td>
              @if(!empty($item->foto))
              <img class="foto-table" src="{{ asset('uploads/'.$item->foto) }}" alt="">
              @else
              <p>No Images</p>
              @endif
            </td>
            <td>{{ $item->latitude }}</td>
            <td>{{ $item->longitude }}</td>
            <td>
              <a href="{{ route('admin.edit', $item->id) }}">Edit</a>
              <a href="{{ route('admin.delete', $item->id) }}">Delete</a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection