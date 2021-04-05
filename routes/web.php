<?php

use App\Models\Blog;
use Illuminate\Support\Facades\Route;

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

Route::get('/', 'App\Http\Controllers\BlogController@index');
Route::get('/showblog/{blog}', 'App\Http\Controllers\BlogController@show')->name('blog.show');


Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');
    Route::get('/dashboard/edit/{blog}', 'App\Http\Controllers\BlogController@edit')->name('blog.edit');
    Route::post('/dashboard/store', 'App\Http\Controllers\BlogController@store')->name('store');
    Route::get('/dashboard/delete/{blog}', 'App\Http\Controllers\BlogController@destroy')->name('blog.destroy');

});
Route::group(['middleware' => ['auth', 'role:blogwriter']], function () {
     Route::get('/dashboard/writer', 'App\Http\Controllers\DashboardController@writer')->name('dashboard.writer');
});
Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::get('/dashboard/blogs', 'App\Http\Controllers\BlogController@blogs')->name('dashboard.blogs');
    Route::get('/dashboard/deleteuser/{user}', 'App\Http\Controllers\UsersController@destroy')->name('user.destroy');
});



require __DIR__.'/auth.php';
