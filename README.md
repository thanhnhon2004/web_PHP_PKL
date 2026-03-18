tài kkhỏan admin : admin@cameramam.com
# BÁO CÁO DỰ ÁN

## 1. Mô tả về dự án

- Tên dự án: website thương mại PKL
- Mục tiêu: Mục tiêu của đề tài là xây dựng một website thương mại điện tử sử dụng ngôn ngữ PHP theo hướng lập trình hướng đối tượng (OOP) và framework Laravel. Hệ thống được phát triển nhằm cung cấp một nền tảng mua sắm trực tuyến tiện lợi, thân thiện với người dùng, giúp khách hàng dễ dàng tìm kiếm, lựa chọn và đặt mua sản phẩm.

Bên cạnh đó, website hướng đến việc tối ưu trải nghiệm người dùng thông qua giao diện trực quan, dễ sử dụng và quy trình mua hàng nhanh chóng. Hệ thống cũng tích hợp chức năng thanh toán trực tuyến, hỗ trợ gửi thông báo qua email và xác thực tài khoản khi đăng ký nhằm nâng cao tính bảo mật và độ tin cậy.

Ngoài ra, hệ thống còn cung cấp các công cụ quản trị giúp quản trị viên dễ dàng theo dõi, quản lý sản phẩm, đơn hàng và người dùng một cách hiệu quả và trực quan. 

 ---

## Lý do chọn đề tài

- Thương mại điện tử và các hệ thống quản lý bán hàng trực tuyến ngày càng phát triển mạnh mẽ, đặc biệt sau đại dịch Covid-19.
- Nhu cầu xây dựng website bán hàng hiện đại, tích hợp thanh toán trực tuyến, quản lý đơn hàng, xác thực người dùng, bảo mật... là rất lớn trong thực tế.
- Đề tài giúp sinh viên rèn luyện kỹ năng lập trình web fullstack, sử dụng framework hiện đại (Laravel, Bootstrap), tích hợp các dịch vụ thực tế như VNPAY, Email OTP.
- Sản phẩm có thể mở rộng, áp dụng thực tế cho nhiều mô hình kinh doanh nhỏ lẻ hoặc làm nền tảng cho các dự án lớn hơn.
- Đề tài phù hợp với xu hướng chuyển đổi số, đáp ứng yêu cầu học tập, thực hành và nghiên cứu công nghệ mới.

---
- Công nghệ sử dụng:
    - laravel framework
    - php
    - MySQL
    - tailwind css
    - bootstrap
    - vnpay
    - email smtp
- Tính năng nổi bật:
  - Đăng ký, đăng nhập, xác thực OTP qua email
  - Quản lý sản phẩm, đơn hàng, quản lý  tài khoản, xem báo cáo doanh thu 
  - Thanh toán qua VNPAY
  - Quản lý tài khoản, phân quyền
  - xem sản phẩm - chi tiết sản phẩm - thêm giỏ hàng - thanh toán
  - trả hàng -đánh giá đơn hàng
  - quản lý album xem xóa sửa thêm ảnh vào album, tạo thêm album
  - khách hàng quản lý được thông tin cá nhân, quản lý được đơn hàng lịch sử đơn hàng
- các giao diện chính trong dự án:
    - Trang chủ: home.blade.php
    - Trang giới thiệu: about.blade.php
    - Trang liên hệ: contact.blade.php
    - Trang sản phẩm:
    - Danh sách sản phẩm: products/index.blade.php
    - Chi tiết sản phẩm: products/show.blade.php
    - Trang album:
    - Danh sách album: albums/index.blade.php
    - Chi tiết album: albums/show.blade.php
    - Trang giỏ hàng: cart/index.blade.php
    - Trang đơn hàng: order/index.blade.php
    - Trang tài khoản/profile:
    - Thông tin & đơn hàng: profile/index.blade.php
    - Xác thực OTP đổi mật khẩu: profile/verify-password-otp.blade.php
    - Trang xác thực:
    - Đăng nhập: auth/login.blade.php
    - Đăng ký: auth/register.blade.php
    - Xác thực OTP: auth/verify-otp.blade.php
    - Giao diện quản trị (Admin)
    - Dashboard: admin/dashboard.blade.php
    - Quản lý người dùng: admin/users/index.blade.php, admin/users/create.blade.php, admin/users/edit.blade.php
    - Quản lý sản phẩm: admin/products/index.blade.php, admin/products/create.blade.php, admin/products/edit.blade.php
    - Quản lý album: admin/albums/index.blade.php, admin/albums/create.blade.php, admin/albums/edit.blade.php, admin/albums/show.blade.php
    - Quản lý đơn hàng: admin/orders/show.blade.php
    - Layout admin: admin/layout.blade.php
    -----------------------------------------------------------
