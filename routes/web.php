<?php

use App\Http\Controllers\indexController;
use App\Http\Controllers\authController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\userController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\settingController;
use App\Http\Controllers\productsController;

use Illuminate\Support\Facades\Route;

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

/*
Route::get('/', function () {
    return view('layouts/app');
});
*/

//Route::get('/', [indexController::class, 'index']);

 
Route::controller(indexController::class)->group(function () {
    Route::get('/', 'index')->name('/')->middleware('guest');
    Route::get('/read', 'read')->name('read.post')->middleware('guest');
    Route::get('/list_post', 'list_post')->name('list_post')->middleware('guest');
    Route::post('/subscribe', 'subscribe')->name('subscribe')->middleware('guest');
    Route::get('/unsubscribe', 'unsubscribe')->name('unsubscribe')->middleware('guest');

    Route::get('/about_us', 'about_us')->name('about_us')->middleware('guest');
    Route::get('/contact_us', 'contact_us')->name('contact_us')->middleware('guest');
    Route::post('/contact_us', 'contact_us_post')->name('contact_us.post')->middleware('guest');

    Route::get('/list_product', 'list_product')->name('list_product')->middleware('guest');

    Route::get('/cart_product', 'cart_product')->name('cart_product')->middleware('guest');

    
});

Route::controller(authController::class)->group(function () {

    Route::get('/auth','index')->name('auth')->middleware('guest');
    Route::post('/auth','login')->name('auth.login')->middleware('guest');

    Route::post('/logout','logout')->name('auth.logout')->middleware('auth');

    Route::get('/forgot_password', 'forgot_password')->name('forgot_password')->middleware('guest');
    Route::post('/forgot_password', 'forgot_password_email')->name('forgot_password.email')->middleware('guest');

    Route::get('/reset','reset')->name('reset')->middleware('guest');
    Route::post('/reset','reset_password')->name('reset.password')->middleware('guest');

    Route::get('/register','register')->name('register')->middleware('guest');
    Route::post('/register','register_user')->name('register.user')->middleware('guest');

    Route::get('/varify_user','varify_user')->middleware('guest');

   
    
});

Route::controller(userController::class)->group(function () {
   
    Route::get('/change_password','change_password')->name('user.change_password')->middleware('auth');
    Route::post('/change_password','change_password_process')->name('user.change_password_process')->middleware('auth');
    
    Route::get('/profile','profile')->name('user.profile')->middleware('auth');
    Route::post('/profile_image','profile_image')->name('user.profile_image')->middleware('auth');
    Route::post('/edit_profile','edit_profile')->name('user.edit_profile')->middleware('auth');
    Route::get('/activity_log','activity_log')->name('user.activity_log')->middleware('auth');
    Route::get('/roles','roles')->name('user.roles')->middleware(['auth','is_admin']);
    Route::get('/show_roles','show_roles')->name('user.show.roles')->middleware(['auth','is_admin']);
    Route::post('/edit_roles','edit_roles')->name('user.edit.roles')->middleware(['auth','is_admin']);
});

Route::controller(dashboardController::class)->group(function () {
    Route::get('/dashboard', 'index')->name('dashboard')->middleware('auth');
    
});

Route::controller(adminController::class)->group(function () {
    Route::get('/menagePosts', 'show')->name('menagePosts.show')->middleware('auth');
    
    Route::get('/postsPicker','postsPicker')->name('postsPicker')->middleware(['auth','is_admin']);
    Route::post('/postsPickerEdit','postsPicker_edit')->name('postsPicker.edit')->middleware(['auth','is_admin']);
    Route::get('/list_messege','list_messege')->name('list_messege')->middleware(['auth','is_admin']);
    Route::get('/view_messege','view_messege')->name('view_messege')->middleware(['auth','is_admin']);

    Route::get('/msgsub','msgsub')->name('msgsub')->middleware(['auth','is_admin']);
    Route::post('/msgsub','msgsub_send')->name('msgsub.send')->middleware(['auth','is_admin']);
    
});

Route::controller(PostsController::class)->group(function () {
    Route::get('/createPost', 'create')->name('createPost')->middleware('auth');
    Route::post('/createPost', 'store')->name('createPost.store')->middleware('auth');

    Route::get('/showPost', 'show')->name('showPost')->middleware('auth');
    Route::get('/active', 'active')->name('active')->middleware('auth');
    Route::get('/deactive', 'deactive')->name('deactive')->middleware('auth');
    Route::get('/editPost', 'edit')->name('editPost')->middleware(['auth','authorize']);
    Route::post('/updatepost', 'update')->name('editPost.update')->middleware('auth');
    Route::post('/updatepostimage', 'update_image')->name('editPost.image')->middleware('auth');

    Route::get('/viewPost', 'viewPost')->name('viewPost')->middleware('auth');
    
});

Route::controller(settingController::class)->group(function () {
    Route::get('/setting', 'index')->name('setting.index')->middleware('auth');
    Route::post('/setting', 'edit')->name('setting.edit')->middleware('auth');


    
});

Route::controller(productsController::class)->group(function () {
    Route::get('/create_product', 'create')->name('products.create')->middleware('auth');
    Route::post('/create_product', 'store')->name('products.store')->middleware('auth');

    Route::get('/show_product', 'show')->name('products.show')->middleware('auth');

    Route::get('/edit_product', 'edit')->name('products.edit')->middleware('auth');
    Route::post('/edit_product', 'update')->name('products.update')->middleware('auth');

    Route::get('/deactive_product', 'deactive')->name('products.deactive')->middleware('auth');
    Route::get('/active_product', 'active')->name('products.active')->middleware('auth');


    
});
