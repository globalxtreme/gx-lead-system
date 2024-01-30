<?php

use Illuminate\Support\Facades\Route;

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

Route::post('login', 'LoginController@login')->name('login');

Route::middleware('auth')
    ->group(function () {

        Route::post('logout', 'LoginController@logout');
        Route::get('profile', 'LoginController@profile');

        Route::get('leads', 'LeadController@get');
        Route::post('leads', 'LeadController@create');
        Route::get('leads/download', 'LeadController@download');
        Route::get('leads/dashboard', 'LeadController@dashboard');
        Route::get('leads/{id}', 'LeadController@detail');
        Route::post('leads/{id}/update', 'LeadController@update');
        Route::delete('leads/{id}', 'LeadController@delete');
        Route::patch('leads/{id}/status', 'LeadController@updateStatus');

        Route::get('settings/statuses', 'LeadStatusController@get');
        Route::post('settings/statuses', 'LeadStatusController@create');
        Route::put('settings/statuses/{id}', 'LeadStatusController@update');
        Route::delete('settings/statuses/{id}', 'LeadStatusController@delete');

        Route::get('settings/types', 'LeadTypeController@get');
        Route::post('settings/types', 'LeadTypeController@create');
        Route::put('settings/types/{id}', 'LeadTypeController@update');
        Route::delete('settings/types/{id}', 'LeadTypeController@delete');

        Route::get('settings/probabilities', 'LeadProbabilityController@get');
        Route::post('settings/probabilities', 'LeadProbabilityController@create');
        Route::put('settings/probabilities/{id}', 'LeadProbabilityController@update');
        Route::delete('settings/probabilities/{id}', 'LeadProbabilityController@delete');

        Route::get('settings/channels', 'LeadChannelController@get');
        Route::post('settings/channels', 'LeadChannelController@create');
        Route::put('settings/channels/{id}', 'LeadChannelController@update');
        Route::delete('settings/channels/{id}', 'LeadChannelController@delete');

        Route::get('settings/medias', 'LeadMediaController@get');
        Route::post('settings/medias', 'LeadMediaController@create');
        Route::put('settings/medias/{id}', 'LeadMediaController@update');
        Route::delete('settings/medias/{id}', 'LeadMediaController@delete');

        Route::get('settings/sources', 'LeadSourceController@get');
        Route::post('settings/sources', 'LeadSourceController@create');
        Route::put('settings/sources/{id}', 'LeadSourceController@update');
        Route::delete('settings/sources/{id}', 'LeadSourceController@delete');

        Route::get('settings/branch-offices', 'BranchOfficeController@get');
        Route::post('settings/branch-offices', 'BranchOfficeController@create');
        Route::put('settings/branch-offices/{id}', 'BranchOfficeController@update');
        Route::delete('settings/branch-offices/{id}', 'BranchOfficeController@delete');

    });
