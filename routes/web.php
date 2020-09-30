<?php

use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\Auth;
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


Route::get('landing', function () {
    return view('landing');
});


//To create name space folder for controller files
// Route::namespace('Front')->group(function(){
//     Route::get('/user','userController@showUserName');
// });


// Route::group(['prefix' => 'users' , 'middleware' => 'auth'],function(){
//     Route::get('/show', 'userController@showUserName');
// });

//Resource Routes
// Route::resource('user','Front\userController');



Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('/',function(){
    return 'home';
});

