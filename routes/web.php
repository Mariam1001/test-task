<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Frontend\AuthController as FrontAuth;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\UserController;

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
//dd(45);
//auth()->guard('web')->logout();

Route::group([], function () {
    Route::get('/', [FrontAuth::class, 'loginView'])->name('frontend.loginView');

    Route::group([
            'name' => 'user.',
            'prefix' => 'user'
        ], function () {

        Route::get('login', [FrontAuth::class, 'loginView'])->name('frontend.loginView');
        Route::post('login', [FrontAuth::class, 'login'])->name('frontend.login');
        Route::get('/', [FrontAuth::class, 'loginView'])->name('frontend.loginView');

        /** Home Route */
        Route::group(['middleware' => ['auth:sanctum', 'isCustomer']], function () {
            Route::get('/posts', [HomeController::class, 'index'])->name('user.posts');
            Route::get('/accounts', [UserController::class, 'index'])->name('accounts.index');
            Route::post('/accounts/update', [UserController::class, 'update'])->name('profile.update');
            Route::get('/logout', [FrontAuth::class, 'logout'])->name('user.logout');

        });
    });

        /*************************** ADMIN ROUTES **************************/
        Route::group([
            'name' => 'admin.',
            'prefix' => 'admin',
        ], function () {

            Route::get('login', [AuthController::class, 'loginView'])->name('admin.loginView');
            Route::post('login', [AuthController::class, 'login'])->name('login');

            Route::group(['middleware' => ['auth:sanctum', 'isAdmin']], function () {
                Route::get('/', function () {
                    return view('admin.dashboard.index');
                });

                Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.index')->middleware('isAdmin');
                Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
                Route::resource('posts', PostsController::class);
            });
        });
});
