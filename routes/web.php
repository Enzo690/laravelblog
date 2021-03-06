<?php

use Illuminate\Support\Facades\Route;
use UniSharp\LaravelFilemanager\Lfm;
use App\Http\Controllers\Front\PostController as FrontPostController;

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



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => 'auth'], function () {
    Lfm::routes();
});

Route::name('home')->get('/', [FrontPostController::class, 'index']);

Route::prefix('posts')->group(function () {
    Route::name('posts.display')->get('{slug}', [FrontPostController::class, 'show']);
    Route::name('posts.search')->get('', [FrontPostController::class, 'search']);
});

Route::name('category')->get('category/{category:slug}', [FrontPostController::class, 'category']);

Route::name('author')->get('author/{user}', [FrontPostController::class, 'user']);

Route::name('tag')->get('tag/{tag:slug}', [FrontPostController::class, 'tag']);

require __DIR__.'/auth.php';