Hệ thống sử dụng cơ sở dữ liệu quan hệ (MySQL/MariaDB) với các bảng chính:

+ users: Lưu thông tin người dùng (tên, email, mật khẩu, số điện thoại, vai trò, trạng thái, ...)
+ roles: Quản lý phân quyền (admin, user, ...)
+ products: Sản phẩm (tên, giá, mô tả, hình ảnh, thương hiệu, danh mục, tồn kho)
+ categories: Danh mục sản phẩm (camera, lens, phụ kiện, ...)
+ brands: Thương hiệu sản phẩm
+ albums: Album ảnh (dùng cho gallery, marketing, ...)
+ album_images: Ảnh trong album
+ carts: Giỏ hàng của từng user
+ cart_items: Sản phẩm trong giỏ hàng
+ orders: Đơn hàng (user, tổng tiền, trạng thái, ...)
+ order_items: Sản phẩm trong đơn hàng (số lượng, giá tại thời điểm đặt)
+ addresses: Địa chỉ giao hàng của user
+ payment_histories: Lịch sử thanh toán (VNPAY, trạng thái, mã giao dịch, ...)
+ return_requests: Yêu cầu trả hàng/hoàn tiền
+ password_reset_tokens, sessions, jobs, cache: Hỗ trợ xác thực, phiên đăng nhập, queue, cache...
+ Mối quan hệ tiêu biểu:
+ 1 user có nhiều đơn hàng, nhiều địa chỉ, 1 giỏ hàng.
+ 1 đơn hàng có nhiều order_items, mỗi order_item thuộc về 1 sản phẩm.
+ 1 sản phẩm thuộc 1 danh mục, 1 thương hiệu.
+ 1 album có nhiều ảnh.
+ Cơ sở dữ liệu được thiết kế chuẩn hóa, hỗ trợ đầy đủ chức năng quản lý bán hàng, người dùng, đơn hàng, thanh toán, bảo mật và mở rộng.
## 2. Hướng dẫn cài đặt & cấu hình dự án
### 2.1. Yêu cầu hệ thống
- PHP >= 8.1
- Composer
- MySQL/MariaDB
- Node.js & npm (nếu muốn build lại frontend)
- laravel
-  Web Server (Laragon hoặc XAMPP)
- Git (để clone repository)
### 2.2. Các bước cài đặt
1. Mở Terminal (hoặc Git Bash) tại thư mục web của bạn (ví dụ: `C:\laragon\www`) và chạy lệnh:
```bash
git https://github.com/thanhnhon2004/web_PHP_PKL
cd web_PHP_PKL
```
---
   - Nếu không dùng Git, bạn có thể vào trang GitHub của dự án, bấm nút "Code" > "Download ZIP" để tải về, sau đó giải nén ra thư mục bất kỳ trên máy tính.
   - Đảm bảo bạn đang ở đúng thư mục gốc của dự án trước khi thực hiện các bước tiếp theo (thư mục trong laragon\www\DACK ).
   lưu ý đổi tên thư mục thành DACK 
2. Cài đặt các thư viện PHP cho dự án:
   - Đảm bảo bạn đã cài đặt Composer trên máy tính. Nếu chưa có, tải tại https://getcomposer.org/download/
   - Mở terminal/cmd tại thư mục gốc dự án (nơi có file composer.json).
   - Chạy lệnh sau để tự động tải và cài đặt toàn bộ thư viện cần thiết:
     ```bash
     composer install
     ```
   - Quá trình này sẽ tạo thư mục `vendor/` và file `composer.lock`.
   - Nếu gặp lỗi về phiên bản PHP hoặc thiếu extension, kiểm tra lại cấu hình PHP/Laragon.
