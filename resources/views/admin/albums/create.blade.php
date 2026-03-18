@extends('admin.layout')

@section('page-title', 'Thêm Album mới')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Thêm Album mới</h4>
    <a href="{{ route('admin.albums.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-2"></i>Quay lại
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.albums.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="title" class="form-label">Tiêu đề Album <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                               id="title" name="title" value="{{ old('title') }}" required>
                        @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="photographer_name" class="form-label">Tên Nhiếp ảnh gia</label>
                        <input type="text" class="form-control @error('photographer_name') is-invalid @enderror" 
                               id="photographer_name" name="photographer_name" value="{{ old('photographer_name') }}">
                        @error('photographer_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="image" class="form-label">Hình ảnh đại diện</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" 
                               id="image" name="image" accept="image/*" onchange="previewImage(this)">
                        <small class="text-muted">Kích thước tối đa: 10MB. Định dạng: JPG, PNG, GIF</small>
                        @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div id="imagePreview" class="mt-3 text-center">
                        <img id="preview" src="#" alt="Preview" class="img-thumbnail" 
                             style="display: none; max-width: 100%; max-height: 300px;">
                    </div>
                </div>
            </div>

            <hr class="my-4">

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Lưu Album
                </button>
                <a href="{{ route('admin.albums.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times me-2"></i>Hủy
                </a>
            </div>
        </form>
    </div>
</div>

<script>
function previewImage(input) {
    const preview = document.getElementById('preview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
