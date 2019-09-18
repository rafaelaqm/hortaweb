<?php

Route::get('/', ['uses' => 'Controller@homepage']);
Route::get('/cadastro', ['uses' => 'Controller@cadastrar']);

/**
*Rotas para Autenticação dos Usuarios
*============================================
*/
Route::get('/login', ['uses' => 'Controller@fazerlogin']);
Route::post('/login', ['as' => 'user.login','uses' => 'DashboardController@auth']);
Route::get('/dashboard', ['as' => 'user.dashboard','uses' => 'DashboardController@index']);

Route::get('user/moviment', ['as' => 'moviment.index', 'uses' => 'MovimentsController@index']);

Route::get('getback',['as' => 'moviment.getback', 'uses' => 'MovimentsController@getback']);
Route::post('getback',['as' => 'moviment.getback.store', 'uses' => 'MovimentsController@storeGetback']);

Route::get('moviment',['as' => 'moviment.application', 'uses' => 'MovimentsController@application']);
Route::post('moviment',['as' => 'moviment.application.store', 'uses' => 'MovimentsController@storeApplication']);

Route::get('moviment/all', ['as' => 'moviment.all', 'uses' => 'MovimentsController@all']);

Route::resource('user', 'UsersController');
Route::resource('institution', 'InstitutionsController');
Route::resource('group', 'GroupsController');
Route::resource('institution.plant', 'PlantsController');


Route::post('group/{group_id}/user', ['as' => 'group.user.store', 'uses' => 'GroupsController@userStore']);
