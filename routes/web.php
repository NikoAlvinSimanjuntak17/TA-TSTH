<?php

use App\Http\Controllers\Admin\DasboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\GalleryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class,'index']);

Route::controller(ClientController::class)->group(function(){
    Route::get('/','index')->name('home');
    Route::get('/produk/category/{id}','CategoryPage')->name('category');
    Route::get('/produk-details/{id}','SingleProduct')->name('singleproduct');
    Route::get('/produk','Product')->name('product');
    Route::post('/add-product-to-cart','AddProductToCart')->name('addproducttocart');
    Route::get('/keranjang','AddToCart')->name('addtocart');
    Route::post('/place-order','PlaceOrder')->name('placeorder');
    Route::post('/user-profile/pedding-orders/bayar/{id}','uploadbayar')->name('uploadbayar');
    Route::post('/user-profile/dashboard/updateprofil','updateprofile')->name('updateprofile');
    Route::post('/user-profile/dashboard/editprofil','editprofile')->name('editprofile');
    Route::post('/user-profile/riwayat/{id}','komentar')->name('komentar.post');
    Route::get('/cart/delete/{id}','deletecart')->name('deletecart');
    Route::get('/user-profile/pedding-orders/delete/{id}','orderdelete')->name('orderdelete');
    Route::get('/products/{id}/increment','incrementQuantity')->name('products.increment');
    Route::get('/checkout','Checkout')->name('checkout');
    Route::get('/products/{id}/decrement', 'decrementQuantity')->name('products.decrement');
    Route::post('add-shipping-address','AddShippingAddress')->name('addshippingaddress');
    Route::post('user-profile/pedding-orders/{id}', 'orderDelivered')->name('orderDelivered');
    Route::get('/products/{productId}/comments','showComments')->name('product.comments');
    Route::post('/items/{id}','update')->name('items.update');
    Route::get('/user-profile','UserProfile')->name('userprofile');
    Route::get('/user-profile/pembelian','PeddingOrders')->name('peddingorders');
    Route::get('/user-profile/pedding-orders/{id}','PeddingOrdersDetil')->name('peddingordersdetil');
    Route::get('/user-profile/riwayat/{id}','HistoryDetil')->name('historidetil');
    Route::get('/user-profile/riwayat','History')->name('history');
    Route::get('todays-deal','TodayDeal')->name('todaydeal');
    Route::get('/custom-service','CustomerService')->name('customerservice');
    Route::get('/remove-cart-item/{id}','RemoveCartItem')->name('removeitem');
    Route::get('/profile/edit-profile','editprofil')->name('editprofil');
    Route::post('/user-profile/editgambar','updategambar')->name('updategambar');
    Route::get('/cart/count', 'getCartCount')->name('cartcount');
    Route::post('/reservasi', 'storeReservation')->name('reservasi.store');
    Route::get('/reservasi', 'showReservations')->name('reservations');
    Route::get('/peddingreservations', 'PeddingReservations')->name('peddingreservations');
    Route::get('reservation/{id}/edit', 'editReservation')->name('editreservation');
    Route::put('reservation/{id}/edit', 'updateReservation')->name('updatereservation');
    Route::get('reservation/{id}/confirmdelete', 'confirmDeleteReservation')->name('confirmdeletereservation');
    Route::delete('reservation/{id}/confirmdelete','destroyReservation')->name('deletereservation');
    Route::get('/payment/{id}', 'showPaymentForm')->name('payment');
    Route::post('/feedback', 'storeFeedback')->name('feedback.store');
    Route::get('/feedback', 'Feedback')->name('feedback');
    Route::get('/print-struk/{orderId}', 'printStruk')->name('print.struk');
    Route::post('/updateOrderStatus', 'updateOrderStatus')->name('updateOrderStatus');



    Route::get('/updateOrderStatus/{orderId}', 'updateOrderStatus')->name('updateOrderStatus');
});

Route::get('/checkLogin', function () {
    if (Auth::check()) {
        return response()->json(['message' => 'Logged in'], 200);
    } else {
        return response()->json(['message' => 'Not logged in'], 401);
    }
})->name('checkLogin');



