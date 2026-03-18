<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    // Hiển thị danh sách tài khoản
    public function index()
    {
        $users = User::with('role')->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    // Hiển thị form tạo tài khoản mới
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    // Lưu tài khoản mới
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'phone' => 'nullable|string|max:20',
            'birthday' => 'nullable|date',
            'role_id' => 'required|exists:roles,id',
            'status' => 'required|in:active,locked',
        ]);

        $this->userService->register([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'birthday' => $request->birthday,
            'role_id' => $request->role_id,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Đã thêm tài khoản mới!');
    }

    // Hiển thị form chỉnh sửa
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    // Cập nhật tài khoản
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'birthday' => 'nullable|date',
            'role_id' => 'required|exists:roles,id',
            'status' => 'required|in:active,locked',
        ]);

        $data = $request->only(['name', 'email', 'phone', 'birthday', 'role_id', 'status']);
        
        if ($request->filled('password')) {
            $request->validate(['password' => 'min:6|confirmed']);
            $data['password'] = Hash::make($request->password);
        }

        $this->userService->updateProfile($id, $data);
        
        return redirect()->route('admin.users.index')->with('success', 'Đã cập nhật tài khoản!');
    }

    // Xóa tài khoản
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        
        return redirect()->route('admin.users.index')->with('success', 'Đã xóa tài khoản!');
    }
}
