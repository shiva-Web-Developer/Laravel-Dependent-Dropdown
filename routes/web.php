<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Schoolcontroller;

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
    // return view('index');

    $result = DB::table('school_datas')
    ->select('district_name')
   ->groupBy('district_name')
   ->get();
    return view('index')->with('result',$result);
});


Route::post('api/fetch-states', [Schoolcontroller::class, 'fetchState']); //use for the get college list and district code 
Route::post('api/fetch-cities', [Schoolcontroller::class, 'fetchCity']);// use for college code and college mobile number

