<?php

Route::group(['middleware' => ['web'], 'module' => 'User', 'prefix' => 'user', 'namespace' => 'App\Modules\User\Controllers'], function() {
  	Route::get('/', function(){
        return 'hello user';
    })->name('user');
});