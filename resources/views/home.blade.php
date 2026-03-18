@extends('layout.main')
@section('noidung')
    <!-- Hero Start -->
    <div class="container-fluid bg-primary py-5 mb-5 hero-header">
        <div class="container py-5">
            <div class="row justify-content-start">
                <div class="col-lg-8 text-center text-lg-start">
                    <h1 class="font-secondary text-primary mb-4">Ultra Sharp</h1>
                    <h1 class="display-1 text-uppercase text-white mb-4">CAMERAMAM</h1>
                    <h1 class="text-uppercase text-white">Edit • Retouch • Design</h1>
                    <div class="d-flex align-items-center justify-content-center justify-content-lg-start pt-5">
                        <a href="" class="btn btn-primary border-inner py-3 px-5 me-5">Read More</a>
                        <button type="button" class="btn-play" data-bs-toggle="modal"
                            data-src="https://www.youtube.com/embed/DWRcNpR6Kdc" data-bs-target="#videoModal">
                            <span></span>
                        </button>
                        <h5 class="font-weight-normal text-white m-0 ms-4 d-none d-sm-block">Play Video</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->


    <!-- Video Modal Start -->
    <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Youtube Video</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- 16:9 aspect ratio -->
                    <div class="ratio ratio-16x9">
                        <iframe class="embed-responsive-item" src="" id="video" allowfullscreen
                            allowscriptaccess="always" allow="autoplay"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Video Modal End -->


    <!-- About Start -->
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
    <!-- About End -->


    <!-- Facts Start -->
    <div class="container-fluid bg-img py-5 mb-5">
        <div class="container py-5">
            <div class="row gx-5 gy-4">
                <div class="col-lg-3 col-md-6">
                    <div class="d-flex">
                        <div class="bg-primary border-inner d-flex align-items-center justify-content-center mb-3"
                            style="width: 60px; height: 60px;">
                            <i class="fa fa-star text-white"></i>
                        </div>
                        <div class="ps-4">
                            <h6 class="text-primary text-uppercase">Our Experience</h6>
                            <h1 class="display-5 text-white mb-0" data-toggle="counter-up">12345</h1>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="d-flex">
                        <div class="bg-primary border-inner d-flex align-items-center justify-content-center mb-3"
                            style="width: 60px; height: 60px;">
                            <i class="fa fa-users text-white"></i>
                        </div>
                        <div class="ps-4">
                            <h6 class="text-primary text-uppercase">Photo Specialist</h6>
                            <h1 class="display-5 text-white mb-0" data-toggle="counter-up">12345</h1>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="d-flex">
                        <div class="bg-primary border-inner d-flex align-items-center justify-content-center mb-3"
                            style="width: 60px; height: 60px;">
                            <i class="fa fa-check text-white"></i>
                        </div>
                        <div class="ps-4">
                            <h6 class="text-primary text-uppercase">Complete Project</h6>
                            <h1 class="display-5 text-white mb-0" data-toggle="counter-up">12345</h1>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="d-flex">
                        <div class="bg-primary border-inner d-flex align-items-center justify-content-center mb-3"
                            style="width: 60px; height: 60px;">
                            <i class="fa fa-mug-hot text-white"></i>
                        </div>
                        <div class="ps-4">
                            <h6 class="text-primary text-uppercase">Happy Clients</h6>
                            <h1 class="display-5 text-white mb-0" data-toggle="counter-up">12345</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Facts End -->


   

    <!-- Service Start -->
    <div class="container-fluid service position-relative px-5 mt-5" style="margin-bottom: 135px;">
        <div class="container">
            <div class="section-title position-relative text-center mx-auto mb-5 pb-3" style="max-width: 600px;">
                <h2 class="text-primary font-secondary">Danh mục</h2>
                <h1 class="display-4 text-uppercase">Khám phá sản phẩm</h1>
            </div>
            <div class="row g-5">
                @forelse($categories as $category)
                <div class="col-lg-4 col-md-6 ">
                    <div class="bg-primary border-inner a text-center text-white p-5 box-rounded">
                        <h4 class="text-uppercase mb-3">{{ $category->name }}</h4>
                        <p>{{ $category->products_count }} sản phẩm</p>
                        <a href="{{ route('products.index', ['category' => $category->id]) }}" class="text-uppercase text-dark">
                            Xem thêm <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center">
                    <p class="text-muted">Chưa có danh mục nào</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
    <!-- Service End -->

 <!-- Offer Start -->
        <div class="container-fluid bg-offer my-5 py-5">
            <div class="container py-5">
                <div class="row gx-5 justify-content-center">
                    <div class="col-lg-7 text-center">
                        <div class="section-title position-relative text-center mx-auto mb-4 pb-3"
                            style="max-width: 600px;">
                            <h2 class="text-primary font-secondary">Ưu đãi đặc biệt</h2>
                            <h1 class="display-4 text-uppercase text-white">Giảm giá mùa hè</h1>
                        </div>
                        <p class="text-white mb-4">Nhận ngay ưu đãi 30% cho tất cả sản phẩm camera và phụ kiện trong mùa hè
                            này!</p>
                        <a href="{{ route('products.index') }}" class="btn btn-primary border-inner py-3 px-5 me-3">Xem
                            ngay</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Offer End -->
    <!-- Featured Products Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="section-title position-relative text-center mx-auto mb-5 pb-3" style="max-width: 600px;">
                <h2 class="text-primary font-secondary">Sản phẩm nổi bật</h2>
                <h1 class="display-4 text-uppercase">Sản phẩm mới nhất</h1>
            </div>
            <div class="row g-4">
                @forelse($featuredProducts as $product)
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 shadow-sm">
                        @if($product->image)
                        <img src="{{ asset('img/products/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" 
                             style="height: 300px; object-fit: cover;">
                        @else
                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 300px;">
                            <i class="fas fa-camera fa-3x text-muted"></i>
                        </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text text-muted mb-2">
                                <small>{{ $product->category->name ?? 'N/A' }} | {{ $product->brand->name ?? 'N/A' }}</small>
                            </p>
                            <p class="card-text">{{ Str::limit($product->description, 60) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <strong class="text-primary">{{ number_format($product->price, 0, ',', '.') }} VNĐ</strong>
                                <small class="badge bg-success">Tồn kho: {{ $product->stock }}</small>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent">
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary btn-sm w-100">
                                <i class="fas fa-eye me-2"></i>Xem chi tiết
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted">Chưa có sản phẩm nào</p>
                </div>
                @endforelse
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('products.index') }}" class="btn btn-primary border-inner py-3 px-5">
                    Xem tất cả sản phẩm <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- Featured Products End -->


    <!-- Recent Albums Start -->
    <div class="container-fluid py-5 bg-light">
        <div class="container">
            <div class="section-title position-relative text-center mx-auto mb-5 pb-3" style="max-width: 600px;">
                <h2 class="text-primary font-secondary">Album ảnh</h2>
                <h1 class="display-4 text-uppercase">Album gần đây</h1>
            </div>
            <div class="row g-4">
                @forelse($recentAlbums as $album)
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 shadow-sm">
                        @if($album->image)
                        <img src="{{ asset('img/albums/' . $album->image) }}" class="card-img-top" alt="{{ $album->title }}" 
                             style="height: 300px; object-fit: cover;">
                        @else
                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 300px;">
                            <i class="fas fa-image fa-3x text-muted"></i>
                        </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $album->title }}</h5>
                            @if($album->photographer_name)
                            <p class="card-text text-muted mb-2">
                                <i class="fas fa-user me-1"></i>{{ $album->photographer_name }}
                            </p>
                            @endif
                            <p class="card-text">
                                <small class="text-muted">{{ $album->images->count() }} ảnh</small>
                            </p>
                        </div>
                        <div class="card-footer bg-transparent">
                            <a href="{{ route('albums.show', $album->id) }}" class="btn btn-primary btn-sm w-100">
                                <i class="fas fa-eye me-2"></i>Xem album
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted">Chưa có album nào</p>
                </div>
                @endforelse
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('albums.index') }}" class="btn btn-primary border-inner py-3 px-5">
                    Xem tất cả album <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- Recent Albums End -->

    <!-- Old Service Section Start (Commented Out) -->
    {{-- 
    <div class="container-fluid service position-relative px-5 mt-5" style="margin-bottom: 135px;">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4 col-md-6">
                    <div class="bg-primary border-inner text-center text-white p-5">
                        <h4 class="text-uppercase mb-3">PHOTO SHOOT</h4>
                        <p>Ghi lại những khoảnh khắc đẹp và chân thật với phong cách chụp ảnh chuyên nghiệp, phù hợp cho cá
                            nhân và gia đình</p>
                        <a class="text-uppercase text-dark" href="">Read More <i
                                class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="bg-primary border-inner text-center text-white p-5">
                        <h4 class="text-uppercase mb-3">EVENT & WEDDING</h4>
                        <p>Dịch vụ chụp ảnh cưới và sự kiện, bắt trọn cảm xúc tự nhiên, lưu giữ những kỷ niệm đáng nhớ nhất.
                        </p>
                        <a class="text-uppercase text-dark" href="">Read More <i
                                class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="bg-primary border-inner text-center text-white p-5">
                        <h4 class="text-uppercase mb-3">PHOTO EDITING</h4>
                        <p>Chỉnh sửa và retouch ảnh chuyên sâu bằng Photoshop, mang đến hình ảnh sắc nét, ấn tượng và giàu
                            cảm xúc.</p>
                        <a class="text-uppercase text-dark" href="">Read More <i
                                class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-12 col-md-6 text-center">
                    <h1 class="text-uppercase text-light mb-4">30% Discount For This Summer</h1>
                    <a href="" class="btn btn-primary border-inner py-3 px-5">views Now</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Service Start -->
    --}}
    <!-- Old Service Section End (Commented Out) -->


    <!-- Team Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="section-title position-relative text-center mx-auto mb-5 pb-3 " style="max-width: 600px;">
                <h2 class="text-primary font-secondary">Team Members</h2>
                <h1 class="display-4 text-uppercase">Camera Man </h1>
            </div>
            <div class="row g-5">
                <div class="col-lg-4 col-md-6">
                    <div class="team-item">
                        <div class="position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="{{ asset('img/team-1.jpg') }}?v={{ time() }}" alt="">
                            <div
                                class="team-overlay w-100 h-100 position-absolute top-50 start-50 translate-middle d-flex align-items-center justify-content-center">
                                <div class="d-flex align-items-center justify-content-start">
                                    <a class="btn btn-lg btn-primary btn-lg-square border-inner rounded-0 mx-1"
                                        href="#"><i class="fab fa-twitter fw-normal"></i></a>
                                    <a class="btn btn-lg btn-primary btn-lg-square border-inner rounded-0 mx-1"
                                        href="#"><i class="fab fa-facebook-f fw-normal"></i></a>
                                    <a class="btn btn-lg btn-primary btn-lg-square border-inner rounded-0 mx-1"
                                        href="#"><i class="fab fa-linkedin-in fw-normal"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="bg-dark border-inner text-center p-4">
                            <h4 class="text-uppercase text-primary">Kim Trúc</h4>
                            <p class="text-white m-0">designer</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="team-item">
                        <div class="position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="{{ asset('img/team-2.jpg') }}?v={{ time() }}" alt="">
                            <div
                                class="team-overlay w-100 h-100 position-absolute top-50 start-50 translate-middle d-flex align-items-center justify-content-center">
                                <div class="d-flex align-items-center justify-content-start">
                                    <a class="btn btn-lg btn-primary btn-lg-square border-inner rounded-0 mx-1"
                                        href="#"><i class="fab fa-twitter fw-normal"></i></a>
                                    <a class="btn btn-lg btn-primary btn-lg-square border-inner rounded-0 mx-1"
                                        href="#"><i class="fab fa-facebook-f fw-normal"></i></a>
                                    <a class="btn btn-lg btn-primary btn-lg-square border-inner rounded-0 mx-1"
                                        href="#"><i class="fab fa-linkedin-in fw-normal"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="bg-dark border-inner text-center p-4">
                            <h4 class="text-uppercase text-primary">Phan Hoàng Linh</h4>
                            <p class="text-white m-0">photography</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="team-item">
                        <div class="position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="{{ asset('img/team-3.jpg') }}?v={{ time() }}" alt="">
                            <div
                                class="team-overlay w-100 h-100 position-absolute top-50 start-50 translate-middle d-flex align-items-center justify-content-center">
                                <div class="d-flex align-items-center justify-content-start">
                                    <a class="btn btn-lg btn-primary btn-lg-square border-inner rounded-0 mx-1"
                                        href="#"><i class="fab fa-twitter fw-normal"></i></a>
                                    <a class="btn btn-lg btn-primary btn-lg-square border-inner rounded-0 mx-1"
                                        href="#"><i class="fab fa-facebook-f fw-normal"></i></a>
                                    <a class="btn btn-lg btn-primary btn-lg-square border-inner rounded-0 mx-1"
                                        href="#"><i class="fab fa-linkedin-in fw-normal"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="bg-dark border-inner text-center p-4">
                            <h4 class="text-uppercase text-primary">Trương Hoàng Nam </h4>
                            <p class="text-white m-0">Ăn bám</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->


    <!-- Offer Start -->
    <div class="container-fluid bg-offer my-5 py-5">
        <div class="container py-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-7 text-center">
                    <div class="section-title position-relative text-center mx-auto mb-4 pb-3" style="max-width: 600px;">
                        <h2 class="text-primary font-secondary">Special Combo Pack</h2>
                        <h1 class="display-4 text-uppercase text-white">Creative Photo Services</h1>
                    </div>
                    <p class="text-white mb-4">Gói dịch vụ chụp ảnh và chỉnh sửa chuyên nghiệp, đáp ứng đa dạng nhu cầu từ
                        cá nhân đến sự kiện.
                        Chúng tôi tập trung vào chất lượng hình ảnh, cảm xúc tự nhiên và phong cách sáng tạo riêng biệt.
                        Mỗi sản phẩm đều được xử lý tỉ mỉ bằng Photoshop, mang đến những bức ảnh sắc nét và ấn tượng</p>
                    <a href="" class="btn btn-primary border-inner py-3 px-5 me-3">Shop Now</a>
                    <a href="" class="btn btn-dark border-inner py-3 px-5">Read More</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Offer End -->


    <!-- Testimonial Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="section-title position-relative text-center mx-auto mb-5 pb-3" style="max-width: 600px;">
                <h2 class="text-primary font-secondary">Testimonial</h2>
                <h1 class="display-4 text-uppercase">Our Clients Say!!!</h1>
            </div>
            <div class="owl-carousel testimonial-carousel">
                <div class="testimonial-item bg-dark text-white border-inner p-4">
                    <div class="d-flex align-items-center mb-3">
                        <img class="img-fluid flex-shrink-0" src="{{ asset('img/testimonial-1.jpg') }}?v={{ time() }}"
                            style="width: 60px; height: 60px;">
                        <div class="ps-3">
                            <h4 class="text-primary text-uppercase mb-1">Client Name</h4>
                            <span>Profession</span>
                        </div>
                    </div>
                    <p class="mb-0">Chúng tôi mang đến những khung hình sáng tạo, chân thật và đầy cảm xúc.
                        Mỗi bức ảnh đều được chăm chút kỹ lưỡng để kể câu chuyện riêng của bạn.
                    </p>
                </div>
                <div class="testimonial-item bg-dark text-white border-inner p-4">
                    <div class="d-flex align-items-center mb-3">
                        <img class="img-fluid flex-shrink-0" src="{{ asset('img/testimonial-2.jpg') }}?v={{ time() }}"
                            style="width: 60px; height: 60px;">
                        <div class="ps-3">
                            <h4 class="text-primary text-uppercase mb-1">Client Name</h4>
                            <span>Profession</span>
                        </div>
                    </div>
                    <p class="mb-0">Chúng tôi ghi lại khoảnh khắc tự nhiên bằng góc nhìn sáng tạo và kỹ thuật chuyên
                        nghiệp.
                        Hình ảnh không chỉ đẹp mà còn mang giá trị cảm xúc lâu dài.
                    </p>
                </div>
                <div class="testimonial-item bg-dark text-white border-inner p-4">
                    <div class="d-flex align-items-center mb-3">
                        <img class="img-fluid flex-shrink-0" src="{{ asset('img/testimonial-3.jpg') }}?v={{ time() }}"
                            style="width: 60px; height: 60px;">
                        <div class="ps-3">
                            <h4 class="text-primary text-uppercase mb-1">Client Name</h4>
                            <span>Profession</span>
                        </div>
                    </div>
                    <p class="mb-0">Từ chụp ảnh đến chỉnh sửa, mọi quy trình đều được thực hiện cẩn thận và tỉ mỉ.
                        Cam kết mang đến sản phẩm hoàn thiện, sắc nét và ấn tượng.
                    </p>
                </div>
                <div class="testimonial-item bg-dark text-white border-inner p-4">
                    <div class="d-flex align-items-center mb-3">
                        <img class="img-fluid flex-shrink-0" src="{{ asset('img/testimonial-4.jpg') }}?v={{ time() }}"
                            style="width: 60px; height: 60px;">
                        <div class="ps-3">
                            <h4 class="text-primary text-uppercase mb-1">Client Name</h4>
                            <span>Profession</span>
                        </div>
                    </div>
                    <p class="mb-0">Mỗi dự án là một câu chuyện hình ảnh riêng biệt.
                        Chúng tôi giúp bạn lưu giữ kỷ niệm theo cách chân thật và tinh tế nhất.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->
@endsection

