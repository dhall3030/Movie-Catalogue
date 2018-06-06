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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/upload', function () {
    return view('upload.upload');
});

Route::post('upload', ['as' => 'upload-file', 'uses' =>'ImageUploadController@store']);


Route::get('/', 'MovieController@index');

//Route::get('movies', 'MovieController@index');

Route::get('create-movie', 'MovieController@create');
Route::post('create-movie', ['as' => 'create-movie', 'uses' =>'MovieController@store']);


Route::get('edit-movie/{movie_id}', 'MovieController@edit');
Route::post('edit-movie/{movie_id}', ['as' => 'edit-movie', 'uses' =>'MovieController@update']);


Route::get('delete-movie/{movie_id}', 'MovieController@destroy');

