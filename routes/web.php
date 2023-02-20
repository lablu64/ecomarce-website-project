<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboradController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'Index')->name('home');
   
});












Route::controller(ClientController::class)->group(function () {
    Route::get('/category/{id}/{slug}', 'CategoryPages')->name('categorypages');
    Route::get('/product-details/{id}/{slug}', 'SingleProduct')->name('sigleproduct');
    Route::get('/new-release', 'NewRelease')->name('newrelease');
     });





Route::middleware(['auth', 'role:user'])->group(function (){
    
    Route::controller(ClientController::class)->group(function () {
     Route::get('/add-to-cart', 'AddToCart')->name('addtocart');
     Route::post('/add-product-to-cart', 'AddProductToCart')->name('addproducttocard');
     Route::get('/shipping-address', 'GetShippingAddress')->name('shippingaddress');
     Route::post('/add-shipping-address', 'AddShippingAddress')->name('addshippingaddress');
     Route::post('/place-order', 'PlaceOrder')->name('placeorder');
     Route::get('/checkout', 'Checkout')->name('checkout');
    Route::get('/user-profile', 'UserProfile')->name('userprofile');
    Route::get('/user-profile/pending-orders', 'PendingOrders')->name('pendingorders');
    Route::get('/user-profile/history', 'History')->name('history');
     Route::get('/todays-deal', 'TodaysDeal')->name('todaysdeal');
    Route::get('/customer-services', 'CustomerServices')->name('customerservices');
    Route::get('/admin/remove-card-item/{id}', 'RemoveCardItem')->name('removecarditem');
    
}); 

});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth','role:user', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::controller(DashboradController::class)->group(function () {
        Route::get('/admin/dashboard', 'Index')->name('admindashboard');
       
    });

    Route::controller(CategoryController::class)->group(function () {
        Route::get('/admin/all-category', 'Index')->name('allcategory');
        Route::get('/admin/add-category', 'AddCategory')->name('addcategory');
        Route::post('/admin/store-category', 'StoreCategory')->name('storecategory');
        Route::get('/admin/edit-category/{id}', 'EditCategory')->name('editcategory');
        Route::post('/admin/update-category', 'UpdateCategory')->name('updatecategory');
        Route::get('/admin/delete-category/{id}', 'DeleteCategory')->name('deletecategory');
    });

    Route::controller(SubCategoryController::class)->group(function () {
        Route::get('/admin/all-subcategory', 'Index')->name('allsubcategory');
        Route::get('/admin/add-subcategory', 'AddSubCategory')->name('addsubcategory');
        Route::post('/admin/store-subcategory', 'StoreSubCategory')->name('storesubcategory');
        
         Route::get('/admin/edit-subcategory/{id}', 'EditSubCate')->name('editsubcate');
         Route::post('/admin/update-subcategory', 'UpdateSubCat')->name('updatesubcate');
         Route::get('/admin/delete-subcategory/{id}', 'DeleteSubCate')->name('deletesubcate');
    });

    Route::controller(ProductController::class)->group(function () {
        Route::get('/admin/all-products', 'Index')->name('allproducts');
        Route::get('/admin/add-products', 'AddProducts')->name('addproducts');
        Route::POST('/admin/store-product', 'StoreProduct')->name('storeproduct');
        Route::get('/admin/edit-product-img/{id}' ,'EditProductImg')->name('editproductimg');
        Route::post('/admin/update-product-img','UpdateProductImg')->name('updateproductimg');
        Route::get('/admin/edit-produt/{id}','EditProduct')->name('editproduct');
        Route::post('/admin/update-produt' ,'UpdateProduct')->name('updateproduct');
        Route::get('/admin/delete-produt/{id}','DeleteProduct')->name('deleteproduct');
    });

    Route::controller(OrderController::class)->group(function () {
        Route::get('/admin/all-pending', 'Index')->name('allpendingoders');
       
    });
   

});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
