<?php

Route::group(['middleware' => ['web','App\Http\Middleware\Manager'], 'module' => 'Business', 'prefix' => 'business', 'namespace' => 'Ext\Business\Controllers'], function() {
  	Route::get('/', 'ManageController@getIndex')->name('business');
  	Route::get('/crawling_wish', 'ManageController@crawling_wish')->name('crawling_wish');

    Route::get('/ads', 'AdsController@getIndex')->name('ads');
    Route::get('/ads/add', 'AdsController@getAdd')->name('addads');
    Route::post('/ads/confadd', 'AdsController@confAdd')->name('confadd');
    Route::post('/ads/add', 'AdsController@postAdd')->name('postaddads');
    Route::get('/ads/finish', 'AdsController@addfinish')->name('addfinish');

    Route::get('/ads/edit/{id}', 'AdsController@getEdit')->name('editads');
    Route::post('/ads/confedit/{id}', 'AdsController@confEdit')->name('confedit');
    Route::post('/ads/edit/{id}', 'AdsController@postEdit')->name('posteditads');
    Route::get('/ads/editfinish', 'AdsController@editfinish')->name('editfinish');
    Route::get('/ads/view', 'AdsController@getView')->name('viewads');

    Route::get('/MonthOwnerCount', 'StatisticalController@MonthOwnerCount')->name('MonthOwnerCount');
    Route::get('/YearOwnerCount', 'StatisticalController@YearOwnerCount')->name('YearOwnerCount');
    Route::get('/AdsStatistical', 'StatisticalController@AdsStatistical')->name('AdsStatistical');


    Route::get('/addcard', 'CardController@addcard')->name('addcard');
    Route::get('/bill', 'CardController@bill')->name('bill');
  	
});