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

Route::get('/','IndexController@index')->name("index");
Route::get('/check','IndexController@check')->name("check");

/*Users Route*/
Route::group(["prefix" => "user","middleware" => "auth:web","as" => "user."],function (){
    Route::get("dashboard","IndexController@dashborad")->name("dashboard");
    Route::get("submit","IndexController@submit")->name("submit");
    Route::get("profile","IndexController@profile")->name("profile.index");
    Route::post("profile","IndexController@update")->name("profile.update");
});
/*Admin Route*/
Route::group(["middleware" => "admin","prefix" => "admin",'as' => "admin."],function (){
    Route::get("/users","IndexController@users")->name("users.index");
    Route::get("/staffs","IndexController@staffs")->name("staffs.index");

    Route::get("/staffs/create","IndexController@createStaff")->name("staffs.create");
    Route::post("/staffs/store","IndexController@storeStaff")->name("staffs.store");
    Route::get("/staffs/edit/{id}","IndexController@editStaff")->name("staffs.edit");
    Route::post("/staffs/update","IndexController@updateStaff")->name("staffs.update");
    Route::get("/staffs-delete/{id}","IndexController@deleteStaff")->name("staffs.delete");

    Route::get("/users/{id}","IndexController@show")->name("users.show");
    Route::post("/chang","IndexController@chang")->name("users.update");
    Route::get("/deliveries","DashboardController@deliveries")->name("deliveries.index");
});
Route::get('/login-staff','IndexController@index')->name("index");
Route::post('/login-delivery','IndexController@index')->name("index");
Route::get('/login-staff','IndexController@index')->name("index");
Route::post('/login-delivery','IndexController@index')->name("index");

/*Delivery Routes*/
Route::group(["middleware" => "auth:delivery","prefix" => "delivery" ,"as" => "delivery."],function () {
    Route::get("/dashboard","DeliveryController@dashboard")->name("dashboard");
    Route::get("/users","DeliveryController@users")->name("users.index");
    Route::get("/users/{id}","DeliveryController@show")->name("users.show");
    Route::post("/chang/{id}","DeliveryController@chang")->name("users.show");

});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
