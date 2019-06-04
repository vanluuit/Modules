<?php

Route::group(['middleware' => ['web','App\Http\Middleware\Users'], 'module' => 'User', 'prefix' => 'users', 'namespace' => 'Ext\User\Controllers'], function() {
  	Route::get('/mail_alert', 'UserAdminController@mail_alert')->name('mail_alert');
	Route::post('/mail_alert', 'UserAdminController@post_mail_alert')->name('post_mail_alert');
	Route::get('/bookmark', 'UserAdminController@bookmark')->name('bookmark');
	Route::post('/ajaxbookmark', 'UserAdminController@ajaxbookmark')->name('ajaxbookmark');

	Route::get('/edituser', 'UserController@edituser')->name('edituser');
	Route::post('/edituser', 'UserController@postedituser')->name('postedituser');
  	
});