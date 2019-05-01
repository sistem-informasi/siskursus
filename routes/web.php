<?php
use App\Http\Controllers\Hello;
use App\Http\Controllers\Admin\Contacts;

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/about', function () {
    return view('home');
});


Route::get('/hello/kaka/{nama}', 'Hello@index');

// Default Laravel Resource
Route::resource('/admin/contact', 'Admin\Contacts');

// Overwrite resource REST method to modify request then calling REST method
// Route::post('/example', 'ExampleController@modifyRequest');