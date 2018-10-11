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


Route::get('laravel-version', function()
{
$laravel = app();
return "Your Laravel version is ".$laravel::VERSION;
});

//Get Laravel Version
Route::get('laravel-version', function()
{
$laravel = app();
return "Your Laravel version is ".$laravel::VERSION;
});



Route::get('/', 'MovieController@index');



//upload test routes
Route::get('/upload', function () {
    return view('upload.upload');
});

Route::post('upload', ['as' => 'upload-file', 'uses' =>'ImageUploadController@store']);



//movie routes
//Route::get('movies', 'MovieController@index');
Route::get('create-movie', 'MovieController@create');
Route::post('create-movie', ['as' => 'create-movie', 'uses' =>'MovieController@store']);
Route::get('edit-movie/{movie_id}', 'MovieController@edit');
Route::post('edit-movie/{movie_id}', ['as' => 'edit-movie', 'uses' =>'MovieController@update']);
Route::get('set-primary-image/{image_id}', 'MovieController@setPrimaryImage');
Route::get('delete-movie/{movie_id}', 'MovieController@destroy');
Route::get('delete-image/{image_id}', 'MovieController@removeImage');




//Email 

Route::post('send', 'EmailController@send');

