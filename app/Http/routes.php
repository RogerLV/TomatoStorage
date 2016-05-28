<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'PomodoroController@display');
Route::post('addActivity', 'PomodoroController@addActivity');
Route::get('getProjectList', 'PomodoroController@listProjects');
Route::get('getStoryList', 'PomodoroController@listStory');
Route::post('addTodo', 'PomodoroController@addTodo');
