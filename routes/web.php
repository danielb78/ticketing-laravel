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

// Static pages
Route::get('/',      'PagesController@home');
Route::get('about', 'PagesController@about');

// Tickets resource
Route::get('tickets',                'TicketsController@index');
Route::get('tickets/{slug}',         'TicketsController@show');
Route::get('tickets/{slug}/edit',    'TicketsController@edit');
Route::get('contact',                'TicketsController@create');
Route::post('contact',               'TicketsController@store');
Route::post('tickets/{slug}/edit',   'TicketsController@update');
Route::post('tickets/{slug}/delete', 'TicketsController@destroy');

// Comments resource
Route::post('comment', 'CommentsController@newComment');

// Users resource
Route::get('users/register',  'Auth\RegisterController@showRegistrationForm');
Route::post('users/register', 'Auth\RegisterController@register');
Route::get('users/logout',    'Auth\LoginController@logout');
Route::get('users/login',     'Auth\LoginController@showLoginForm');
Route::post('users/login',    'Auth\LoginController@login');

// Restricted area
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'manager'], function() {
    Route::get('/', 'PagesController@home');

    Route::get('users', [
        'as'   => 'admin.users.index',
        'uses' => 'UsersController@index',
    ]);
    Route::get('users/{id}/edit', 'UsersController@edit');
    Route::post('users/{id}/edit', 'UsersController@update');

    Route::get('roles', 'RolesController@index');
    Route::get('roles/create', 'RolesController@create');
    Route::post('roles/create', 'RolesController@store');
});
