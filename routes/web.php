<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
Auth::routes();
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
Route::get('/', 'Auth\LoginController@showLoginForm')->name("Init");
Route::get('/logout', 'Auth\LoginController@logout');



Route::get('Home', 'DashboardController@getDashboard')->name('Home');

Route::get('Employee', 'EmployeeController@Employee')->name('Employee');
Route::get('AddEmployee', 'EmployeeController@AddEmployee')->name('AddEmployee');
Route::post('SaveEmployee', 'EmployeeController@SaveEmployee')->name('SaveEmployee');
Route::post('UpdateEmployee', 'EmployeeController@UpdateEmployee')->name('UpdateEmployee');
Route::post('rmEmployee', 'EmployeeController@rmEmployee')->name('rmEmployee');
Route::get('/EditEmployee/{id_employee}', 'EmployeeController@editEmployee')->name('EditEmployee');

Route::get('Usuarios', 'UsuarioController@getUsuarios')->name('Usuarios');
Route::post('SaveUsuario', 'UsuarioController@SaveUsuario')->name('SaveUsuario');
Route::post('DeleteUsuario', 'UsuarioController@DeleteUsuario')->name('DeleteUsuario');
Route::get('Asignar/{id_employee}', 'UsuarioController@Asignar')->name('Asignar');
Route::post('SaveAssigned', 'UsuarioController@SaveAssigned')->name('SaveAssigned');
Route::post('rmAssigned', 'UsuarioController@rmAssigned')->name('rmAssigned');

Route::get('Catalogos', 'CatalogoController@getCatalogos')->name('Catalogos');
Route::post('AddCatalogo', 'CatalogoController@AddCatalogo')->name('AddCatalogo');
Route::post('rmCatalogo', 'CatalogoController@rmCatalogo')->name('rmCatalogo');
Route::post('UpdateCatalogo', 'CatalogoController@UpdateCatalogo')->name('UpdateCatalogo');

Route::get('Requests', 'RequestsController@getRequests')->name('Requests');
Route::post('SaveTypeRequest', 'RequestsController@SaveTypeRequest')->name('SaveTypeRequest');
Route::post('rmRequests', 'RequestsController@rmRequests')->name('rmRequests');
Route::post('UpdateRequest', 'RequestsController@UpdateRequest')->name('UpdateRequest');
Route::post('SaveRequest', 'RequestsController@SaveRequest')->name('SaveRequest');


Route::get('Payrolls', 'PayrollsController@getPayrolls')->name('Payrolls');
Route::post('SavePayroll', 'PayrollsController@SavePayroll')->name('SavePayroll');
Route::post('EmployeeTypePayroll', 'PayrollsController@EmployeeTypePayroll')->name('EmployeeTypePayroll');
Route::get('EditPayrolls/{id_employee}', 'PayrollsController@EditPayrolls')->name('EditPayrolls/{id_employee}');
Route::get('IngresosEgresos/{id_employee}/{id_payroll}', 'PayrollsController@IngresosEgresos')->name('IngresosEgresos/{id_employee}/{id_payroll}');


