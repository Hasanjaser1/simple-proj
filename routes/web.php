<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes(['verify'=> true]);

Route::get('/home', 'HomeController@index')->name('home') ->middleware('verified');

Route::get('/redirect/{service}','SocialController@redirect');

Route::get('/callback/{service}','SocialController@callback');

 
Route::get('fillable','CurdController@getOffers');

     Route::group(['prefix' =>LaravelLocalization::setLocale(),
     'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){
        Route::group(['prefix' => 'offers'], function(){
            Route::get('create','CurdController@create');
            Route::post('store','CurdController@store')-> name('offer.store');

            Route::get('edit/{offer_id}','CurdController@editOffer');
            Route::post('update/{Ooffer_id}','CurdController@updateOffer')-> name('offer.update');


            Route::get('all','CurdController@getAllOffers');
        }); 
        Route::get('youtube','CurdController@getVideo');
});


