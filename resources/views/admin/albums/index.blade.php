@extends('admin.layout')

@section('page-title', 'Quản lý Album')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0"><i class="fas fa-images me-2"></i>Danh sách Album</h4>
    <a href="{{ route('admin.albums.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Thêm Album
    </a>
</div>

<div class="row g-4">
    @forelse($albums as $album)
    <div class="col-md-4">
        <div class="card h-100">
            @if($album->image)
            <img src="{{ asset('img/albums/' . $album->image) }}" class="card-img-top" alt="{{ $album->title }}" 
                 style="height: 250px; object-fit: cover;">
            @else
            <div class="bg-light d-flex align-items-center justify-content-center" style="height: 250px;">
                <i class="fas fa-image fa-3x text-muted"></i>
            </div>
            @endif
            <div class="card-body">
                <h5 class="card-title">{{ $album->title }}</h5>
                <p class="card-text text-muted mb-2">
                    <i class="fas fa-user me-1"></i>{{ $album->photographer_name ?? 'N/A' }}
                </p>
                <p class="card-text text-muted">
                    <i class="fas fa-calendar me-1"></i>{{ optional($album->created_at)->format('d/m/Y') ?? '—' }}
                </p>
            </div>
            <div class="card-footer bg-transparent">
                <div class="btn-group w-100" role="group">
                    <a href="{{ route('admin.albums.show', $album->id) }}" 
                       class="btn btn-sm btn-outline-info" title="Xem chi tiết">
                        <i class="fas fa-eye"></i> Xem
                    </a>
                    <a href="{{ route('admin.albums.edit', $album->id) }}" 
                       class="btn btn-sm btn-outline-primary" title="Sửa">
                        <i class="fas fa-edit"></i> Sửa
                    </a>
                    <form action="{{ route('admin.albums.destroy', $album->id) }}" 
                          method="POST" class="d-inline" style="flex: 1;"
                          onsubmit="return confirm('Bạn có chắc muốn xóa album này?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger w-100" title="Xóa">
                            <i class="fas fa-trash"></i> Xóa
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="card">
            <div class="card-body text-center py-5">
                <i class="fas fa-images fa-3x text-muted mb-3"></i>
                <p class="mb-0">Chưa có album nào</p>
            </div>
        </div>
    </div>
    @endforelse
</div>

<div class="mt-4">
    {{ $albums->links('pagination::bootstrap-5') }}
</div>
@endsection
