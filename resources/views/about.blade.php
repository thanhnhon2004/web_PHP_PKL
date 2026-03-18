@extends('layout.main')
@section('noidung')
<div class="container my-5">
       <!-- About Start -->
        <section class="row align-items-center mb-5">
    <div class="container-fluid pt-5">
        <div class="container">
            <div class="section-title position-relative text-center mx-auto mb-5 pb-3" style="max-width: 600px;">
                <h2 class="text-primary font-secondary">About Us</h2>
                <h1 class="display-4 text-uppercase">Welcome To CAMERAMAM</h1>
            </div>
            <div class="row gx-5">
                <div class="col-lg-5 mb-5 mb-lg-0" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100"
                            src="{{ asset('img/about.jpg') }}?v={{ @filemtime(public_path('img/about.jpg')) }}"
                            style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-6 pb-5">
                    <h4 class="mb-4">Chúng tôi là đội ngũ chụp ảnh và quay phim chuyên nghiệp, luôn đặt cảm xúc và khoảnh
                        khắc của khách hàng lên hàng đầu.</h4>
                    <p class="mb-5">Với kinh nghiệm thực tế và phong cách sáng tạo, Cameraman mang đến những sản phẩm hình
                        ảnh chân thực, sắc nét và đầy cảm hứng.
                        Chúng tôi đồng hành cùng bạn trong mọi khoảnh khắc quan trọng, từ cá nhân, gia đình đến sự kiện và
                        dự án thương mại.</p>
                    <div class="row g-5">
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center justify-content-center bg-primary border-inner mb-4"
                                style="width: 90px; height: 90px;">
                                <i class="fa-solid fa-images fa-2x text-white"></i>
                            </div>
                            <h4 class="text-uppercase">100% Professional</h4>
                            <p class="mb-0">Cam kết chất lượng hình ảnh sắc nét, chỉnh sửa tỉ mỉ và phong cách sáng tạo
                                trong từng sản phẩm.</p>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center justify-content-center bg-primary border-inner mb-4"
                                style="width: 90px; height: 90px;">
                                <i class="fa fa-award fa-2x text-white"></i>
                            </div>
                            <h4 class="text-uppercase">Award Winning</h4>
                            <p class="mb-0">Được khách hàng tin tưởng và đánh giá cao qua nhiều dự án chụp ảnh và quay
                                phim thực tế
                            <div class=""> </div>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        </section>
    <!-- About End -->
    <!-- Section 1: Giới thiệu cửa hàng (bố cục ảnh trái, text phải) -->
    <section class="row align-items-center mb-5">
        <div class="col-lg-6 mb-4 mb-lg-0">
            <img src="{{ asset('img/about_store.jpg') }}" alt="Giới thiệu cửa hàng" class="img-fluid rounded shadow-sm w-100" style="object-fit:cover; min-height:320px;">
        </div>
        <div class="col-lg-6">
            <span class="badge bg-primary mb-2" style="font-family:'Oswald',sans-serif;letter-spacing:1px;">VỀ CHÚNG TÔI</span>
            <h2 class="mb-3 font-weight-bold" style="font-family:'Oswald',sans-serif; color:var(--dark);">Cửa hàng máy ảnh uy tín, đồng hành cùng đam mê nhiếp ảnh</h2>
            <p class="mb-4" style="color:var(--dark);font-size:1.1rem;">Chào mừng bạn đến với cửa hàng máy ảnh của chúng tôi! Chúng tôi tự hào là địa chỉ tin cậy cho những ai đam mê nhiếp ảnh, cung cấp đa dạng sản phẩm, dịch vụ chất lượng và đội ngũ tư vấn tận tâm.</p>
            <div class="d-flex align-items-center mb-3">
                <h3 class="mb-0 font-weight-bold" style="color:var(--primary);font-size:2.5rem;">1800+</h3>
                <span class="ms-3" style="font-size:1.1rem; color:var(--dark);">Khách hàng hài lòng</span>
            </div>
            <a href="{{ route('products.index') }}" class="btn btn-primary px-4 me-2">Xem sản phẩm</a>
            <a href="{{ route('contact') }}" class="btn btn-outline-primary px-4">Liên hệ</a>
        </div>
    </section>

    <!-- Section 2: Giới thiệu các hãng máy ảnh (text trái, ảnh phải, lưới ảnh) -->
    <section class="row align-items-center mb-5 flex-lg-row-reverse">
        <div class="col-lg-6 mb-4 mb-lg-0">
            <div class="row g-3">
                <div class="col-6">
                    <img src="{{ asset('img/canon.jpg') }}" alt="Canon" class="img-fluid rounded shadow-sm w-100" style="object-fit:cover; height:250px;">
                </div>
                <div class="col-6">
                    <img src="{{ asset('img/nikon.jpg') }}" alt="Nikon" class="img-fluid rounded shadow-sm w-100" style="object-fit:cover; height:250px;">
                </div>
                <div class="col-12">
                    <img src="{{ asset('img/sony.jpg') }}" alt="Sony" class="img-fluid rounded shadow-sm w-100" style="object-fit:cover; height:120px;">
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <span class="badge bg-secondary mb-2" style="font-family:'Oswald',sans-serif;letter-spacing:1px; color:var(--primary);background:var(--secondary);">HÃNG NỔI BẬT</span>
            <h2 class="mb-3 font-weight-bold" style="font-family:'Oswald',sans-serif; color:var(--dark);">Các thương hiệu máy ảnh hàng đầu</h2>
            <p class="mb-3" style="color:var(--dark);font-size:1.1rem;">Chúng tôi phân phối các thương hiệu nổi tiếng như Canon, Nikon, Sony... đáp ứng mọi nhu cầu từ người mới đến chuyên nghiệp.</p>
            <ul class="list-unstyled mb-0">
                <li class="mb-2"><strong style="color:var(--primary);">Canon:</strong> Đa dạng mẫu mã, chất lượng vượt trội.</li>
                <li class="mb-2"><strong style="color:var(--primary);">Nikon:</strong> Bền bỉ, sắc nét, được nhiều nhiếp ảnh gia tin dùng.</li>
                <li><strong style="color:var(--primary);">Sony:</strong> Công nghệ cảm biến tiên tiến, thiết kế hiện đại.</li>
            </ul>
        </div>
    </section>

    <!-- Section 3: Dịch vụ (bố cục lưới, card hiện đại) -->
    <section class="mb-5">
        <span class="badge bg-primary mb-2" style="font-family:'Oswald',sans-serif;letter-spacing:1px;">DỊCH VỤ</span>
        <h2 class="mb-4 font-weight-bold" style="font-family:'Oswald',sans-serif; color:var(--dark);">Dịch vụ nổi bật tại website</h2>
        <div class="row g-4">
            <!-- Card lớn bên trái -->
            <div class="col-md-6">
                <div class="card h-100 shadow-sm border-0 d-flex flex-row align-items-center" style="background:var(--secondary); min-height:260px;">
                    <img src="{{ asset('img/service_sell.jpg') }}" alt="Bán sản phẩm" class="img-fluid rounded-start" style="min-width:120px; min-height:120px; object-fit:cover; margin:24px;">
                    <div class="card-body">
                        <span class="badge bg-warning text-dark mb-2" style="font-size:1rem;">2000+ đơn</span>
                        <h5 class="card-title font-weight-bold mb-2" style="color:var(--primary);font-family:'Oswald',sans-serif;">Bán sản phẩm</h5>
                        <ul class="mb-0 ps-3" style="color:var(--dark); font-size:1rem;">
                            <li>Máy ảnh, ống kính, phụ kiện chính hãng</li>
                            <li>Giá cạnh tranh, bảo hành uy tín</li>
                            <li>Hỗ trợ tư vấn tận tâm</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- 2 card nhỏ bên phải -->
            <div class="col-md-6 d-flex flex-column gap-4">
                <div class="card flex-grow-1 shadow-sm border-0 d-flex flex-row align-items-center" style="background:var(--secondary); min-height:120px;">
                    <img src="{{ asset('img/service_rent.jpg') }}" alt="Cho thuê máy ảnh" class="img-fluid rounded-start" style="min-width:120px; min-height:120px; object-fit:cover; margin:16px;">
                    <div class="card-body">
                        <span class="badge bg-warning text-dark mb-2" style="font-size:0.95rem;">500+ lượt</span>
                        <h6 class="card-title font-weight-bold mb-2" style="color:var(--primary);font-family:'Oswald',sans-serif;">Cho thuê máy ảnh</h6>
                        <ul class="mb-0 ps-3" style="color:var(--dark); font-size:0.98rem;">
                            <li>Đa dạng máy, ống kính</li>
                            <li>Linh hoạt theo nhu cầu</li>
                        </ul>
                    </div>
                </div>
                <div class="card flex-grow-1 shadow-sm border-0 d-flex flex-row align-items-center" style="background:var(--secondary); min-height:120px;">
                    <img src="{{ asset('img/service_photographer.jpg') }}" alt="Book thợ chụp" class="img-fluid rounded-start" style="min-width:120px; min-height:120px;     object-fit:cover; margin:16px;">
                    <div class="card-body">
                        <span class="badge bg-warning text-dark mb-2" style="font-size:0.95rem;">300+ sự kiện</span>
                        <h6 class="card-title font-weight-bold mb-2" style="color:var(--primary);font-family:'Oswald',sans-serif;">Book thợ chụp</h6>
                        <ul class="mb-0 ps-3" style="color:var(--dark); font-size:0.98rem;">
                            <li>Kết nối nhiếp ảnh gia chuyên nghiệp</li>
                            <li>Đặt lịch nhanh chóng</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
                     