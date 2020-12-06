<?php

use Illuminate\Support\Facades\Route;

//Route::get('/', 'PageController@check');

Route::get('/',function(){
	return redirect('https://www.lolanimemyanmar.org');
});

Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();

Route::group(['middleware' => 'auth'], function () {
	//Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);

	Route::resource('admin','UserController');
	Route::resource('category', 'CategoryController');
	Route::resource('language', 'LanguageController');
	Route::resource('movie', 'MovieController');
	Route::resource('series', 'SeriesController');

	//season
	Route::get('series/{series_id}/season', 'SeasonController@index');
	Route::get('series/{series_id}/season/create', 'SeasonController@create');
	Route::post('season/create', 'SeasonController@store');
	Route::get('season/edit/{id}', 'SeasonController@edit');
	Route::post('season/update', 'SeasonController@update');
	Route::delete('season/delete/{id}', 'SeasonController@destroy');

	// movie episode
	Route::get('movie/{movie_id}/episode', 'MovieController@episodeList');
	Route::get('movie/{movie_id}/episode/create', 'MovieController@episodeCreate');
	Route::post('movie/episode/store', 'MovieController@episodeStore');
	Route::get('movie/episode/{id}/edit', 'MovieController@episodeEdit');
	Route::post('movie/episode/{id}/update', 'MovieController@episodeUpdate');
	Route::delete('movie/episode/delete/{id}', 'MovieController@episodeDelete');


	//series episode
	Route::get('season/{season_id}/episode', 'EpisodeController@index');
	Route::get('season/{season_id}/episode/create', 'EpisodeController@create');
	Route::post('episode/create', 'EpisodeController@store');
	Route::get('episode/{id}/edit', 'EpisodeController@edit');
	Route::post('episode/{id}/edit', 'EpisodeController@update');
	Route::delete('episode/delete/{id}', 'EpisodeController@destroy');

	Route::resource('visitor', 'VisitorController');
});

Route::get('vue/category/search', 'CategoryController@vue_category');
