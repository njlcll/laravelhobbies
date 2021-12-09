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
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/', function () {
    
//     return view('home')->middleware('auth');
// });

Route::get('/info', function () {
    return view('info');
});

// Route::get('/start', function () {
//     return view('starting');
// });


 Route::get('hobby/{hobbyId}/tag/{tagId}/attach','HobbyTagController@attachTag')->middleware('auth');
 Route::get('hobby/{hobbyId}/tag/{tagId}/detach','HobbyTagController@detachTag')->middleware('auth');
 
 
 //delete images of hobby
 Route::get('/delete-images/hobby/{hobby_id}', 'HobbyController@deleteImages');

Route::resource( 'hobby',   'HobbyController');
Route::resource( 'tag',   'TagController');
Route::get('/hobby/tag/{tag_id}', [App\Http\Controllers\HobbyTagController::class, 'getFilteredHobbies'])->name('hobby_tag');

Route::resource('user', 'UserController');
// Delete Images of Hobby
Route::get('/delete-images/hobby/{hobby_id}', 'HobbyController@deleteImages');
// Delete Images of User
Route::get('/delete-images/user/{user_id}', 'UserController@deleteImages');

Auth::routes();


