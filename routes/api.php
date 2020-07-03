<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Slider;
use App\User;
use App\Company;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
  
    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
});

Route::get('getslider','WelcomeController@getSlider');
Route::get('getcompany','WelcomeController@getCompany');
Route::get('getgallery','WelcomeController@getGallery');

Route::middleware('auth:api')->get('slider','SliderController@index');
Route::get('slider/{id}','SliderController@finddata');
Route::post('slider','SliderController@store');
Route::put('slider/{slider}','SliderController@update');
Route::delete('slider/{slider}','SliderController@delete');

Route::middleware('auth:api')->get('company','CompanyController@index');
Route::get('company/{id}','CompanyController@finddata');
Route::post('company','CompanyController@store');
Route::put('company/{company}','CompanyController@update');
Route::delete('company/{company}','CompanyController@delete');

Route::middleware('auth:api')->get('gallery','GalleryController@index');
Route::get('gallery/{id}','GalleryController@finddata');
Route::post('gallery','GalleryController@store');
Route::put('gallery/{gallery}','GalleryController@update');
Route::delete('gallery/{gallery}','GalleryController@delete');