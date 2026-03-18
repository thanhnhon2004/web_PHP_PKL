@extends('admin.layout')

@section('page-title', 'Chi tiết Album')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0"><i class="fas fa-images me-2"></i>{{ $album->title }}</h4>
    <div>
        <a href="{{ route('admin.albums.edit', $album->id) }}" class="btn btn-primary me-2">
            <i class="fas fa-edit me-2"></i>Chỉnh sửa
        </a>
        <a href="{{ route('admin.albums.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Quay lại
        </a>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-info-circle me-2"></i>Thông tin Album
            </div>
            <div class="card-body">
                @if($album->image)
                <img src="{{ asset('img/albums/' . $album->image) }}" alt="{{ $album->title }}" 
                     class="img-fluid rounded mb-3">
                @else
                <div class="bg-light d-flex align-items-center justify-content-center rounded mb-3" 
                     style="height: 200px;">
                    <i class="fas fa-image fa-3x text-muted"></i>
                </div>
                @endif
                
                <ul class="list-unstyled mb-0">
                    <li class="mb-2">
                        <strong>Tiêu đề:</strong> {{ $album->title }}
                    </li>
                    <li class="mb-2">
                        <strong>Nhiếp ảnh gia:</strong> {{ $album->photographer_name ?? 'N/A' }}
                    </li>
                    <li class="mb-2">
                        <strong>Ngày tạo:</strong> {{ $album->created_at->format('d/m/Y H:i') }}
                    </li>
                    <li class="mb-0">
                        <strong>Số ảnh:</strong> {{ $album->images->count() }}
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fas fa-photo-video me-2"></i>Danh sách ảnh trong Album</span>
                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addImageModal">
                    <i class="fas fa-plus me-1"></i>Thêm ảnh
                </button>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    @forelse($album->images as $image)
                    <div class="col-md-4">
                        <div class="position-relative">
                            <img src="{{ asset('img/albums/' . $image->image_path) }}" alt="Album image" 
                                 class="img-fluid rounded" style="width: 100%; height: 200px; object-fit: cover;">
                            <div class="position-absolute top-0 end-0 p-2">
                                <form action="{{ route('admin.albums.images.destroy', [$album->id, $image->id]) }}" 
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Bạn có chắc muốn xóa ảnh này?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center py-5">
                        <i class="fas fa-image fa-3x text-muted mb-3"></i>
                        <p class="text-muted mb-0">Chưa có ảnh nào trong album</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Image Modal -->
<div class="modal fade" id="addImageModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="uploadForm" action="{{ route('admin.albums.images.store', $album->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-upload me-2"></i>Thêm ảnh vào Album</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Chọn ảnh (có thể chọn nhiều ảnh)</label>
                        <input type="file" name="images[]" id="imageInput" class="form-control" multiple accept="image/*" required>
                        <small class="text-muted d-block mt-2">
                            <i class="fas fa-info-circle"></i> <strong>Có thể upload tổng 5-10GB cùng lúc</strong> (100-200 ảnh RAW/High-res)
                        </small>
                        <small class="text-muted d-block">
                            <i class="fas fa-compress"></i> Ảnh sẽ tự động resize về 1920px → giảm ~80% dung lượng storage
                        </small>
                        <small class="text-warning d-block mt-1">
                            <i class="fas fa-clock"></i> Upload lớn có thể mất 10-30 phút. Vui lòng không tắt trình duyệt.
                        </small>
                    </div>
                    
                    <!-- File count display -->
                    <div id="fileCount" class="alert alert-info d-none">
                        <i class="fas fa-images"></i> Đã chọn: <strong><span id="fileCountNumber">0</span> ảnh</strong>
                        (<span id="fileSizeTotal">0 MB</span>)
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" id="uploadBtn" class="btn btn-primary">
                        <i class="fas fa-upload me-1"></i>Upload
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Upload Progress Overlay -->
<div id="uploadOverlay" class="upload-overlay d-none">
    <div class="upload-progress-container">
        <div class="text-center mb-4">
            <div class="spinner-border text-primary" style="width: 4rem; height: 4rem;" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <h4 class="text-center mb-3">
            <i class="fas fa-cloud-upload-alt me-2"></i>Đang tải lên...
        </h4>
        <div class="progress mb-3" style="height: 30px;">
            <div id="uploadProgressBar" class="progress-bar progress-bar-striped progress-bar-animated bg-primary" 
                 role="progressbar" style="width: 0%">
                <span id="percentText" class="fw-bold">0%</span>
            </div>
        </div>
        <p class="text-center text-muted mb-2">
            <span id="uploadStatus">Đang xử lý ảnh...</span>
        </p>
        <p class="text-center">
            <small class="text-warning">
                <i class="fas fa-exclamation-triangle"></i> 
                Vui lòng không tắt trình duyệt hoặc chuyển tab
            </small>
        </p>
    </div>
</div>

<style>
.upload-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.85);
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
}

.upload-progress-container {
    background: white;
    padding: 40px;
    border-radius: 15px;
    min-width: 500px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.3);
}

