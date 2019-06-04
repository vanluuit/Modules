<?php

Route::group(['middleware' => ['web','App\Http\Middleware\Admin'], 'module' => 'Admin', 'prefix' => 'admin', 'namespace' => 'Ext\Admin\Controllers'], function() {
  	Route::get('/', 'AdminController@getIndex')->name('admin');
    Route::get('/nUser', 'UserController@nUser')->name('admin.nUser');
    Route::get('/nUser/edit/{id}', 'UserController@getnUserEdit')->name('admin.nUserEdit');
    Route::post('/nUser/confirm/{id}', 'UserController@postnUserConfirm')->name('admin.postnUserConfirm');
    Route::post('/nUser/edit/{id}', 'UserController@postnUserEdit')->name('admin.postnUserEdit');
    Route::get('/nUser/view/{id}', 'UserController@getnUserview')->name('admin.getnUserview');

    Route::get('/cUser', 'UserController@cUser')->name('admin.cUser');
    Route::get('/cUser/edit/{id}', 'UserController@getcUserEdit')->name('admin.cUserEdit');
    Route::post('/cUser/confirm/{id}', 'UserController@postcUserConfirm')->name('admin.postcUserConfirm');
    Route::post('/cUser/edit/{id}', 'UserController@postcUserEdit')->name('admin.postcUserEdit');
    Route::get('/cUser/view/{id}', 'UserController@getcUserview')->name('admin.getcUserview');

    Route::get('/mUser', 'UserController@mUser')->name('admin.mUser');
    Route::get('/mUser/edit/{id}', 'UserController@getmUserEdit')->name('admin.mUserEdit');
    Route::post('/mUser/confirm/{id}', 'UserController@postmUserConfirm')->name('admin.postmUserConfirm');
    Route::post('/mUser/edit/{id}', 'UserController@postmUserEdit')->name('admin.postmUserEdit');
    Route::get('/mUser/view/{id}', 'UserController@getmUserview')->name('admin.getmUserview');

    Route::get('/user/delete/{id}', 'UserController@userDelete')->name('admin.userDelete');
    Route::get('/user/loginto/{id}', 'UserController@userLoginto')->name('admin.userLoginto');


  	// Route::get('/crawling_wish', 'ManageController@crawling_wish')->name('crawling_wish');

    Route::get('/ads', 'AdsController@getIndex')->name('admin.ads');
    Route::get('/ads/add', 'AdsController@getAdd')->name('admin.addads');
    Route::post('/ads/confadd', 'AdsController@confAdd')->name('admin.confadd');
    Route::post('/ads/add', 'AdsController@postAdd')->name('admin.postaddads');
    Route::get('/ads/finish', 'AdsController@addfinish')->name('admin.addfinish');

    Route::get('/ads/edit/{id}', 'AdsController@getEdit')->name('admin.editads');
    Route::post('/ads/confedit/{id}', 'AdsController@confEdit')->name('admin.confedit');
    Route::post('/ads/edit/{id}', 'AdsController@postEdit')->name('admin.posteditads');
    Route::get('/ads/editfinish', 'AdsController@editfinish')->name('admin.editfinish');
    Route::get('/ads/view', 'AdsController@getView')->name('admin.viewads');
    Route::get('/ads/delete/{id}', 'AdsController@adsDelete')->name('admin.adsDelete');

    Route::get('/MonthOwnerCount', 'StatisticalController@MonthOwnerCount')->name('admin.MonthOwnerCount');
    Route::get('/YearOwnerCount', 'StatisticalController@YearOwnerCount')->name('admin.YearOwnerCount');
    Route::get('/AdsStatistical', 'StatisticalController@AdsStatistical')->name('admin.AdsStatistical');


   //  Route::get('/addcard', 'CardController@addcard')->name('addcard');
    // Route::get('/bill', 'CardController@bill')->name('bill');
  	
});