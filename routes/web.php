<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SingersController;
use App\Http\Controllers\SongCategoriesController;
use App\Http\Controllers\SongsController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::group([
    'prefix' => 'singers',
], function () {
    Route::get('/', [SingersController::class, 'index'])
         ->name('singers.singer.index');
    Route::get('/create', [SingersController::class, 'create'])
         ->name('singers.singer.create');
    Route::get('/show/{singer}',[SingersController::class, 'show'])
         ->name('singers.singer.show')->where('id', '[0-9]+');
    Route::get('/{singer}/edit',[SingersController::class, 'edit'])
         ->name('singers.singer.edit')->where('id', '[0-9]+');
    Route::post('/', [SingersController::class, 'store'])
         ->name('singers.singer.store');
    Route::put('singer/{singer}', [SingersController::class, 'update'])
         ->name('singers.singer.update')->where('id', '[0-9]+');
    Route::delete('/singer/{singer}',[SingersController::class, 'destroy'])
         ->name('singers.singer.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'song_categories',
], function () {
    Route::get('/', [SongCategoriesController::class, 'index'])
         ->name('song_categories.song_category.index');
    Route::get('/create', [SongCategoriesController::class, 'create'])
         ->name('song_categories.song_category.create');
    Route::get('/show/{songCategory}',[SongCategoriesController::class, 'show'])
         ->name('song_categories.song_category.show')->where('id', '[0-9]+');
    Route::get('/{songCategory}/edit',[SongCategoriesController::class, 'edit'])
         ->name('song_categories.song_category.edit')->where('id', '[0-9]+');
    Route::post('/', [SongCategoriesController::class, 'store'])
         ->name('song_categories.song_category.store');
    Route::put('song_category/{songCategory}', [SongCategoriesController::class, 'update'])
         ->name('song_categories.song_category.update')->where('id', '[0-9]+');
    Route::delete('/song_category/{songCategory}',[SongCategoriesController::class, 'destroy'])
         ->name('song_categories.song_category.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'songs',
], function () {
    Route::get('/', [SongsController::class, 'index'])
         ->name('songs.song.index');
    Route::get('/create', [SongsController::class, 'create'])
         ->name('songs.song.create');
    Route::get('/show/{song}',[SongsController::class, 'show'])
         ->name('songs.song.show')->where('id', '[0-9]+');
    Route::get('/{song}/edit',[SongsController::class, 'edit'])
         ->name('songs.song.edit')->where('id', '[0-9]+');
    Route::post('/', [SongsController::class, 'store'])
         ->name('songs.song.store');
    Route::put('song/{song}', [SongsController::class, 'update'])
         ->name('songs.song.update')->where('id', '[0-9]+');
    Route::delete('/song/{song}',[SongsController::class, 'destroy'])
         ->name('songs.song.destroy')->where('id', '[0-9]+');
});
