@extends('blog.template.parent')

@section('content')
    
    <div class="container my-5">
        <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data" class="col-8 mx-auto">
            <a href="{{ route('blog.index') }}" class="btn btn-warning mb-2">Kembali</a>
            @csrf
            <div class="mb-3">
                <label for="judul" class="form-label">Judul Konten</label>
                <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul') }}">

                @error('judul')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="cover" class="form-label">Cover Blog</label>
                <input class="form-control @error('cover') is-invalid @enderror" type="file" id="cover" name="cover">

                @error('cover')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <select class="form-select @error('kategori') is-invalid @enderror" aria-label="kategori" id="kategori" name="kategori">
                    @foreach ($kategori as $item)
                        <option value="{{ $item->id }}" {{ old('kategori') == $item->id? "selected" : "" }}>{{ $item->nama }}</option>
                    @endforeach
                </select>

                @error('kategori')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="konten" class="form-label">Artikel</label>
                <textarea class="form-control @error('konten') is-invalid @enderror" id="konten" rows="3" name="konten">{{ old('konten') }}</textarea>
            
                @error('konten')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="d-grid">
                <button class="btn btn-success" type="submit">Buat</button>
            </div>
          </form>
    </div>

@endsection