.upload-overlay.d-none {
    display: none !important;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('uploadForm');
    const fileInput = document.getElementById('imageInput');
    const uploadBtn = document.getElementById('uploadBtn');
    const uploadOverlay = document.getElementById('uploadOverlay');
    const progressBar = document.getElementById('uploadProgressBar');
    const percentText = document.getElementById('percentText');
    const uploadStatus = document.getElementById('uploadStatus');
    const fileCountDiv = document.getElementById('fileCount');
    const fileCountNumber = document.getElementById('fileCountNumber');
    const fileSizeTotal = document.getElementById('fileSizeTotal');
    
    // Show file count when files selected
    fileInput.addEventListener('change', function(e) {
        const files = e.target.files;
        if (files.length > 0) {
            let totalSize = 0;
            for (let file of files) {
                totalSize += file.size;
            }
            
            fileCountNumber.textContent = files.length;
            fileSizeTotal.textContent = (totalSize / 1024 / 1024).toFixed(2);
            fileCountDiv.classList.remove('d-none');
        } else {
            fileCountDiv.classList.add('d-none');
        }
    });
    
    // Handle form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const files = fileInput.files;
        if (files.length === 0) {
            alert('Vui lòng chọn ảnh để upload!');
            return;
        }
        
        // Show overlay
        uploadOverlay.classList.remove('d-none');
        uploadBtn.disabled = true;
        
        // Create FormData
        const formData = new FormData(form);
        
        // Simulate progress (since we can't get real upload progress easily)
        let progress = 0;
        const totalFiles = files.length;
        const estimatedTime = totalFiles * 200; // 200ms per file estimation
        const interval = 100;
        const increment = (100 / (estimatedTime / interval));
        
        const progressInterval = setInterval(() => {
            progress += increment;
            if (progress >= 95) {
                progress = 95; // Stop at 95% until real response
                clearInterval(progressInterval);
            }
            updateProgress(progress, totalFiles);
        }, interval);
        
        // Send AJAX request
        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            clearInterval(progressInterval);
            updateProgress(100, totalFiles);
            
            setTimeout(() => {
                if (response.ok) {
                    window.location.reload(); // Reload to show new images
                } else {
                    throw new Error('Upload failed');
                }
            }, 500);
        })
        .catch(error => {
            clearInterval(progressInterval);
            uploadOverlay.classList.add('d-none');
            uploadBtn.disabled = false;
            alert('Lỗi upload: ' + error.message);
        });
    });
    
    function updateProgress(percent, totalFiles) {
        const roundedPercent = Math.round(percent);
        progressBar.style.width = roundedPercent + '%';
        percentText.textContent = roundedPercent + '%';
        
        if (percent < 30) {
            uploadStatus.textContent = `Đang upload ${totalFiles} ảnh lên server...`;
        } else if (percent < 70) {
            uploadStatus.textContent = 'Đang xử lý và resize ảnh...';
        } else if (percent < 95) {
            uploadStatus.textContent = 'Đang lưu ảnh vào database...';
        } else if (percent >= 100) {
            uploadStatus.textContent = 'Hoàn tất! Đang tải lại trang...';
            progressBar.classList.remove('progress-bar-animated');
            progressBar.classList.add('bg-success');
        }
    }
});
</script>
@endsection
