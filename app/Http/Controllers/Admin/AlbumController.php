<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AlbumService;
use App\Services\AlbumImageService;
use App\Services\ImageUploadService;
use App\Models\Album;
use App\Models\AlbumImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AlbumController extends Controller
{
    protected $albumService;
    protected $albumImageService;
    protected $imageUploadService;

    public function __construct(
        AlbumService $albumService, 
        AlbumImageService $albumImageService,
        ImageUploadService $imageUploadService
    ) {
        $this->albumService = $albumService;
        $this->albumImageService = $albumImageService;
        $this->imageUploadService = $imageUploadService;
    }

    // Hiển thị danh sách album
    public function index()
    {
        // Paginate để dùng được ->links() trong view admin
        $albums = Album::with('images')->latest()->paginate(12);
        return view('admin.albums.index', compact('albums'));
    }

    // Hiển thị form tạo album mới
    public function create()
    {
        return view('admin.albums.create');
    }

    // Lưu album mới
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'photographer_name' => 'nullable|string|max:100',
        ]);

        $data = $request->all();

        // Xử lý upload ảnh đại diện album
        if ($request->hasFile('image')) {
            $imageName = $this->imageUploadService->uploadAndResize(
                $request->file('image'), 
                'albums', 
                $request->title
            );
            $data['image'] = $imageName;
        }

        $this->albumService->createAlbum($data);
        
        return redirect()->route('admin.albums.index')->with('success', 'Đã thêm album mới!');
    }

    // Hiển thị chi tiết album
    public function show($id)
    {
        $album = $this->albumService->getAlbumDetail($id);
        
        if (!$album) {
            abort(404, 'Album không tồn tại');
        }

        return view('admin.albums.show', compact('album'));
    }

    // Hiển thị form chỉnh sửa
    public function edit($id)
    {
        $album = $this->albumService->getAlbumDetail($id);
        
        if (!$album) {
            abort(404, 'Album không tồn tại');
        }

        return view('admin.albums.edit', compact('album'));
    }

    // Cập nhật album
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'photographer_name' => 'nullable|string|max:100',
        ]);

        $album = $this->albumService->getAlbumDetail($id);
        
        if (!$album) {
            abort(404, 'Album không tồn tại');
        }

        $data = $request->all();

        // Xử lý upload ảnh đại diện mới
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu tồn tại
            if ($album->image) {
                $this->imageUploadService->delete($album->image, 'albums');
            }
            
            $imageName = $this->imageUploadService->uploadAndResize(
                $request->file('image'), 
                'albums', 
                $request->title
            );
            $data['image'] = $imageName;
        } else {
            // Không có file mới, giữ ảnh cũ
            unset($data['image']);
        }

        $album->update($data);
        
        return redirect()->route('admin.albums.index')->with('success', 'Đã cập nhật album!');
    }

    // Xóa album
    public function destroy($id)
    {
        $album = $this->albumService->getAlbumDetail($id);
        
        if (!$album) {
            abort(404, 'Album không tồn tại');
        }

        // Xóa tất cả ảnh trong album
        foreach ($album->images as $image) {
            $this->imageUploadService->delete($image->image_path, 'albums');
        }

        $album->delete();
        
        return redirect()->route('admin.albums.index')->with('success', 'Đã xóa album!');
    }

    // Upload ảnh vào album
    public function uploadImages(Request $request, $albumId)
    {
        $request->validate([
            'images' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:512000', // 500MB per file for RAW/High-res
        ]);

        $album = Album::findOrFail($albumId);

        if ($request->hasFile('images')) {
            // Sử dụng ImageUploadService để upload và resize nhiều ảnh
            $uploadedFiles = $this->imageUploadService->uploadMultiple(
                $request->file('images'), 
                'albums'
            );
            
            // Lưu vào database
            foreach ($uploadedFiles as $fileName) {
                $this->albumImageService->addImage([
                    'album_id' => $albumId,
                    'image_path' => $fileName,
                ]);
            }
        }

        return redirect()->route('admin.albums.show', $albumId)
            ->with('success', 'Đã thêm ' . count($uploadedFiles) . ' ảnh vào album!');
    }

    // Xóa ảnh khỏi album
    public function deleteImage($albumId, $imageId)
    {
        $image = AlbumImage::findOrFail($imageId);

        // Xóa file ảnh sử dụng ImageUploadService
        $this->imageUploadService->delete($image->image_path, 'albums');

        $this->albumImageService->deleteImage($imageId);

        return redirect()->route('admin.albums.show', $albumId)
            ->with('success', 'Đã xóa ảnh!');
    }
}
