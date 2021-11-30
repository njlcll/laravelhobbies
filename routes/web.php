<?php

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

Route::get('/', function () {
    return view('starting');
});

Route::get('/info', function () {
    return view('info');
});

Route::get('/start', function () {
    return view('starting');
});


 Route::get('hobby/{hobbyId}/tag/{tagId}/attach','HobbyTagController@attachTag');
 Route::get('hobby/{hobbyId}/tag/{tagId}/detach','HobbyTagController@detachTag');


Route::resource( 'hobby',   'HobbyController');
Route::resource( 'tag',   'TagController');
Route::get('/hobby/tag/{tag_id}', [App\Http\Controllers\HobbyTagController::class, 'getFilteredHobbies'])->name('hobby_tag');

Route::resource('user', 'UserController');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
