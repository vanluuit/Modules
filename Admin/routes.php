<?php

Route::group(['middleware' => ['web'], 'module' => 'Admin', 'prefix' => 'admin', 'namespace' => 'App\Modules\Admin\Controllers'], function() {
  	Route::get('/', function(){
        return 'hello admin';
    })->name('admin');
});