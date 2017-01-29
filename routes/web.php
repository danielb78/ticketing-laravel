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
Route::get('about',  'PagesController@about');

Route::get('blog',   'BlogController@index');

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

    // Posts resource
    Route::get('posts', 'PostsController@index');
    Route::get('posts/create', 'PostsController@create');
    Route::post('posts/create', 'PostsController@store');
    Route::get('posts/{id}/edit', 'PostsController@edit');
    Route::post('posts/{id}/edit', 'PostsController@update');

    // Categories resource
    Route::get('categories', 'CategoriesController@index');
    Route::get('categories/create', 'CategoriesController@create');
    Route::post('categories/create', 'CategoriesController@store');
});
