<?php

namespace App\Repositories\Interfaces;
/*
có thể nói interface là là class abstract đúng nhưng chưa đủ 
Interface dùng để trừu tượng hóa hành vi,
 định nghĩa các phương thức mà class triển khai bắt buộc phải thực hiện;
 */
interface AlbumImageRepositoryInterface
{
    public function create(array $data);
    public function delete(int $id);
}
/* file này là 1 interface, của repositories, file này dùng để định nghĩa các hành động 
mà class repository xử lý ảnh album bắt buộc phải có
 trong file này đang định nghĩa 2 phương thức create và delete 
public function create(array $data);  tạo 1 hàm có trên là creat và cần truyền tham số
dạng mảng data
public function delete(int $id); tạo 1 hàm có tên là delete và cần truyền tham số biến id
*/