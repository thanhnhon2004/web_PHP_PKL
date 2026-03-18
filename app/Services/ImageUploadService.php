<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

/**
 * Service xử lý upload và resize ảnh
 * Áp dụng Single Responsibility Principle - chỉ xử lý upload/resize ảnh
 */
class ImageUploadService
{
    protected $maxWidth = 1920;
    protected $maxHeight = 1920;
    protected $quality = 85;

    /**
     * Upload và resize ảnh sử dụng GD Library
     * 
     * @param UploadedFile $file
     * @param string $directory Thư mục lưu (products, albums, etc)
     * @param string|null $customName Tên tùy chỉnh
     * @return string Tên file đã lưu
     */
    public function uploadAndResize(UploadedFile $file, string $directory, ?string $customName = null): string
    {
        // Tạo tên file unique
        $fileName = $this->generateFileName($file, $customName);
        
        // Đường dẫn đầy đủ
        $path = public_path("img/{$directory}");
        
        // Tạo thư mục nếu chưa có
        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }

        // Resize ảnh bằng GD Library
        $this->resizeImageGD($file->getRealPath(), "{$path}/{$fileName}");
        
        return $fileName;
    }

    /**
     * Resize ảnh sử dụng GD Library
     */
    protected function resizeImageGD(string $sourcePath, string $destinationPath): void
    {
        // Lấy thông tin ảnh
        list($width, $height, $type) = getimagesize($sourcePath);
        
        // Tạo image resource từ file
        $source = match($type) {
            IMAGETYPE_JPEG => imagecreatefromjpeg($sourcePath),
            IMAGETYPE_PNG => imagecreatefrompng($sourcePath),
            IMAGETYPE_GIF => imagecreatefromgif($sourcePath),
            default => imagecreatefromjpeg($sourcePath)
        };
        
        // Tính toán kích thước mới (giữ tỷ lệ)
        $ratio = min($this->maxWidth / $width, $this->maxHeight / $height, 1);
        $newWidth = (int)($width * $ratio);
        $newHeight = (int)($height * $ratio);
        
        // Tạo ảnh mới với kích thước đã resize
        $destination = imagecreatetruecolor($newWidth, $newHeight);
        
        // Giữ transparent cho PNG
        if ($type == IMAGETYPE_PNG) {
            imagealphablending($destination, false);
            imagesavealpha($destination, true);
        }
        
        // Resize ảnh
        imagecopyresampled($destination, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
        
        // Lưu ảnh
        match($type) {
            IMAGETYPE_JPEG => imagejpeg($destination, $destinationPath, $this->quality),
            IMAGETYPE_PNG => imagepng($destination, $destinationPath, 9),
            IMAGETYPE_GIF => imagegif($destination, $destinationPath),
            default => imagejpeg($destination, $destinationPath, $this->quality)
        };
        
        // Giải phóng bộ nhớ
        imagedestroy($source);
        imagedestroy($destination);
    }

    /**
     * Upload nhiều ảnh cùng lúc
     * 
     * @param array $files Mảng các UploadedFile
     * @param string $directory
     * @return array Mảng tên file đã lưu
     */
    public function uploadMultiple(array $files, string $directory): array
    {
        $uploadedFiles = [];
        
        foreach ($files as $file) {
            try {
                $uploadedFiles[] = $this->uploadAndResize($file, $directory);
            } catch (\Exception $e) {
                // Log lỗi nhưng tiếp tục upload các file khác
                \Illuminate\Support\Facades\Log::error("Failed to upload image: " . $e->getMessage());
            }
        }
        
        return $uploadedFiles;
    }

    /**
     * Xóa ảnh
     * 
     * @param string $fileName
     * @param string $directory
     * @return bool
     */
    public function delete(string $fileName, string $directory): bool
    {
        $filePath = public_path("img/{$directory}/{$fileName}");
        
        if (file_exists($filePath)) {
            return unlink($filePath);
        }
        
        return false;
    }

    /**
     * Generate tên file unique
     * 
     * @param UploadedFile $file
     * @param string|null $customName
     * @return string
     */
    protected function generateFileName(UploadedFile $file, ?string $customName = null): string
    {
        if ($customName) {
            $slug = Str::slug($customName);
            return time() . '_' . $slug . '.' . $file->getClientOriginalExtension();
        }
        
        return time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
    }

    /**
     * Set max width cho resize
     */
    public function setMaxWidth(int $width): self
    {
        $this->maxWidth = $width;
        return $this;
    }

    /**
     * Set max height cho resize
     */
    public function setMaxHeight(int $height): self
    {
        $this->maxHeight = $height;
        return $this;
    }

    /**
     * Set quality
     */
    public function setQuality(int $quality): self
    {
        $this->quality = $quality;
        return $this;
    }
}
