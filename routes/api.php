<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepartmentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/users', [UserController::class, 'index']);
Route::patch('/users/{user}', [UserController::class, 'update']);
Route::get('/users/{user}', [UserController::class, 'show']);
Route::post('/department', [DepartmentController::class, 'store']);
Route::get('/departments', [DepartmentController::class, 'index']);
Route::get('/depttickets/{dept_id}', [TicketController::class, 'deptTickets']);
Route::get('/departmentusers/{dept_id}', [UserController::class, 'departmentUsers']);
