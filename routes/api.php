<?php

use Illuminate\Support\Facades\Route;


// Admin api routes

Route::post('/login',"App\Http\Controllers\UsersController@login");

// Patient api routes

Route::post('patient/register',"App\Http\Controllers\PatientsController@register");
Route::post('patient/login',"App\Http\Controllers\PatientsController@login");


// TOKEN verification apis (additional security)
Route::group(["prefix" => "verify/admin","middleware" => ""],function () {
    Route::get('',"App\Http\Controllers\VerifyTokenController@users");
});

Route::group(["prefix" => "verify/patient","middleware" => ""],function () {
    Route::get('',"App\Http\Controllers\VerifyTokenController@patients");
});


Route::get('admin',"App\Http\Controllers\UsersController@index");
Route::post('admin/logout',"App\Http\Controllers\UsersController@logout");
Route::get("admin/my-posts/{id}","App\Http\Controllers\PostsController@getPostsById");
Route::get("admin/all/all-bookings","App\Http\Controllers\BookingsController@index");
Route::group(["prefix" => "admin","middleware" => ""],function () {
    Route::get('/{id}',"App\Http\Controllers\UsersController@show");
    Route::put('/{id}',"App\Http\Controllers\UsersController@edit");
    Route::post('/',"App\Http\Controllers\UsersController@create");
    Route::delete('/{id}',"App\Http\Controllers\UsersController@destroy");
    Route::get("/all/all-posts","App\Http\Controllers\PostsController@index");
});

// _______________________________________________________

// Posts api routes (Admins)

Route::group(["prefix" => "post","middleware" => ""],function () {
    Route::post("/admin/{id}","App\Http\Controllers\PostsController@create");
    Route::put("/{id}","App\Http\Controllers\PostsController@edit");
    Route::delete("/{id}","App\Http\Controllers\PostsController@destroy");
    Route::get("/{id}","App\Http\Controllers\PostsController@getById");
});


// Tests api routes (Admins)

Route::get("/tests","App\Http\Controllers\TestsController@index");
Route::post("/tests","App\Http\Controllers\TestsController@create");
Route::put("tests/{id}","App\Http\Controllers\TestsController@edit");
Route::delete("tests/{id}","App\Http\Controllers\TestsController@destroy");
Route::group(["prefix" => "tests","middleware" => ""],function () {
});

Route::group(["prefix" => "bookings","middleware" => ""],function () {
    Route::get("/","App\Http\Controllers\BookingsController@index");
    Route::get("/{id}","App\Http\Controllers\BookingsController@show");
});


Route::put("/admindeliver/{id}","App\Http\Controllers\BookingsController@adminDeliver");

Route::put("/adminsuccess/{id}","App\Http\Controllers\BookingsController@success");

Route::delete("/decline/{id}","App\Http\Controllers\BookingsController@decline");

// Patient api routes

Route::group(["prefix" => "patient","middleware" => ""],function () {

    Route::get("/{id}","App\Http\Controllers\PatientsController@show");
    Route::put("/phone/{id}","App\Http\Controllers\PatientsController@editPhone");
    Route::put("/password/{id}","App\Http\Controllers\PatientsController@editPassword");
    Route::post("/logout","App\Http\Controllers\PatientsController@logout");
});

// Posts api routes (Admins)

Route::group(["prefix" => "posts","middleware" => ""],function () {
    Route::get("","App\Http\Controllers\PostsController@indexAll");
    Route::get("/{id}","App\Http\Controllers\PostsController@getById");
});


Route::group(["prefix" => "location/patient","middleware" => ""],function () {
    Route::post("/{id}","App\Http\Controllers\PatientsController@addLocation");
});




// Tests api routes (Patients)

Route::group(["prefix" => "tests/patient","middleware" => ""],function () {

    Route::get("","App\Http\Controllers\TestsController@index");

});

// Bookings api routes (Patients)

Route::group(["prefix" => "patient/bookings","middleware" => ""],function () {
    Route::post("/{ID}/{id}","App\Http\Controllers\BookingsController@book");
});

Route::get("/my/{id}","App\Http\Controllers\BookingsController@getMyBookings");
Route::put("/deliver/{id}","App\Http\Controllers\BookingsController@deliver");
Route::delete("/book/{id}/{tId}","App\Http\Controllers\BookingsController@deleteBook");