Route::middleware(['auth','role:customer'])->group(function(){
    Route::controller(ClientController::class)->group(function(){

        // Route::get('/dashboard','index')->name('home');

    });
});


Route::middleware('auth')->group(function () { /* middleware auth digunakan untuk memastikan bahwa hanya pengguna yang sudah melakukan autentikasi (login) yang dapat mengakses route yang terdaftar dalam group ini. Jika pengguna belum melakukan autentikasi, maka sistem akan mengarahkan pengguna ke halaman login terlebih dahulu sebelum pengguna dapat mengakses route yang ditentukan. */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::middleware(['auth','role:admin'])->group(function(){
    Route::controller(DasboardController::class)->group(function(){
        Route::get('admin/dashboard','index')->name('admindasboard');
        Route::get('admin/favorit', 'favorit')->name('adminfavorit');
        Route::get('admin/dasboard/{id}','read')->name('read');
        Route::get('admin/edit-profil','editprofileadmin')->name('editprofileadmin');

    });
    Route::controller(CategoryController::class)->group(function(){
        Route::get('/admin/all-category','Index')->name('allcategory');
        Route::get('/admin/add-category','AddCategory')->name('addcategory');
        Route::post('admin/store-category','StoreCategory')->name('storecategory');
        Route::get('admin/edit-category/{id}','EditCategory')->name('editcategory');
        Route::post('admin/update-category','UpdateCategory')->name('updatecategory');
        Route::get('admin/delete-category/{id}','DeleteCategory')->name('deletecategory');
    });

    Route::controller(ProductController::class)->group(function(){
        Route::get('/admin/all-products','index')->name('allproduct');
        Route::get('/admin/add-product','AddProduct')->name('addproduct');
        Route::post('/admin/store-product','StoreProduct')->name('storeproduct');
        Route::get('/admin/edit-product-img/{id}','EditProductImg')->name('editproductimg');
        Route::post('/admin/update-product-img','UpdateProductImg')->name('updateproductimg');
        Route::get('/admin/edit-product/{id}','EditProduct')->name('editproduct');
        Route::post('/admin/update-product','UpdateProduct')->name('updateproduct');
        Route::get('admin/delete-product/{id}','DeleteProduct')->name('deleteproduct');
        Route::get('admin/export-excel',  'exportExcel')->name('export.excel');
    });
    Route::controller(OrderController::class)->group(function(){
        Route::get('/admin/pending-order','index')->name('pendingorder');
        Route::get('/admin/pending-order/{id}','detail')->name('pendingorderdetail');
        Route::post('/orders/approve/{id}', 'approveOrder')->name('approveOrder');
        Route::post('/orders/cancel/{id}', 'cancelOrder')->name('cancelOrder');
        Route::post('/admin/pending-order/{id}','detail')->name('orderadmin');
        Route::get('/orders/{id}', 'rejectOrder')->name('rejectOrder');
        Route::get('/export-excel',  'exportExcel')->name('export.excel.order');

    });
    Route::controller(ReservationController::class)->group(function(){
        Route::get('/admin/pending-reservation','index')->name('pendingreservation');
        Route::get('/admin/pending-reservation/{id}','detail')->name('pendingreservationdetail');
        Route::post('/reservations/approve/{id}', 'approveReservation')->name('approveReservation');
        Route::post('/reservations/cancel/{id}', 'cancelReservation')->name('cancelReservation');
        Route::post('/admin/pending-reservation/{id}','detail')->name('reservationadmin');
        Route::get('/reservations/{id}', 'rejectReservation')->name('rejectReservation');
    });
    Route::controller(GalleryController::class)->group(function(){
        Route::get('/admin/gallery',  'index')->name('admin.gallery.index');
        Route::get('/admin/gallery/create', 'createGallery')->name('admin.gallery.create');
        Route::post('/admin/gallery/store','StoreGallery')->name('admin.gallery.store');
        Route::get('/admin/gallery/edit/{id}',  'editGallery')->name('admin.gallery.edit');
        Route::put('/admin/gallery/update/{id}', 'update')->name('admin.gallery.update');
        Route::delete('/admin/gallery/destroy/{id}', 'destroy')->name('admin.gallery.destroy');
    });
});
require __DIR__.'/auth.php';