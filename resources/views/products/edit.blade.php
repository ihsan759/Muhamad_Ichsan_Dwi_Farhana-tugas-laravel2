@extends('products.template.parent')

@section('content')
    
    <div class="container mt-5">
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="col-8 mx-auto">
            <a href="{{ route('products.index') }}" class="btn btn-warning mb-2">Kembali</a>
            @method('PUT')
            @csrf
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Produk</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $product->nama) }}">

                @error('nama')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="stock" class="form-label">Stok Barang</label>
                <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ old('stock', $product->stock) }}">
                
                @error('stock')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga Barang</label>
                <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="{{ old('harga', $product->harga) }}">

                @error('harga')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar Barang</label>
                <input class="form-control @error('gambar') is-invalid @enderror" type="file" id="gambar" name="gambar">

                @error('gambar')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="d-grid">
                <button class="btn btn-success" type="submit">Update</button>
            </div>
          </form>
    </div>

@endsection