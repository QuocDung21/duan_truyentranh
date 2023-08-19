<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DanhmucController;
use App\Http\Controllers\TruyenController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\DanhmucTruyen;
use App\Http\Controllers\TheloaiController;




Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::resource('/danhmuc',DanhmucController::class);
Route::resource('/truyen', TruyenController::class);
Route::resource('/chapter', ChapterController::class);
Route::resource('/theloai', TheloaiController::class);


// Client
Route::get('/', [IndexController::class, 'home']);
Route::get('/danh-muc/{slug}', [IndexController::class, 'danhmuc']);
Route::get('/xem-chapter/{slug}', [IndexController::class, 'xemchapter'])->name('xem-chapter');
Route::get('/xem-truyen/{slug}', [IndexController::class, 'xemtruyen'])->name('xem-truyen');
Route::get('/the-loai/{slug}', [IndexController::class, 'theloai'])->name('the-loai');


// Api
// getdata tabtable

//destroyChapterApi
Route::get('danhmuc-data', [DanhmucController::class, 'getDataDanhmuc'])->name('danhmuc.data');
Route::get('chapter-destroy/{id}', [ChapterController::class, 'destroyChapterApi']);
Route::get('chapter-data', [ChapterController::class, 'getChaptersApi'])->name('chapter.data');
