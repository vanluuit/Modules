<?php

Route::group(['middleware' => ['web'], 'module' => 'Home', 'prefix' => '', 'namespace' => 'Ext\Home\Controllers'], function() {
	Route::get('/', 'MainController@index')->name('home');
	Route::get('/search', 'MainController@search')->name('search');
	Route::get('/求人', 'MainController@fillter')->name('fillter');
	Route::get('/search/{search}', 'MainController@search')->name('searchs');

	Route::get('/ajaxlocation', 'MainController@location');

	Route::get('/octoparse/gettoken', 'OctoparseAvController@getToken');
	Route::get('/octoparse', 'OctoparseAvController@main');
	Route::get('/oct_site/{taskid}', 'OctoparseAvController@oct_site');
	Route::get('/sql_delete_die', 'OctoparseAvController@sql_delete_die');
	Route::get('/getParam', 'OctoparseAvController@getParam');

	Route::get('/scron', 'ScronController@main');

	Route::get('/statistical/{id}', 'StatisticalController@index')->name('statistical');
	Route::get('/statisticalads/{id}', 'StatisticalController@statisticalads')->name('statisticalads');
	
	Route::get('/advertise', 'PageController@advertise')->name('advertise');
	Route::get('/register/nUser', 'UserController@nUser')->name('register.nUser');
	Route::post('/register/nUser', 'UserController@postnUser')->name('register.postnUser');
	Route::get('/register/cUser', 'UserController@cUser')->name('register.cUser');
	Route::post('/register/cUser', 'UserController@postcUser')->name('register.postcUser');
	Route::get('/register_completed', 'UserController@register_completed')->name('register_completed');
	Route::get('/verify_user/{token}', 'UserController@getVerifyUser')->name('verify_user');
	Route::get('/login', 'UserController@login')->name('login');
	Route::post('/login', 'UserController@dologin')->name('dologin');
	Route::get('/logout', function() {
	 	Session::forget('users');
	 	Session::forget('roles');
	  	if(!Session::has('users'))
	   	{
	      	return redirect(route('login'));
	   	}
	})->name('logout');

	Route::get('/ajaxcity/{province}', 'LocationController@ajaxcity');
	Route::get('/ajaxcity', 'LocationController@ajaxcity')->name('ajaxcity');
	Route::post('/ajaxCheckUserExit', 'UserAdminController@ajaxCheckUserExit')->name('ajaxCheckUserExit');
	Route::post('/ajaxReceiveMail', 'UserAdminController@ajaxReceiveMail')->name('ajaxReceiveMail');
	Route::get('/very_mail_alert/{token}', 'UserAdminController@very_mail_alert')->name('very_mail_alert');
});