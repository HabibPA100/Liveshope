<?php

use App\Livewire\CartPage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TermsController;
use App\Livewire\Buyer\BuyerRegistration;
use App\Http\Controllers\LogOutController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GetCartController;
use App\Http\Controllers\PrivacyController;
use App\Http\Controllers\ServiceController;
use App\Livewire\Seller\SellerRegistration;
use App\Http\Controllers\AllClothController;
use App\Http\Controllers\CartViewController;
use App\Http\Controllers\CommissionController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\AllProductShowController;
use App\Http\Controllers\Auth\UserLoginController;
use App\Http\Controllers\BuyerDashboardController;
use App\Http\Controllers\SellerDashboardController;
use App\Http\Controllers\Seller\NotificationController;
use App\Http\Controllers\Seller\ShowOrderListController;
use App\Http\Controllers\Buyer\BuyerNotificationController;

Route::get('/create-product', function(){
    return view('frontend.admin.products.new-product');
});
Route::get('/about-us', [AboutUsController::class,'index'])->name('about.us');
Route::get('/services', [ServiceController::class,'index'])->name('service');
Route::get('/privacy-policy', [PrivacyController::class,'index'])->name('privacy');
Route::get('/contact-us', [ContactController::class,'index'])->name('contact');
Route::post('/contact-store', [ContactController::class,'send'])->name('contact.send');
Route::get('/terms-and-conditions', [TermsController::class,'index'])->name('terms.condition');
Route::get('/view-cart-details/{id}', [CartViewController::class, 'show'])->name('cart.details');
Route::get('/category/{categoryPath}', [GetCartController::class, 'showByCategoryPath'])
    ->where('categoryPath', '.*')
    ->name('products.by-category');
// Route::get('/categories/{category}', [GetCartController::class, 'show'])->name('categories.show');

Route::get('/cloth-shop', [AllClothController::class, 'index'])->name('all.cloth');
Route::get('/cart-info', CartPage::class)->middleware(['buyer-auth']);
Route::get('/all-product-list',[AllProductShowController::class,'index'])->name('all.product');

Route::get('/register-as-buyer', BuyerRegistration::class)->name('buyer');
Route::get('/register-as-seller', SellerRegistration::class)->name('seller');
Route::get('/user/login', [UserLoginController::class, 'index'])->name('login');

Route::middleware('auth:buyer')->prefix('buyer')->group(function () {
    
    Route::get('/dashboard', [BuyerDashboardController::class, 'dashboard'])->name('buyer.dashboard');

    Route::get('/notifications/{id}', [BuyerNotificationController::class, 'show'])
    ->name('buyer.notification.details');
});

Route::middleware('auth:seller')->prefix('seller')->group(function () {

    Route::get('/dashboard', [SellerDashboardController::class, 'dashboard'])->name('seller.dashboard');
    Route::get('/commission', [ CommissionController::class, 'commission'])->name('commission');
    
    Route::post('/subscription', [SubscriptionController::class, 'store'])->name('subscription.store');
    
    Route::get('/create-new-product', function () {
        $user = Auth::user();
        return view('frontend.seller.new-product', compact('user'));
    })->name('create.product');
    
    Route::get('/notification/details/{id}', [NotificationController::class, 'show'])
                ->name('seller.notification.details');

    Route::get('/total-order-list', [ShowOrderListController::class, 'index'])->name('show.order.list');

});

Route::post('/logout', [LogOutController::class, 'logout'])->name('logout');

require __DIR__.'/home.php';
require __DIR__.'/password-reset.php';
require __DIR__.'/admin.php';