3. Cài đặt package JS (nếu có):
   - Đảm bảo bạn đã cài Node.js và npm (https://nodejs.org/)
   - Mở terminal/cmd tại thư mục gốc dự án (nơi có file package.json)
   - Chạy lần lượt các lệnh sau để cài đặt và build frontend:
     ```bash
     npm install
     ```
   - `npm install`: Tự động tải và cài đặt các thư viện JS cần thiết vào thư mục `node_modules/`
   - Không cần chạy `npm run build` vì toàn bộ giao diện frontend sử dụng các file HTML, CSS, Bootstrap, Tailwind đã được nhúng sẵn trong các file view (Blade), không cần đóng gói lại.
4. Tạo file cấu hình môi trường (.env):
    - mở thư mục gốc của dự án copy file `.env.example` và đổi tên bản copy thành `.env`.
   - File .env chứa các thông tin cấu hình quan trọng cho dự án (database, mail, v.v.).
   - Mở file `.env` và cập nhật thông tin kết nối Database của bạn.
5. vào trang http://localhost/phpmyadmin/ vào dự án tìm database có database tên DACK chưa nếu chưa thì tạo database sau đó vào thư mục gốc có file DACK.sql export file này vào database vừa tạo
5. Thiết lập thông tin database trong file `.env`:
   - Mở file .env vừa tạo bằng Notepad hoặc VS Code.
   - Tìm các dòng sau và sửa lại cho đúng với cấu hình database trên máy bạn:
     ```env
     DB_DATABASE=ten_db      # Tên database bạn đã tạo trong MySQL (khuyến nghị nên là DACK)
     DB_USERNAME=ten_user    # Tên user MySQL ( thường sẽ là root)
     DB_PASSWORD=mat_khau    # Mật khẩu user MySQL (khuyến nghị ko nên đặt mật khẩu)
     ```
   - Lưu file .env lại sau khi chỉnh sửa.
### 2.3. Cấu hình Email (gửi OTP, thông báo)
#### Bước 1: Đăng ký hoặc chuẩn bị tài khoản email gửi OTP/thông báo
  - Nên dùng Gmail hoặc email doanh nghiệp (có SMTP).
  - Nếu dùng Gmail, cần bật xác thực 2 bước và tạo App Password (không dùng mật khẩu Gmail thông thường).
  - Hướng dẫn tạo App Password Gmail:
    1. Đăng nhập Gmail, vào https://myaccount.google.com/security
    2. Bật xác minh 2 bước (Two-factor authentication)
    3. Sau khi bật, kéo xuống mục "Mật khẩu ứng dụng" (App Passwords)
    4. Tạo mật khẩu ứng dụng mới, chọn "Mail" và "Other" (đặt tên tuỳ ý, ví dụ: Laravel)
    5. Copy mật khẩu ứng dụng vừa tạo (16 ký tự)
#### Bước 2: Cấu hình file .env
  - Mở file `.env` trong thư mục gốc dự án
  - Tìm và sửa các dòng sau cho đúng:
    ```env
    MAIL_MAILER=smtp
    MAIL_HOST=smtp.gmail.com
    MAIL_PORT=587
    MAIL_USERNAME=your_email@gmail.com         # Email dùng để gửi OTP/thông báo
    MAIL_PASSWORD=your_app_password           # App Password vừa tạo ở trên
    MAIL_ENCRYPTION=tls
    MAIL_FROM_ADDRESS=your_email@gmail.com    # Email hiển thị là người gửi
    MAIL_FROM_NAME="Tên website"            # Tên website hoặc tên shop
    ```
  - Lưu file .env lại.
#### Bước 3: Kiểm tra gửi mail
  - Có thể dùng chức năng quên mật khẩu, đăng ký tài khoản để kiểm tra gửi mail.
  - Nếu gặp lỗi không gửi được mail:
    - Kiểm tra lại App Password, email, cổng (587), mã hoá (tls)
    - Kiểm tra kết nối mạng, tường lửa, hoặc thử lại với email khác
    - Xem log lỗi trong storage/logs/laravel.log để biết chi tiết
#### Lưu ý:
  - Gmail thường chặn đăng nhập từ ứng dụng kém bảo mật, nên bắt buộc phải dùng App Password.
  - Nếu dùng email doanh nghiệp, lấy thông tin SMTP từ quản trị viên.
### 2.4. Cấu hình VNPAY
#### Bước 1: Đăng ký tài khoản VNPAY Merchant (sandbox)
  - Truy cập https://sandbox.vnpayment.vn/devreg, đăng ký tài khoản merchant (miễn phí cho môi trường test)
  - Sau khi đăng ký, đăng nhập để lấy các thông tin cấu hình:
    - **VNPAY_TMN_CODE**: Mã website (Terminal code) do VNPAY cấp
    - **VNPAY_HASH_SECRET**: Chuỗi ký tự bí mật dùng để tạo checksum
    - **VNPAY_URL**: Địa chỉ cổng thanh toán (sandbox hoặc production)
    - **VNPAY_RETURN_URL**: Đường dẫn callback khi thanh toán xong (nên để đúng route trong web.php, ví dụ: http://localhost:8000/payment-return)
#### Bước 2: Cấu hình file .env hoặc config/vnpay.php
  - Mở file `.env` hoặc `config/vnpay.php`
  - Thêm hoặc sửa các dòng sau:
    ```env
    VNPAY_TMN_CODE=xxxxxx           # Mã TMN code lấy từ VNPAY
    VNPAY_HASH_SECRET=xxxxxx        # Chuỗi bí mật lấy từ VNPAY
    VNPAY_URL=https://sandbox.vnpayment.vn/paymentv2/vpcpay.html
    VNPAY_RETURN_URL=http://localhost:8000/payment-return
    ```
  - Lưu file lại.

#### Bước 3: Kiểm tra cấu hình và test thanh toán
  - Đăng nhập tài khoản user, đặt hàng và chọn thanh toán qua VNPAY
  - Kiểm tra xem có chuyển hướng sang trang VNPAY không, sau khi thanh toán có trả về trang web không
  - Nếu gặp lỗi:
    - Kiểm tra lại các thông tin TMN_CODE, HASH_SECRET, URL
    - Kiểm tra route payment-return đã khai báo đúng trong routes/web.php
    - Xem log lỗi trong storage/logs/laravel.log
#### Lưu ý:
  - Thông tin cấu hình VNPAY là bí mật, không chia sẻ công khai
  - Khi deploy lên server thật, cần đổi sang thông tin production do VNPAY cấp
  - Đảm bảo callback (VNPAY_RETURN_URL) trỏ đúng domain của bạn khi chạy thật
### 2.5. Hướng dẫn upload ảnh lưu trực tiếp trên server

Mặc định dự án lưu ảnh vào thư mục trên server (storage/app/public), không dùng cloud:

1. Sau khi cài đặt, chạy lệnh sau để tạo symlink giúp truy cập ảnh qua URL:
  ```bash
  php artisan storage:link
  ```
  - Lệnh này sẽ tạo thư mục public/storage liên kết với storage/app/public.
  - Khi upload ảnh, đường dẫn truy cập sẽ là: http://localhost:8000/storage/ten_anh.jpg

2. Đảm bảo thư mục storage/ và bootstrap/cache/ có quyền ghi:
  - Trên Windows: thường không cần làm gì thêm.
  - Trên Linux (nếu deploy): chạy lệnh
    ```bash
    chmod -R 775 storage bootstrap/cache
    chown -R www-data:www-data storage bootstrap/cache
    ```
    (thay www-data bằng user chạy webserver nếu khác)

3. Không cần cấu hình gì thêm trong .env, chỉ giữ nguyên:
  ```env
  FILESYSTEM_DISK=local
  ```
4. Khi deploy lên server thật, nên backup thư mục storage/ định kỳ để tránh mất dữ liệu.
### 2.6. Tài khoản mẫu đăng nhập
- Admin: admin@cameramam.com / admin123
- user: thanhnhon2k4@gmail.com / 123456
### 2.7. Chạy dự án
```bash
php artisan serve
```
Truy cập: http://127.0.0.1:8000
## Lưu ý
- Nếu gặp lỗi, kiểm tra lại cấu hình .env, quyền ghi thư mục storage, cache config: `php artisan config:cache`
- Đọc thêm hướng dẫn chi tiết trong README này hoặc liên hệ người phát triển.