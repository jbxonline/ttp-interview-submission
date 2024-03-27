<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});
Route::model('widget', 'Widget');
Route::group(array('prefix' => 'widgets'), function() {
    Route::get('/', [
        'uses' => 'WidgetController@index',
        'as' => 'widgets.index'
    ]);
    Route::get('/new', [
        'uses' => 'WidgetController@create',
        'as' => 'widgets.new'
    ]);
    Route::post('/', [
        'uses' => 'WidgetController@store',
        'as' => 'widgets.store'
    ]);
    Route::get('/{widget}/edit', [
        'uses' => 'WidgetController@edit',
        'as' => 'widgets.edit'
    ]);
    Route::post('/{widget}/update', [
        'uses' => 'WidgetController@update',
        'as' => 'widgets.update'
    ]);
});

Route::group(array('prefix' => 'api'), function()
{

    Route::get('widgets', [
        'uses' => 'WidgetController@index'
    ]);

    Route::delete('widget/{widget}', [
        'uses' => 'WidgetController@destroy'
    ]);

});
