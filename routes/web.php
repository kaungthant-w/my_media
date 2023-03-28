<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TrendPostController;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    //admin
    Route::get("dashboard", [ProfileController::class,'index'])->name('dashboard');
    Route::post('admin/update', [ProfileController::class, 'updateAdminAccount'])->name('admin#update');
    Route::get('admin/changePassword', [ProfileController::class, 'directChangePassword'])->name('admin#directChangePassword');
    Route::post('admin/changePassword', [ProfileController::class, 'changePassword'])->name('admin#changePassword');

    // admin list
    Route::get("admin/list", [ListController::class, "index"])->name("admin#list");
    Route::get('admin/delete/{id}', [ListController::class, 'deleteAccount'])->name('admin#accountDelete');

    // category
    Route::get('category', [CategoryController::class, 'index'])->name("admin#category");

    // post
    Route::get('post', [PostController::class, 'index'])->name("admin#post");

    // trendPost
    Route::get('trendPost', [TrendPostController::class, 'index'])->name("admin#trendPost");
});
