<?php

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
    return view('welcome');
});

Route::get('/test', function(){
    return App\CustomsDeclaration::with(['nationality','customsGoods'])->get();
});

Route::get('/customs/welcome', function(){
    return view('component.default.welcome');
});
Route::get('/customs/booked/{id}','CustomsDeclarationController@getBookedRegister');
Route::get('/customs/released/{id}', 'CustomsDeclarationController@getReleased');
Route::get('/customs-declaration', 'CustomsDeclarationController@getRegister');
Route::post('/customs-declaration', 'CustomsDeclarationController@setRegister');
Route::post('/customs-draft', 'CustomsDeclarationController@setDraftRegister');
Route::post('/customs-loaded', 'CustomsDeclarationController@getReferenceNumberBooking');