@extends('layout.main')

@section('noidung')
<!-- Page Header Start -->
<div class="container-fluid bg-dark bg-img p-5 mb-5">
    <div class="row">
        <div class="col-12 text-center">
            <h1 class="display-4 text-uppercase text-white">Album Ảnh</h1>
            <a href="{{ route('home') }}" class="text-white">Trang chủ</a>
            <i class="far fa-square text-primary px-2"></i>
            <span class="text-white">Album</span>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Album Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="section-title position-relative text-center mx-auto mb-5 pb-3" style="max-width: 600px;">
            <h2 class="text-primary font-secondary">Album Ảnh Nghệ Thuật</h2>
            <h1 class="display-4 text-uppercase">Bộ sưu tập nhiếp ảnh chuyên nghiệp</h1>
        </div>
        
        <div class="row g-4">
            @forelse($albums as $album)
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 shadow-sm">
                    <a href="{{ route('albums.show', $album->id) }}">
                        @if($album->image)
                        <img src="{{ asset('img/albums/' . $album->image) }}" class="card-img-top" alt="{{ $album->title }}" 
                             style="height: 300px; object-fit: cover;">
                        @else
                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 300px;">
                            <i class="fas fa-image fa-4x text-muted"></i>
                        </div>
                        @endif
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ route('albums.show', $album->id) }}" class="text-decoration-none text-dark">
                                {{ $album->title }}
                            </a>
                        </h5>
                        @if($album->photographer_name)
                        <p class="card-text text-muted mb-2">
                            <i class="fas fa-user me-1"></i>{{ $album->photographer_name }}
                        </p>
                        @endif
                        <p class="card-text">
                            <small class="text-muted">
                                <i class="fas fa-calendar me-1"></i>{{ $album->created_at->format('d/m/Y') }}
                            </small>
                            <small class="text-muted ms-3">
                                <i class="fas fa-images me-1"></i>{{ $album->images->count() }} ảnh
                            </small>
                        </p>
                        <a href="{{ route('albums.show', $album->id) }}" class="btn btn-primary btn-sm">
                            Xem chi tiết <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <i class="fas fa-images fa-5x text-muted mb-4"></i>
                <h4 class="text-muted">Chưa có album nào</h4>
            </div>
            @endforelse
        </div>
        
        <div class="mt-5 d-flex justify-content-center">
            {{ $albums->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
<!-- Album End -->
@endsection
