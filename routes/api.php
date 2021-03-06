<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\AssignmentRequestController;
use App\Http\Controllers\CommentController;

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
Route::get('/departmentusers/{dept_id}', [UserController::class, 'departmentUsers']);

Route::post('/department', [DepartmentController::class, 'store']);
Route::get('/departments', [DepartmentController::class, 'index']);

Route::get('/depttickets/{dept_id}', [TicketController::class, 'deptTickets']);
Route::patch('/ticketupdate/{ticket_id}', [TicketController::class, 'update']);
Route::get('/ticket/{id}', [TicketController::class, 'show']);
Route::get('/usertickets/{user}', [TicketController::class, 'userTickets']);

Route::post('/assignmentrequest', [AssignmentRequestController::class, 'store']);
Route::get('/deptassignmentrequest/{id}', [AssignmentRequestController::class, 'getDeptRequests']);
Route::patch('/assignmentrequest/{id}', [AssignmentRequestController::class, 'update']);

Route::get('/ticketcomments/{id}', [CommentController::class, 'ticketComments']);
Route::post('/comment', [CommentController::class, 'store']);