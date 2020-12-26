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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('version',function(){
    return response()->json([
        'version_code'=>1,
        'version_name'=>'1.0',
        'message'   => 'Update Please',
        'is_force'  => true,
        'is_ad'=>false,
        'app_id'=>'appid',
        'app_inter'=>'app_inter',
        'link'=> 'www'
    ]); 
});

Route::post('visitor','APIController@visitor');
Route::post('favourite','APIController@favourite');

Route::get('home','APIController@home');
Route::post('search','APIController@search');
Route::get('category','APIController@category');
Route::post('item/category','APIController@itemByCategory');
Route::post('item/fav','APIController@favList');
Route::get('movie','APIController@movie');
Route::post('movie/detail','APIController@movieDeatil');
Route::post('movie/download','APIController@downloadMovie');
Route::post('movie/watch','APIController@watchMovie');
Route::get('series','APIController@series');
Route::post('series/detail','APIController@seriesDetail');
Route::post('episode','APIController@season');
Route::post('episode/detail','APIController@episode');
Route::post('episode/download','APIController@downloadEpisode');
Route::post('episode/watch','APIController@watchEpisode');
Route::get('news','APIController@news');
Route::post('news/detail','APIController@newsDetail');
