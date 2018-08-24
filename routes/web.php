<?php

Route::get('todos', 'TodoController@index');

Route::get('todos/create', 'TodoController@create');

Route::get('todos/{id}', 'TodoController@show');

Route::post('todos','TodoController@store');

Route::delete('todos/{id}', 'TodoController@destroy');

Route::get('todos/{id}/edit', 'TodoController@edit');

Route::put('todos/{id}', 'TodoController@update');

// Route::get('todo/{id}', function () {
//     return view('welcome');
// });
