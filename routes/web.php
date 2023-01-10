<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerPDF;
use App\Models\PDF;

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

Route::get('/pdf', function () {
    $pdfs = PDF::all();
    //dd($pdfs);
    return view('pdfs')->with('pdfs', $pdfs);
});

Route::post('/pdf/register', 'ControllerPDF@store')->name('pdf_register');
Route::get('/pdf/file/{id}','ControllerPDF@urlfile')->name('pdf_file');
Route::post('/pdf/update','ControllerPDF@update')->name('pdf_update');
Route::get('/pdf/delete/{id}','ControllerPDF@destroy')->name('pdf_delete');
