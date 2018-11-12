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

Route::post('alexa', 'AlexaRequestController@request');

Route::get('privacy-policy', 'AlexaRequestController@privacyPolicy');
Route::get('terms-of-use', 'AlexaRequestController@termsOfUse');
