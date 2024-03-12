<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalculatorController as Page;
use App\Http\Controllers\ProcessController as Process;

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
//     return view('index');
// });

Route::get('/', [Page::class, 'index']);
Route::post('calculator', [Page::class, 'calculator']);


//CRUD ROUTES
Route::get('/crud',[Process::class,'index']);
Route::get('/create',[Process::class,'create']);
Route::post('/create',[Process::class,'store']);
Route::get('/edit/{id}',[Process::class,'edit']);
Route::put('/edit/{id}',[Process::class,'update']);
Route::delete('/delete/{id}',[Process::class,'destroy']);
Route::get('/search',[Process::class,'search']);
Route::post('/upload',[Process::class,'importExcel']);
