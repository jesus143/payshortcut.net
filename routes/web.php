<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
        return view('pages/theme/startbootstrap-grayscale-gh-pages/index');
})->middleware('guest');

Auth::routes();

Route::get('/home', 'HomeController@index')->middleware('web');

Route::get('member/test', 'MemberController@testing');


Route::post('refund/execute', 'RefundController@execute')->name('refund.execute');
// resource
Route::resource('member', 'MemberController');
Route::resource('order', 'OrderController');
Route::resource('setting', 'SettingController');

