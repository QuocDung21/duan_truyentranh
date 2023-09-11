<?php


use App\Models\Chapter;
use App\Models\Theloai;
use App\Models\Truyen;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\apiController;
use App\Http\Controllers\DanhmucTruyen;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\TruyenController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\DanhmucController;
use App\Http\Controllers\TheloaiController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;


Auth::routes();
// Client
Route::get('/', [IndexController::class, 'home'])->name('homepage');
Route::post('/timkiem-ajax', [IndexController::class, 'timkiem_ajax'])->name('timkiem-ajax');
Route::get('/tim-kiem', [IndexController::class, 'timkiem'])->name('tim-kiem');
Route::get('/danh-muc/{slug}', [IndexController::class, 'danhmuc'])->name('danh-muc');
Route::get('/xem-chapter/{slug}', [IndexController::class, 'xemchapter'])->name('xem-chapter');
Route::get('/xem-truyen/{slug}', [IndexController::class, 'xemtruyen'])->name('xem-truyen');
Route::get('/the-loai/{slug}', [IndexController::class, 'theloai'])->name('the-loai');


//Route::get("genrate-sitemap", function () {
//    $sitemap = App::make('sitemap');
//    $sitemap->add(route('homepage'), Carbon::now('Asia/Ho_Chi_Minh'), '1.0', 'daily');
//
//    $danhmuc = \App\Models\DanhmucTruyen::orderBy('id', 'Desc')->get();
//    $theloai = Theloai::orderBy('id', 'Desc')->get();
//    $truyen = Truyen::orderBy('id', 'Desc')->get();
//
//    foreach ($danhmuc as $dmuc) {
//        $url = env('APP_URL') . "/danh-muc/{$dmuc->slug_danhmuc}";
//        $sitemap->add($url, Carbon::now('Asia/Ho_Chi_Minh'), '0.7', 'daily');
//    }
//
//    foreach ($theloai as $tloai) {
//        $url = env('APP_URL') . "/the-loai/{$tloai->slug_theloai}";
//        $sitemap->add($url, Carbon::now('Asia/Ho_Chi_Minh'), '0.7', 'daily');
//    }
//
//    foreach ($truyen as $tr) {
//        $url = env('APP_URL') . "/xem-truyen/{$tr->slug_truyen}";
//        $sitemap->add($url, Carbon::now('Asia/Ho_Chi_Minh'), '0.7', 'daily');
//    }
//
//    $chapter = Chapter::select('slug_chapter')->get();
//    foreach ($chapter as $cter) {
//        $url = env('APP_URL') . "/xem-chapter/{$cter->slug_chapter}";
//        $sitemap->add($url, Carbon::now('Asia/Ho_Chi_Minh'), '0.7', 'daily');
//    }
//
//    $sitemap->store('xml', 'sitemap');
//
//    File::copy(public_path('sitemap.xml'), base_path('sitemap.xml'));
//    File::copy(public_path('sitemap-0.xml'), base_path('sitemap-0.xml'));
//    File::copy(public_path('sitemap-1.xml'), base_path('sitemap-1.xml'));
//
//    if (File::exists(base_path() . '/sitemap.xml')) {
//        File::copy(public_path('sitemap.xml'), base_path('sitemap.xml'));
//    }
////    dd(redirect(asset('sitemap.xml')));
//    return redirect(asset('sitemap.xml'));
//});

Route::get('/create_sitemap', function (){
    return \Illuminate\Support\Facades\Artisan::call('sitemap:create');
});

Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('/update_info_websites/{id}', [HomeController::class, 'update_info_websites'])->name('update_info_website');

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



    // Phan quyen
    Route::get('/phan-quyen/{id}', [UserController::class, 'phanquyen'])->name('phan-quyen');
    Route::get('/vai-tro/{id}', [UserController::class, 'vaitro'])->name('vai-tro');
    Route::post('/insert_roles/{id}', [UserController::class, 'insert_roles'])->name('insert_roles');
    Route::post('/insert_add_roles', [UserController::class, 'insert_add_roles'])->name('insert_add_roles');
    Route::post('/insert_permission/{id}', [UserController::class, 'insert_permission'])->name('insert_permission');
    Route::post('/insert_per_permission', [UserController::class, 'insert_per_permission']);





    // Change password

    Fortify::loginView(function () {
        return view('auth.login');
    });

    // Fortify::registerView(function () {
    //     return view('auth.register');
    // });

    Fortify::requestPasswordResetLinkView(function () {
        return view('auth.forgot-password');
    });

    Fortify::resetPasswordView(function ($request) {
        return view('auth.reset-password', ['request' => $request]);
    });

    Fortify::verifyEmailView(function () {
        return view('auth.verify-email');
    });


    // Route for changing password
    Route::get('/change-password', [ChangePasswordController::class, 'showChangePasswordForm'])->name('password.change');
    Route::post('/change-password', [ChangePasswordController::class, 'changePassword']);
});
