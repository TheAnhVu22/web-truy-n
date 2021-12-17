<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DanhmucTruyenController;
use App\Http\Controllers\TruyenController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\TheloaiController;
use App\Http\Controllers\SachController;
use App\Http\Controllers\UserController;
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
// phần route người dùng bình thường
Route::get('/', [IndexController::class, 'home'])->name('/');
Route::get('/doc-truyen/{slug}', [IndexController::class, 'doctruyen'])->name('doc-truyen');
Route::get('/danh-muc/{slug}', [IndexController::class, 'danhmuc'])->name('danh-muc');
Route::get('/the-loai/{slug}', [IndexController::class, 'theloai']);
Route::get('/xem-chapter/{slug}', [IndexController::class, 'xemchapter']);
Route::get('/tag/{tag}', [IndexController::class, 'tag']);
Route::get('/kytu/{kytu}', [IndexController::class,'kytu']);
Route::get('/doc-sach', [IndexController::class, 'docsach'])->name('doc-sach');

Route::post('/tim-kiem', [IndexController::class, 'timkiem'])->name('tim-kiem');
Route::post('/timkiem-ajax', [IndexController::class, 'timkiem_ajax']);
Route::post('/truyennoibat', [TruyenController::class,'truyennoibat']);
Route::post('/tabs-danhmuc', [IndexController::class,'tabs_danhmuc']);
Route::post('/xemsachnhanh', [IndexController::class,'xemsachnhanh']);

// route Auth phần đăng nhập, đăng ký
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// kiểm tra quyền thông qua middleware
Route::group(['middleware' => ['auth','role:admin']], function() {
   // phần router admin
      
Route::resource('/user', UserController::class);
      // phân vai trò cho user
      Route::get('/phan-vaitro/{id}', [UserController::class, 'phanvaitro']);
      Route::post('/assign_roles/{id}', [UserController::class,'assign_roles']);

      // phân quyền theo vai trò
      Route::get('/phan-quyen/{id}', [UserController::class, 'phanquyen']);
      Route::post('/assign_permission/{id}', [UserController::class,'assign_permission']);

      // thêm quyền mới + vai trò mới
      Route::post('/insert-per', [UserController::class,'insert_per']);
      Route::post('/insert-roles', [UserController::class,'insert_rol']);

      //login nhanh, chuyển đổi tài khoản nhanh chóng bằng session
      Route::get('/impersonate/user/{id}', [UserController::class,'impersonate']);

});

Route::group(['middleware' => ['auth','role:Danhmucer|admin|writer']], function() {
      Route::resource('/danhmuc', DanhmucTruyenController::class);
});  

Route::group(['middleware' => ['auth','role:theloaier|admin|writer']], function() {  
      Route::resource('/theloai', TheloaiController::class);
});      
      
Route::group(['middleware' => ['auth','role:writer|admin']], function() {
      Route::resource('/sach', SachController::class);
      Route::resource('/truyen', TruyenController::class);
      Route::resource('/chapter', ChapterController::class);
});


