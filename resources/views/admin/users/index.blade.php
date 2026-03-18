@extends('admin.layout')

@section('page-title', 'Quản lý người dùng')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0"><i class="fas fa-users me-2"></i>Danh sách người dùng</h4>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Thêm người dùng
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="80">ID</th>
                        <th>Tên</th>
                        <th>Email</th>
                        <th>Điện thoại</th>
                        <th>Vai trò</th>
                        <th>Trạng thái</th>
                        <th>Ngày tham gia</th>
                        <th width="150" class="text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td><strong>{{ $user->id }}</strong></td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone ?? 'N/A' }}</td>
                        <td>
                            <span class="badge bg-{{ $user->role->name == 'admin' ? 'danger' : 'info' }}">
                                {{ ucfirst($user->role->name ?? 'user') }}
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-{{ $user->status == 'active' ? 'success' : 'secondary' }}">
                                {{ ucfirst($user->status ?? 'active') }}
                            </span>
                        </td>
                        <td>{{ optional($user->created_at)->format('d/m/Y') ?? '—' }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.users.edit', $user->id) }}" 
                               class="btn btn-sm btn-outline-primary" title="Sửa">
                                <i class="fas fa-edit"></i>
                            </a>
                            @if($user->id != auth()->id())
                            <form action="{{ route('admin.users.destroy', $user->id) }}" 
                                  method="POST" class="d-inline" 
                                  onsubmit="return confirm('Bạn có chắc muốn xóa người dùng này?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Xóa">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">
                            <i class="fas fa-user-slash fa-2x mb-2"></i>
                            <p class="mb-0">Chưa có người dùng nào</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{ $users->links('pagination::bootstrap-5') }}
@endsection
