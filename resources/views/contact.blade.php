@extends('layout.main')
@section('noidung')
    
    <!-- Page Header Start -->
    <div class="container-fluid bg-dark bg-img p-5 mb-5">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 text-uppercase text-white">Liên hệ với chúng tôi</h1>
                <a href="{{ route('home') }}" class="text-white">Trang chủ</a>
                <i class="far fa-square text-primary px-2"></i>
                <span class="text-white">Liên hệ</span>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Contact Start -->
    <div class="container-fluid contact position-relative px-5" style="margin-top: 90px;">
        <div class="container">
            <div class="row g-5 mb-5">
                <div class="col-lg-4 col-md-6">
                    <div class="bg-primary border-inner text-center text-white p-5">
                        <i class="bi bi-geo-alt fs-1 text-white"></i>
                        <h6 class="text-uppercase my-2">Địa chỉ</h6>
                        <span>{{ $contactInfo['address'] ?? 'N/A' }}</span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="bg-primary border-inner text-center text-white p-5">
                        <i class="bi bi-envelope-open fs-1 text-white"></i>
                        <h6 class="text-uppercase my-2">Email</h6>
                        <a href="mailto:{{ $contactInfo['email'] ?? '#' }}" class="text-white text-decoration-none">
                            {{ $contactInfo['email'] ?? 'N/A' }}
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="bg-primary border-inner text-center text-white p-5">
                        <i class="bi bi-phone-vibrate fs-1 text-white"></i>
                        <h6 class="text-uppercase my-2">Điện thoại</h6>
                        <a href="tel:{{ $contactInfo['phone'] ?? '#' }}" class="text-white text-decoration-none">
                            {{ $contactInfo['phone'] ?? 'N/A' }}
                        </a>
                    </div>
                </div>
            </div>

            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <input type="text" name="name" class="form-control bg-light border-0 px-4 @error('name') is-invalid @enderror" 
                                       placeholder="Tên của bạn" value="{{ old('name') }}" style="height: 55px;" required>
                                @error('name')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-sm-6">
                                <input type="email" name="email" class="form-control bg-light border-0 px-4 @error('email') is-invalid @enderror" 
                                       placeholder="Email" value="{{ old('email') }}" style="height: 55px;" required>
                                @error('email')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-sm-12">
                                <input type="text" name="subject" class="form-control bg-light border-0 px-4 @error('subject') is-invalid @enderror" 
                                       placeholder="Tiêu đề" value="{{ old('subject') }}" style="height: 55px;" required>
                                @error('subject')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-sm-12">
                                <textarea name="message" class="form-control bg-light border-0 px-4 py-3 @error('message') is-invalid @enderror" 
                                          rows="4" placeholder="Tin nhắn" required>{{ old('message') }}</textarea>
                                @error('message')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-sm-12">
                                <button class="btn btn-primary border-inner w-100 py-3" type="submit">Gửi tin nhắn</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->

@endsection