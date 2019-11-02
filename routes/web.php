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

Route::view('/','home')->name('home');

// CRUD Mantenimientos
Route::resource('role', 'RoleController');
Route::resource('user', 'UserController');
Route::resource('convention', 'ConventionController');
Route::resource('salon', 'SalonController');
Route::resource('tiporeunion', 'ReunionTypeController');
Route::resource('ministry', 'MinistryController');
Route::resource('resource', 'ResourceController');

// Reservas
Route::get('/reserva','ReservaController@Init')->name('reserva.Init');
Route::post('/reserva','ReservaController@Store')->name('reserva.store');
Route::get('/reserva/getMinistry/{id}','ReservaController@getMinistry')->name('reserva.getMinistry');

/*Route::view('/quienes-somos','about')
	->name('about');

Route::resource('portafolio', 'ProjectController')
	->names('projects')
	->parameters(['portafolio' => 'project']);
*/
// Route::get('/portafolio','ProjectController@index')->name('projects.index');
// Route::get('/portafolio/crear','ProjectController@create')->name('projects.create');
// Route::get('/portafolio/{project}/editar','ProjectController@edit')->name('projects.edit');
// Route::patch('/portafolio/{project}','ProjectController@update')->name('projects.update');
// Route::post('/portafolio','ProjectController@store')->name('projects.store');
// Route::get('/portafolio/{project}','ProjectController@show')->name('projects.show');
// Route::delete('/portafolio/{project}','ProjectController@destroy')->name('projects.destroy');
/*
Route::view('/contacto','contact')
	->name('contact');

Route::post('contact', 'MessageController@store')
	->name('messages.store');
*/
Auth::routes(['register' => false]);
