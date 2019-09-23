<?php

// =======================   API passport route  =========================

Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');
Route::group(['middleware' => 'auth:api'], function(){
Route::post('details', 'API\UserController@details');
Route::resource('driver', 'crud');

});

// =======================================================================


Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Drivermodels
    Route::post('driver-models/media', 'DriverModelApiController@storeMedia')->name('driver-models.storeMedia');
    Route::apiResource('driver-models', 'DriverModelApiController');
});
