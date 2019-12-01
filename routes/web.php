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

// Pantalla Inicial Aplicación
Route::view('/','home')->name('home');

// CRUD Mantenimientos
Route::resource('role', 'RoleController');
Route::resource('user', 'UserController');
Route::resource('convention', 'ConventionController');
Route::resource('salon', 'SalonController');
Route::resource('tiporeunion', 'ReunionTypeController');
Route::resource('ministry', 'MinistryController');
Route::resource('resource', 'ResourceController');

Route::resource('department', 'DepartmentController');

// Actualizar Estado Eliminado
Route::patch('/convention/updateState/{convention}','ConventionController@updateState')->name('convention.updateState');
Route::patch('/ministry/updateState/{ministry}','MinistryController@updateState')->name('ministry.updateState');
Route::patch('/salon/updateState/{salon}','SalonController@updateState')->name('salon.updateState');
Route::patch('/tiporeunion/updateState/{tiporeunion}','ReunionTypeController@updateState')->name('tiporeunion.updateState');
Route::patch('/resource/updateState/{resource}','ResourceController@updateState')->name('resource.updateState');
Route::patch('/role/updateState/{role}','RoleController@updateState')->name('role.updateState');
Route::patch('/user/updateState/{user}','UserController@updateState')->name('user.updateState');
Route::patch('/department/updateState/{department}','DepartmentController@updateState')->name('department.updateState');

// Mis Reservas
Route::get('/mireserva','ReservaController@misInit')->name('reserva.miIndex');
Route::patch('/mireserva/delMiReserva/{reserve}','ReservaController@delMiReserva')->name('reserva.delMiReserva');

// Solicitud Reservas
Route::get('/reserva','ReservaController@Init')->name('reserva.Init');
Route::post('/reserva','ReservaController@Store')->name('reserva.store');
Route::get('/reserva/getMinistry/{id}','ReservaController@getMinistry')->name('reserva.getMinistry');
Route::get('/reserva/getResourceDesc/{id}','ReservaController@getResourceDesc')->name('reserva.getResourceDesc');

// Aprobación Reservas
Route::get('/gestReserva','ReservaController@IndexGestReserva')->name('reserva.Index');
Route::get('/gestReserva/{id}','ReservaController@showReserva')->name('reserva.Show');
Route::patch('/gestReserva/{id}','ReservaController@StoreGestReserva')->name('reserva.storeGestReserva');

// Reservar Reservas
Route::get('/resReserva','ReservaController@IndexResReserva')->name('reserva.resIndex');
Route::get('/resReserva/{id}','ReservaController@showResReserva')->name('reserva.resShow');
Route::patch('/resReserva/{id}','ReservaController@StoreResReserva')->name('reserva.storeResReserva');

// Calendario
Route::get('/calendario','CalendarController@index')->name('calendario.index');

// Route::get('/portafolio','ProjectController@index')->name('projects.index');
// Route::get('/portafolio/crear','ProjectController@create')->name('projects.create');
// Route::get('/portafolio/{project}/editar','ProjectController@edit')->name('projects.edit');
// Route::patch('/portafolio/{project}','ProjectController@update')->name('projects.update');
// Route::post('/portafolio','ProjectController@store')->name('projects.store');
// Route::get('/portafolio/{project}','ProjectController@show')->name('projects.show');
// Route::delete('/portafolio/{project}','ProjectController@destroy')->name('projects.destroy');

Auth::routes(['register' => false]);
//Route::view('/registro','auth.register')->name('register');
//Route::post('/registro','Auth\RegisterController@RegisterStore')->name('register.Store');