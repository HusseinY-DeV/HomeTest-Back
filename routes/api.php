<?php

use Illuminate\Support\Facades\Route;


// Admin api routes

Route::post('/login',"UsersController@login");

// Patient api routes

Route::post('patient/register',"PatientsController@register");
Route::post('patient/login',"PatientsController@login");


// TOKEN verification apis (additional security)
Route::group(["prefix" => "verify/admin","middleware" => ""],function () {
    Route::get('',"VerifyTokenController@users");
});

Route::group(["prefix" => "verify/patient","middleware" => ""],function () {
    Route::get('',"VerifyTokenController@patients");
});


Route::get('/admin',"UsersController@index");
Route::put('admin/{id}',"UsersController@edit");
Route::post('admin/logout',"UsersController@logout");
Route::delete('admin/{id}',"UsersController@destroy");
Route::post('/admin',"UsersController@create");

Route::group(["prefix" => "admin","middleware" => ""],function () {
    Route::get('/{id}',"UsersController@show");
    Route::get("/my-posts/{id}","PostsController@getPostsById");
    Route::get("/all/all-posts","PostsController@index");
    Route::get("/all/all-bookings","BookingsController@index");
});

// _______________________________________________________

// Posts api routes (Admins)

Route::post("post/admin/{id}","PostsController@create");
Route::put("post/{id}","PostsController@edit");
Route::delete("post/{id}","PostsController@destroy");
Route::get("post/{id}","PostsController@getById");

Route::group(["prefix" => "post","middleware" => ""],function () {
});


// Tests api routes (Admins)

Route::get("/tests","TestsController@index");
Route::post("/tests","TestsController@create");
Route::put("tests/{id}","TestsController@edit");
Route::delete("tests/{id}","TestsController@destroy");
Route::group(["prefix" => "tests","middleware" => ""],function () {
});

Route::get("/bookings","BookingsController@index");
Route::group(["prefix" => "bookings","middleware" => ""],function () {
    Route::get("/{id}","BookingsController@show");
});


Route::put("/admindeliver/{id}","BookingsController@adminDeliver");

Route::put("/adminsuccess/{id}","BookingsController@success");

Route::delete("/decline/{id}","BookingsController@decline");

// Patient api routes

Route::group(["prefix" => "patient","middleware" => ""],function () {

    Route::get("/{id}","PatientsController@show");
    Route::put("/phone/{id}","PatientsController@editPhone");
    Route::put("/password/{id}","PatientsController@editPassword");
    Route::post("/logout","PatientsController@logout");
});

// Posts api routes (Admins)

Route::get("posts","PostsController@indexAll");
Route::get("posts/{id}","PostsController@getById");
Route::group(["prefix" => "posts","middleware" => ""],function () {
});


Route::group(["prefix" => "location/patient","middleware" => ""],function () {
    Route::post("/{id}","PatientsController@addLocation");
});




// Tests api routes (Patients)

Route::group(["prefix" => "tests/patient","middleware" => ""],function () {

    Route::get("","TestsController@index");

});

// Bookings api routes (Patients)

Route::group(["prefix" => "patient/bookings","middleware" => ""],function () {
    Route::post("/{ID}/{id}","BookingsController@book");
});

Route::get("/my/{id}","BookingsController@getMyBookings");
Route::put("/deliver/{id}","BookingsController@deliver");
Route::delete("/book/{id}/{tId}","BookingsController@deleteBook");


