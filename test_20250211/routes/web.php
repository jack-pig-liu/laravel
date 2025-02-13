<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return 123;
});

Route::get('/page1', function () {
    return 'page1';
});

Route::get('/page2', function () {
    return 'page2';
});

// Route::get(
//     '/user/auth/login',
//     'App\Http\Controllers\UserAuthController@Login'
// );

// Route::get(
//     '/user/auth/search/{user_id}',
//     'App\Http\Controllers\UserAuthController@Search'
// );

Route::group(['prefix' => 'user'], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::get(
            'login',
            'App\Http\Controllers\UserAuthController@Login'
        );
        Route::get(
            'search/{user_id}',
            'App\Http\Controllers\UserAuthController@Search'
        );
        Route::get(
            'signup',
            'App\Http\Controllers\UserAuthController@SignUp'
        );
    });
});
