<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('login', 'LoginController@login')->name('api.login');

Route::middleware('auth')
    ->group(function () {

        Route::post('logout', 'LoginController@logout');
        Route::get('profile', 'LoginController@profile');

        Route::get('leads', 'LeadController@get');
        Route::post('leads', 'LeadController@create');
        Route::get('leads/dashboard', 'LeadController@dashboard');
        Route::get('leads/{id}', 'LeadController@detail');
        Route::post('leads/{id}/update', 'LeadController@update');
        Route::delete('leads/{id}', 'LeadController@delete');
        Route::patch('leads/{id}/status', 'LeadController@updateStatus');

        Route::get('settings/statuses', 'SettingController@getStatus');
        Route::get('settings/types', 'SettingController@getType');
        Route::get('settings/probabilities', 'SettingController@getProbability');
        Route::get('settings/channels', 'SettingController@getChannel');
        Route::get('settings/medias', 'SettingController@getMedia');
        Route::get('settings/sources', 'SettingController@getSource');
        Route::get('settings/branch-offices', 'SettingController@getBranchOffice');

        Route::post('onu/check', 'OnuController@checkOnu');

    });
