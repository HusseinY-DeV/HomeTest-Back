<?php

use Illuminate\Support\Facades\Route;


// Admin api routes

Route::post('/login',"UsersController@login");

// Patient api routes

Route::post('patient/register',"PatientsController@register");
Route::post('patient/login',"PatientsController@login");


// TOKEN verification apis (additional security)
Route::group(["prefix" => "verify/admin","middleware" => "assign.guard:user"],function () {
    Route::get('',"VerifyTokenController@users");
});

Route::group(["prefix" => "verify/patient","middleware" => "assign.guard:patient"],function () {
    Route::get('',"VerifyTokenController@patients");
});


Route::group(["prefix" => "admin","middleware" => "assign.guard:user"],function () {
    Route::get('/',"UsersController@index");
    Route::get('/{id}',"UsersController@show");
    Route::put('/{id}',"UsersController@edit");
    Route::post('/logout',"UsersController@logout");
    Route::post('/',"UsersController@create");
    Route::delete('/{id}',"UsersController@destroy");
    Route::get("/my-posts/{id}","PostsController@getPostsById");
    Route::get("/all/all-posts","PostsController@index");
    Route::get("/all/all-bookings","BookingsController@index");
});

// _______________________________________________________

// Posts api routes (Admins)

Route::group(["prefix" => "post","middleware" => "assign.guard:user"],function () {
    Route::post("/admin/{id}","PostsController@create");
    Route::put("/{id}","PostsController@edit");
    Route::delete("/{id}","PostsController@destroy");
    Route::get("/{id}","PostsController@getById");
});


// Tests api routes (Admins)

Route::group(["prefix" => "tests","middleware" => "assign.guard:user"],function () {
    Route::get("/","TestsController@index");
    Route::post("/","TestsController@create");
    Route::put("/{id}","TestsController@edit");
    Route::delete("/{id}","TestsController@destroy");
});

Route::group(["prefix" => "bookings","middleware" => "assign.guard:user"],function () {
    Route::get("/","BookingsController@index");
    Route::get("/{id}","BookingsController@show");
});


Route::put("/admindeliver/{id}","BookingsController@adminDeliver");

Route::put("/adminsuccess/{id}","BookingsController@success");

Route::delete("/decline/{id}","BookingsController@decline");

// Patient api routes

Route::group(["prefix" => "patient","middleware" => "assign.guard:patient"],function () {

    Route::get("/{id}","PatientsController@show");
    Route::put("/phone/{id}","PatientsController@editPhone");
    Route::put("/password/{id}","PatientsController@editPassword");
    Route::post("/logout","PatientsController@logout");
});

// Posts api routes (Admins)

Route::group(["prefix" => "posts","middleware" => "assign.guard:patient"],function () {
    Route::get("","PostsController@indexAll");
    Route::get("/{id}","PostsController@getById");
});


Route::group(["prefix" => "location/patient","middleware" => "assign.guard:patient"],function () {
    Route::post("/{id}","PatientsController@addLocation");
});




// Tests api routes (Patients)

Route::group(["prefix" => "tests/patient","middleware" => "assign.guard:patient"],function () {

    Route::get("","TestsController@index");

});

// Bookings api routes (Patients)

Route::group(["prefix" => "patient/bookings","middleware" => "assign.guard:patient"],function () {
    Route::post("/{ID}/{id}","BookingsController@book");
});

Route::get("/my/{id}","BookingsController@getMyBookings");
Route::put("/deliver/{id}","BookingsController@deliver");
Route::delete("/book/{id}/{tId}","BookingsController@deleteBook");


