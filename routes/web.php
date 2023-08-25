<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DanhmucController;
use App\Http\Controllers\TruyenController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\DanhmucTruyen;
use App\Http\Controllers\TheloaiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\apiController;

Auth::routes();
// Client
Route::get('/', [IndexController::class, 'home']);
Route::get('/danh-muc/{slug}', [IndexController::class, 'danhmuc'])->name('danh-muc');
Route::get('/xem-chapter/{slug}', [IndexController::class, 'xemchapter'])->name('xem-chapter');
Route::get('/xem-truyen/{slug}', [IndexController::class, 'xemtruyen'])->name('xem-truyen');
Route::get('/the-loai/{slug}', [IndexController::class, 'theloai'])->name('the-loai');
Route::get('/tim-kiem', [IndexController::class, 'timkiem'])->name('tim-kiem');
Route::post('/timkiem-ajax', [IndexController::class, 'timkiem_ajax']);
Route::get('/phan-quyen/{id}', [UserController::class, 'phanquyen'])->name('phan-quyen');
Route::get('/vai-tro/{id}', [UserController::class, 'vaitro'])->name('vai-tro');
Route::post('/insert_roles/{id}', [UserController::class, 'insert_roles'])->name('insert_roles');
Route::post('/insert_add_roles', [UserController::class, 'insert_add_roles'])->name('insert_add_roles');
Route::post('/insert_permission/{id}', [UserController::class, 'insert_permission'])->name('insert_permission');
Route::post('/insert_per_permission', [UserController::class, 'insert_per_permission']);

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('/danhmuc', DanhmucController::class);
    Route::resource('/chapter', ChapterController::class);
    Route::resource('/theloai', TheloaiController::class);
    Route::resource('/truyen', TruyenController::class);
    // Api
    Route::get('danhmuc-data', [apiController::class, 'getDataDanhmuc'])->name('danhmuc.data');
    Route::get('theloai-data', [apiController::class, 'getTheloaiApi'])->name('theloai.data');
    Route::get('truyen-data', [apiController::class, 'getTruyensApi'])->name('truyen.data');
    Route::get('users-data', [apiController::class, 'getListUsers'])->name('users.data');

    Route::get('chapter-data', [apiController::class, 'getChaptersApi'])->name('chapter.data');

    Route::get('chapter-check-data', [apiController::class, 'getDataCheckChapter'])->name('chapter_check.data');
    Route::get('truyen-check-data', [apiController::class, 'getDataCheckTruyen'])->name('truyen_check.data');

    Route::get('chapter-view/{id}', [apiController::class, 'viewChapter'])->name('chapter.view');
    Route::get('truyen-view/{id}', [apiController::class, 'viewTruyen'])->name('truyen.view');

    Route::get('chapter-duyet/{id}', [apiController::class, 'checkChapter'])->name('chapter.duyet');
    Route::get('truyen-duyet/{id}', [apiController::class, 'checkTruyen'])->name('truyen.duyet');



    Route::delete('chapter-destroy/{id}', [apiController::class, 'destroyChapterApi']);
    Route::delete('user-destroy/{id}', [apiController::class, 'destroyUserApi']);
    Route::delete('danhmuc-destroy/{id}', [apiController::class, 'destroyDanhmucApi']);
    Route::delete('theloai-destroy/{id}', [apiController::class, 'destroyTheloaiApi']);
    Route::delete('truyen-destroy/{id}', [apiController::class, 'destroyTruyenApi']);
    Route::resource('/user', UserController::class);
    Route::resource('/users', UserController::class);
});
