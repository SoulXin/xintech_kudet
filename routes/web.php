<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KontenKontroller;
use App\Http\Controllers\ObjectNameController;
use App\Http\Controllers\KontenDetailController;
use App\Http\Controllers\TempKontenDetailController;
use App\Http\Controllers\ResizeImageController;

use App\Http\Controllers\Auth\LoginController;

// Client
use App\Http\Controllers\MainController;

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

Auth::routes();
Route::group(['middleware' => 'auth'], function(){
    Route::get('/admin/xin', function () {
        return view('welcome');
    });
    
    Route::get('/admin/xin/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('/admin/xin/konten',KontenKontroller::class);
    Route::resource('/admin/xin/konten_detail',KontenDetailController::class);
    Route::resource('/admin/xin/objek',ObjectNameController::class);
    
    // Detail Content
    Route::get('/admin/xin/detail_back_home', [TempKontenDetailController::class, 'home'])->name('detail_back_home');
    Route::get('/admin/xin/detail_create_judul/{id}/{id_konten}/{edit}', [TempKontenDetailController::class, 'create_judul'])->name('detail_content_create_judul');
    Route::get('/admin/xin/detail_crete_paragraf/{id}/{id_konten}/{edit}', [TempKontenDetailController::class, 'create_paragraf'])->name('detail_content_create_paragraf');
    Route::get('/admin/xin/detail_create_gambar/{id}/{id_konten}/{edit}', [TempKontenDetailController::class, 'create_gambar'])->name('detail_content_create_gambar');
    Route::get('/admin/xin/detail_create_vidio/{id}/{id_konten}/{edit}', [TempKontenDetailController::class, 'create_vidio'])->name('detail_content_create_vidio');
    
    // Router untuk menyimpan isi dari konten kedalam table temporary
    Route::post('/admin/xin/detail_content_store/{jenis}/{id_konten}',[TempKontenDetailController::class, 'detail_store'])->name('detail_content_store');
    
    // Router untuk menghapus isi dari konten pada table temporary
    Route::delete('/admin/xin/detail_content_destroy/{id}/{jenis}',[TempKontenDetailController::class, 'detail_destroy'])->name('detail_content_destroy');
    
    // Route update
    Route::put('/admin/xin/detail_update/{id}/{jenis}',[TempKontenDetailController::class, 'detail_update'])->name('detail_update');
});




// Client
Route::get('/',[MainController::class, 'index'])->name('index');
Route::get('/detail/{id}',[MainController::class, 'detail'])->name('detail');
Route::post('/search',[MainController::class, 'search'])->name('search');
Route::get('/trending',[MainController::class, 'trending'])->name('trending');
Route::get('/game_event',[MainController::class, 'game_event'])->name('game_event');
Route::get('/hardware',[MainController::class, 'hardware'])->name('hardware');
Route::get('/entertaiment',[MainController::class, 'entertaiment'])->name('entertaiment');
Route::get('/welcome',[MainController::class, 'welcome'])->name('welcome');