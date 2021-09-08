<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;

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
Route::post('/ticket', [TicketController::class, 'store']);
Route::get('/authuser', [UserController::class, 'showAuthUser']);
Auth::routes();
Route::get('/{any}', function (){
    return view('home');
})->where('any', '.*')->middleware('auth');
