@extends('layout.main')

@section('noidung')
<!-- Page Header Start -->
<div class="container-fluid bg-dark bg-img p-5 mb-5">
    <div class="row">
        <div class="col-12 text-center">
            <h1 class="display-4 text-uppercase text-white">{{ $album->title }}</h1>
            <a href="{{ route('home') }}" class="text-white">Trang chủ</a>
            <i class="far fa-square text-primary px-2"></i>
            <a href="{{ route('albums.index') }}" class="text-white">Album</a>
            <i class="far fa-square text-primary px-2"></i>
            <span class="text-white">{{ $album->title }}</span>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Album Detail Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-8 mx-auto text-center">
                <h2 class="text-primary font-secondary">{{ $album->title }}</h2>
                @if($album->photographer_name)
                <p class="lead text-muted">
                    <i class="fas fa-user me-2"></i>Nhiếp ảnh gia: <strong>{{ $album->photographer_name }}</strong>
                </p>
                @endif
                <p class="text-muted">
                    <i class="fas fa-calendar me-2"></i>{{ $album->created_at->format('d/m/Y') }}
                    <span class="mx-3">|</span>
                    <i class="fas fa-images me-2"></i>{{ $album->images->count() }} ảnh
                </p>
            </div>
        </div>
        
        <div class="row g-4">
            @forelse($album->images as $image)
            <div class="col-lg-4 col-md-6">
                <div class="position-relative overflow-hidden" style="height: 350px;">
                    <img src="{{ asset('img/albums/' . $image->image_path) }}" 
                         class="img-fluid w-100 h-100" 
                         style="object-fit: cover; cursor: pointer;"
                         data-bs-toggle="modal" 
                         data-bs-target="#imageModal{{ $image->id }}"
                         alt="Album image">
                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center"
                         style="background: rgba(0,0,0,0); transition: all 0.3s;"
                         onmouseover="this.style.background='rgba(0,0,0,0.5)'"
                         onmouseout="this.style.background='rgba(0,0,0,0)'">
                        <i class="fas fa-search-plus fa-2x text-white" style="opacity: 0; transition: all 0.3s;"
                           onmouseover="this.style.opacity='1'"
                           onmouseout="this.style.opacity='0'"></i>
                    </div>
                </div>
            </div>
            
            <!-- Image Modal -->
            <div class="modal fade" id="imageModal{{ $image->id }}" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content bg-transparent border-0">
                        <div class="modal-body p-0 position-relative">
                            <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" 
                                    data-bs-dismiss="modal" style="z-index: 1050;"></button>
                            <img src="{{ asset('img/albums/' . $image->image_path) }}" class="img-fluid w-100" alt="Album image">
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <i class="fas fa-image fa-5x text-muted mb-4"></i>
                <h4 class="text-muted">Album này chưa có ảnh nào</h4>
            </div>
            @endforelse
        </div>
        
        <div class="row mt-5">
            <div class="col-12 text-center">
                <a href="{{ route('albums.index') }}" class="btn btn-primary py-3 px-5">
                    <i class="fas fa-arrow-left me-2"></i>Quay lại danh sách Album
                </a>
            </div>
        </div>
    </div>
</div>
<!-- Album Detail End -->

<style>
.overflow-hidden:hover .position-absolute i {
    opacity: 1 !important;
}
.overflow-hidden:hover .position-absolute {
    background: rgba(0,0,0,0.5) !important;
}
</style>
@endsection
