<?php

use App\Http\Controllers\admin\BulkActionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\Auth\AuthController;
use App\Http\Controllers\admin\BlogController;
use App\Http\Controllers\admin\CatalogueController;
use App\Http\Controllers\admin\ConfigController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\KeywordController;
use App\Http\Controllers\admin\TagController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\Frontends\BlogController as FrontendsBlogController;
use App\Http\Controllers\Frontends\HomeController;


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


    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get ('blog/{slug}', [FrontendsBlogController::class, 'detail'])->name('blog.detail');





Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('detail/{id}', [UserController::class, 'getUserInfor'])->name('getUserInfor');
    Route::post('update/{id}', [UserController::class, 'updateUserInfor'])->name('updateUserInfor');
    Route::post('change-password', [UserController::class, 'changePassword'])->name('changePassword');
    route::middleware('admin.guest')->group(function () {
        route::get('login', [AuthController::class, 'login'])->name('login');
        route::post('login', [AuthController::class, 'authenticate']);
    });

    route::middleware('admin.auth')->group(function () {

        // Route::get('/', function () {
        //     $title = ' Dashboard';
        //     return view('backend.dashboard', compact('title'));
        // })->name('dashboard');
        route::get('/', action: [DashboardController::class, 'getRevenueChart'])->name('dashboard');

        route::get('logout', [AuthController::class, 'logout'])->name('logout');

        Route::prefix('catalogues')->name('catalogues.')->group(function () {
            Route::get('/', [CatalogueController::class, 'index'])->name('index');
            Route::get('trash', [CatalogueController::class, 'trash'])->name('trash');
            Route::post('store', [CatalogueController::class, 'store'])->name('store');
            Route::put('{id}', [CatalogueController::class, 'update'])->name('update');
            Route::delete('{id}/soft-delete', [CatalogueController::class, 'softDelete'])->name('softDelete');
            Route::delete('{id}/delete', [CatalogueController::class, 'delete'])->name('delete');
            Route::put('{id}/restore', [CatalogueController::class, 'restore'])->name('restore');

        });

        Route::prefix('keywords')->name('keywords.')->group(function () {
            Route::get('/', [KeywordController::class, 'index'])->name('index');
            Route::get('trash', [KeywordController::class, 'trash'])->name('trash');
            Route::post('store', [KeywordController::class, 'store'])->name('store');
            Route::put('{id}', [KeywordController::class, 'update'])->name('update');
            Route::delete('{id}/soft-delete', [KeywordController::class, 'softDelete'])->name('softDelete');
            Route::delete('{id}/delete', [KeywordController::class, 'delete'])->name('delete');
            Route::put('{id}/restore', [KeywordController::class, 'restore'])->name('restore');

        });

        Route::prefix('tags')->name('tags.')->group(function () {
            Route::get('/', [TagController::class, 'index'])->name('index');
            Route::post('store', [TagController::class, 'store'])->name('store');

        });

        Route::prefix('blogs')->name('blogs.')->controller(BlogController::class)->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::put('edit/{id}', 'update')->name('update');
            Route::delete('delete/{id}', 'delete')->name('delete');
            
            // SEO 
            Route::get('{id}/seo-analysis', 'getSeoAnalysis')->name('seo.analysis');
            Route::post('{id}/analyze-seo', 'analyzeSeo')->name('seo.analyze');
            Route::put('{id}/update-seo', 'updateSeo')->name('seo.update');
        });

    });

});

