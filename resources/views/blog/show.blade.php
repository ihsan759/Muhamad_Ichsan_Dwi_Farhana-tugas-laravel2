@extends('blog.template.parent')

@section('content')

    <div class="container my-5">
        <a href="{{ route('blog.index') }}" class="btn btn-warning mb-2">Kembali</a>
        <div class="card">
            <div class="card-header">
                <img src="{{ $blog->cover }}" class="card-img-top" alt="cover.jpg" style="height: 250px;">
            </div>
            <div class="card-body">
              <h5 class="card-title text-center">{{ $blog->judul }}</h5>
              <p class="card-text text-center"><small class="text-muted">{{ $blog->updated_at }}</small></p>
              <p class="card-text">{!!$blog->konten!!}</p>
            </div>
        </div>
    </div>
    
@endsection