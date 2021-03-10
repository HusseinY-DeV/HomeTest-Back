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
    Route::post("/{id}","PostsController@edit");
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


// Patient api routes

Route::group(["prefix" => "patient","middleware" => "assign.guard:patient"],function () {
    Route::put("/phone/{id}","PatientsController@editPhone");
    Route::put("/password/{id}","PatientsController@editPassword");
    Route::post("/logout","PatientsController@logout");
});

// Posts api routes (Admins)

Route::group(["prefix" => "patient/post","middleware" => "assign.guard:patient"],function () {
    Route::get("","PostsController@index");
    Route::get("/{id}","PostsController@getById");
});

// Tests api routes (Patients)

Route::group(["prefix" => "patient/tests","middleware" => "assign.guard:patient"],function () {
    Route::get("","TestsController@index");
});

// Bookings api routes (Patients)

Route::group(["prefix" => "patient/bookings","middleware" => "assign.guard:patient"],function () {
    Route::post("/{id}","BookingsController@book");
    Route::get("/{id}","BookingsController@getMyBookings");
});


