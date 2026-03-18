@extends('admin.layout')

@section('page-title', 'Quản lý sản phẩm')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0"><i class="fas fa-box me-2"></i>Danh sách sản phẩm</h4>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Thêm sản phẩm
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="80">ID</th>
                        <th width="100">Hình ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Thương hiệu</th>
                        <th>Danh mục</th>
                        <th>Giá</th>
                        <th>Tồn kho</th>
                        <th width="150" class="text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr>
                        <td><strong>{{ $product->id }}</strong></td>
                        <td>
                            @if($product->image)
                            <img src="{{ asset('img/products/' . $product->image) }}" alt="{{ $product->name }}" 
                                 class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                            @else
                            <div class="bg-light d-flex align-items-center justify-content-center" 
                                 style="width: 60px; height: 60px;">
                                <i class="fas fa-camera text-muted"></i>
                            </div>
                            @endif
                        </td>
                        <td>
                            <strong>{{ $product->name }}</strong>
                        </td>
                        <td>{{ $product->brand->name ?? 'N/A' }}</td>
                        <td>{{ $product->category->name ?? 'N/A' }}</td>
                        <td><strong class="text-primary">{{ number_format($product->price, 0, ',', '.') }} VNĐ</strong></td>
                        <td>
                            <span class="badge bg-{{ $product->stock > 10 ? 'success' : ($product->stock > 0 ? 'warning' : 'danger') }}">
                                {{ $product->stock }}
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.products.edit', $product->id) }}" 
                               class="btn btn-sm btn-outline-primary" title="Sửa">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" 
                                  method="POST" class="d-inline" 
                                  onsubmit="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Xóa">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">
                            <i class="fas fa-inbox fa-2x mb-2"></i>
                            <p class="mb-0">Chưa có sản phẩm nào</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{ $products->links('pagination::bootstrap-5') }}
@endsection
