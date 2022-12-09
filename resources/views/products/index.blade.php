@extends('products.template.parent')

@section('content')
    <div class="container mt-5 col-8 mx-auto">
        @if (session()->has('success'))    
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <a href="{{ route('products.create') }}" class="btn btn-primary mb-2">Tambah Produk</a>
        <table class="table table-dark table-hover text-center">
            <thead>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Stock</th>
                <th>Harga</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->stock }}</td>
                        <td>{{ $item->harga }}</td>
                        <td><img src="{{ $item->photo }}" alt="" style="height: 35px; width: 35px;"></td>
                        <td>
                            <form action="{{ route('products.destroy', $item->id) }}" method="post">
                                @method('DELETE')
                                @csrf
                                <a href="{{ route('products.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                                <button onclick="return confirm('Apakah anda ingin menghapus produk ini ?')" type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection