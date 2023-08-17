<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DanhmucController;
use App\Http\Controllers\TruyenController;
use App\Http\Controllers\ChapterControler;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\DanhmucTruyen;


Route::get('/', [IndexController::class, 'home']);
Route::get('/danh-muc/{slug}', [IndexController::class, 'danhmuc']);
Route::get('/xem-truyen/{id}', [IndexController::class, 'xemtruyen'])->name('xem-truyen');

Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::resource('/danhmuc',DanhmucController::class);
Route::resource('/truyen', TruyenController::class);
Route::resource('/chapter', ChapterController::class);
