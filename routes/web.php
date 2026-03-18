<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\AlbumController as AdminAlbumController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\AIChatController;
use App\Http\Controllers\ReviewController;
// ==================== PUBLIC ROUTES ====================
Route::get('/', [HomeController::class, 'index'])->name('home');

// Contact Routes
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Authentication Routes
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/verify-otp', [AuthController::class, 'showVerifyOTPForm'])->name('verify.otp.form');
Route::post('/verify-otp', [AuthController::class, 'verifyOTP'])->name('verify.otp');
Route::post('/resend-otp', [AuthController::class, 'resendOTP'])->name('resend.otp');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Product Routes (Public)
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// Album Routes (Public)
Route::get('/albums', [ProductController::class, 'albums'])->name('albums.index');
Route::get('/albums/{id}', [ProductController::class, 'albumDetail'])->name('albums.show');

// About Page
Route::view('/about', 'about')->name('about');

// ==================== USER AUTHENTICATED ROUTES ====================
Route::middleware(['auth'])->group(function () {
    
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile/info', [ProfileController::class, 'updateInfo'])->name('profile.updateInfo');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
    Route::get('/profile/password/verify-otp', [ProfileController::class, 'showPasswordOTPForm'])->name('profile.password.verify.form');
    Route::post('/profile/password/verify-otp', [ProfileController::class, 'verifyPasswordOTP'])->name('profile.password.verify');
    Route::post('/profile/password/resend-otp', [ProfileController::class, 'resendPasswordOTP'])->name('profile.password.resend');
    Route::post('/profile/address', [ProfileController::class, 'addAddress'])->name('profile.addAddress');
    Route::put('/profile/address/{id}', [ProfileController::class, 'updateAddress'])->name('profile.updateAddress');
    Route::delete('/profile/address/{id}', [ProfileController::class, 'deleteAddress'])->name('profile.deleteAddress');
    
    // Cart Routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/{itemId}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{itemId}', [CartController::class, 'remove'])->name('cart.remove');
    
    // Order Routes
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('orders.checkout');
    Route::post('/checkout', [OrderController::class, 'processCheckout'])->name('orders.process');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{id}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
    Route::post('/orders/{id}/return', [OrderController::class, 'returnOrder'])->name('orders.return');

    // Payment Routes
    Route::get('/payment/{orderId}', [PaymentController::class, 'pay'])->name('payment.pay');
    Route::get('/payment-return', [PaymentController::class, 'return'])->name('payment.return');
    Route::post('/orders/{order}/products/{product}/review', [ReviewController::class, 'store'])->name('orders.products.review');
});



// ==================== ADMIN ROUTES ====================
Route::prefix('admin')->name('admin.')->middleware(['auth', 'is_admin'])->group(function () {
    
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // Reports
    Route::get('reports/export', [ReportController::class, 'export'])->name('reports.export');
    
    // Product Management
    Route::resource('products', AdminProductController::class);
    
    // User Management
    Route::resource('users', AdminUserController::class);
    
    // Album Management
    Route::resource('albums', AdminAlbumController::class);
    
    // Album Images Management
    Route::post('albums/{album}/images', [AdminAlbumController::class, 'uploadImages'])->name('albums.images.store');
    Route::delete('albums/{album}/images/{image}', [AdminAlbumController::class, 'deleteImage'])->name('albums.images.destroy');
    
    // Order Management
    Route::get('orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{id}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::patch('orders/{id}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::post('orders/{id}/return/approve', [AdminOrderController::class, 'approveReturn'])->name('orders.return.approve');
    Route::post('orders/{id}/return/reject', [AdminOrderController::class, 'rejectReturn'])->name('orders.return.reject');
});

