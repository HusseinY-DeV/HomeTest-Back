<?php

use Illuminate\Support\Facades\Route;


// Admin api routes

Route::post('/login',"UsersController@login");

Route::group(["prefix" => "admin","middleware" => "assign.guard:user"],function () {
    Route::get('/',"UsersController@index");
    Route::get('/{id}',"UsersController@show");
    Route::put('/{id}',"UsersController@edit");
    Route::post('/logout',"UsersController@logout");
    Route::post('/',"UsersController@create");
    Route::delete('/{id}',"UsersController@destroy");
    Route::get("/my-posts/{id}","PostsController@getPostsById");
    Route::get("/all/all-posts","PostsController@index");
});

Route::group(["prefix" => "verify/admin","middleware" => "assign.guard:user"],function () {
    Route::get('',"VerifyTokenController@users");
});


// _______________________________________________________

// Posts api routes

Route::group(["prefix" => "post","middleware" => "assign.guard:user"],function () {
    Route::post("/admin/{id}","PostsController@create");
    Route::post("/{id}","PostsController@edit");
    Route::delete("/{id}","PostsController@destroy");
    Route::get("/{id}","PostsController@getById");
});
