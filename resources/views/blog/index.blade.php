@extends('blog.template.parent')

@section('content')
    
    <div class="container mt-5 mx-auto">
        @if (session()->has('success'))    
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <a href="{{ route('blog.create') }}" class="btn btn-primary mb-2">Buat Konten</a>
        <table class="table table-dark text-center">
            <thead>
                <th>No</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Jumlah Like</th>
                <th>Jumlah Komentar</th>
                <th>Aksi</th>
            </thead>
            <tbody>
                @foreach ($data as $item)    
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->judul }}</td>
                        <td>{{ $item->Kategori->nama }}</td>
                        <td>{{ $item->like_count }}</td>
                        <td>{{ $item->komentar_count }}</td>
                        <td>
                            <form action="{{ route('blog.destroy', $item->id) }}" method="post">
                                @method('DELETE')
                                @csrf
                                <a href="{{ route('blog.show', $item->id) }}" class="btn btn-success">Detail</a>
                                <a href="{{ route('blog.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                                <button onclick="return confirm('Apakah anda ingin menghapus blog ini ?')" type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection