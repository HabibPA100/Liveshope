<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AllBuyerShowController;
use App\Http\Controllers\Admin\AllSellerShowController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\SubscriptionPlanController;
use App\Http\Controllers\Admin\AdminNotificationController;
use App\Http\Controllers\Admin\AdminSubscriptionController;
use App\Http\Controllers\Admin\BuyerOrderListPDFController;
use App\Http\Controllers\Admin\EditProductStatusController;

Route::get('/create-admin-account', [AdminDashboardController::class,'create'])->name('admin.account.create');


Route::middleware('auth:admin')->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/show-message', [AdminDashboardController::class, 'message'])->name('all.message');
    Route::get('/notification/details/{id}', [AdminNotificationController::class, 'show'])
                ->name('admin.notification.details');

    Route::get('/notification/{id}/pdf', [AdminNotificationController::class, 'downloadNotificationPdf'])
            ->name('notification.download.pdf');
    
    Route::get('/buyer-order-list-pdf', [BuyerOrderListPDFController::class, 'index'])->name('buyer.order.list');

    // PDF ডাউনলোড
    Route::get('/admin/order-download/{id}', [BuyerOrderListPDFController::class, 'downloadOrderForm'])
            ->name('admin.order.download');

    Route::get('/edit-status/{order}', function (\App\Models\Order $order) {
            return view('frontend.admin.orders.status-update', compact('order'));
                })->name('order-status.edit');
    Route::put('/orders/update-status/{order}', [EditProductStatusController::class, 'updateStatus'])
    ->name('admin.orders.update-status');

    Route::get('/all-buyer-show',[AllBuyerShowController::class, 'buyerShow'])->name('all.buyer.show');

    Route::get('/all-seller-show',[AllSellerShowController::class, 'sellerShow'])->name('all.seller.show');
    Route::get('/sellers/{id}/edit', [AllSellerShowController::class, 'edit'])->name('admin.seller.edit');
    Route::put('/sellers/{id}', [AllSellerShowController::class, 'update'])->name('admin.seller.update');
    Route::delete('/sellers/{id}', [AllSellerShowController::class, 'destroy'])->name('admin.seller.destroy');
    Route::patch('/sellers/{id}/status', [AllSellerShowController::class, 'updateStatus'])->name('admin.seller.status');

    //  Edit Admin Profile 
    Route::get('profile', [AdminProfileController::class, 'profile'])->name(('admin.profile'));
    Route::put('/admin/profile', [AdminProfileController::class, 'update'])->name('admin.profile.update');

    Route::resource('plans', SubscriptionPlanController::class);

    Route::get('/subscriptions', [AdminSubscriptionController::class, 'index'])->name('admin.subscriptions');
    Route::get('/subscriptions/{id}/edit', [AdminSubscriptionController::class, 'edit'])->name('admin.subscriptions.edit');
    Route::patch('/subscriptions/{id}/update', [AdminSubscriptionController::class, 'update'])->name('admin.subscriptions.update');

    Route::resource('categories', CategoryController::class)->names('admin.categories');
});
