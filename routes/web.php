<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\ToolboxController;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\RoomTypeController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// 後台
Route::prefix('admin')->middleware(['auth'])->group(function (){
    // 房間管理
    Route::resource('/rooms', RoomController::class);
    Route::delete('/room-image',[RoomController::class,'imageDelete'])->name('room.image-delete');
    // 房間類別管理
    Route::resource('/room-types',RoomTypeController::class);
    // 最新消息管理
    Route::resource('/news', NewsController::class);
    // 評價管理
    Route::resource('/feedbacks', FeedbackController::class);
    // 輪播圖片和slogan管理
    Route::resource('/carousels', CarouselController::class);
    // 園區特色管理
    Route::resource('/features', FeatureController::class);
    Route::delete('/feature-image',[FeatureController::class,'imageDelete'])->name('feature.image-delete');
    // Footer管理
    Route::resource('/footers', FooterController::class);
});
