<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::get('/test', function() {
    return ['name' => 'Taylor'];
});




Route::post('member/create', 'MemberController@apiStore');
Route::post('order/create', 'OrderController@apiStore');
Route::get('member/get', 'MemberController@apiGetMember');
Route::get('member/get-by-mail', 'MemberController@apiGetMemberByEmail');
Route::get('member/get/order', 'MemberController@apiGetMemberOrder');
Route::get('order/{id?}', 'OrderController@getOrderDetail');
Route::get('order/get/sendright/subscription/{user_id?}/{order_title?}', 'OrderController@apiGetMemberOrderByTitle');


Route::get('order/update/status/{id?}', 'OrderController@updateSubscriptionStatus');





