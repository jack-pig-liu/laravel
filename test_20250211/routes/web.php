<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthUserAdminMiddleware;

Route::get(
    '/google/auth',
    'App\Http\Controllers\SocialiteController@redirectToProvider'
);
Route::get(
    '/google/auth/callback',
    'App\Http\Controllers\SocialiteController@handleProviderCallback'
);

Route::group(['prefix' => 'user'], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::get(
            'login',
            'App\Http\Controllers\UserAuthController@Login'
        );
        Route::get(
            'signup',
            'App\Http\Controllers\UserAuthController@SignUpPage'
        );
        Route::post(
            'signup',
            'App\Http\Controllers\UserAuthController@SignUpProcess'
        );
        Route::get(
            'signin',
            'App\Http\Controllers\UserAuthController@SignInPage'
        );
        Route::post(
            'signin',
            'App\Http\Controllers\UserAuthController@SignInProcess'
        );
        Route::get(
            'signout',
            'App\Http\Controllers\UserAuthController@SignOut'
        );
    });
});

Route::group(['prefix' => 'merchandise'], function () {
    Route::get(
        'create',
        'App\Http\Controllers\MerchandiseController@MerchandiseCreateProcess'
    )->middleware(AuthUserAdminMiddleware::class);
    Route::get(
        '{mechandise_id}/edit',
        'App\Http\Controllers\MerchandiseController@MerchandiseEditPage'
    );
    Route::post(
        '{mechandise_id}/edit',
        'App\Http\Controllers\MerchandiseController@MerchandiseEditProcess'
    );
    Route::get(
        'manage',
        'App\Http\Controllers\MerchandiseController@MerchandiseManagePage'
    );
});
