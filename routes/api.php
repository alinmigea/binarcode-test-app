<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\SchedulerController;
use App\Http\Middleware\EnsureHeaderIsValid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware([EnsureHeaderIsValid::class])->group(function () {
    Route::get('reminders/', [SchedulerController::class, 'index']);
    Route::get('reminders/{scheduler}', [SchedulerController::class, 'show']);
    Route::delete('reminders/{scheduler}', [SchedulerController::class, 'destroy']);
    Route::post('reminders/schedule', [SchedulerController::class, 'store']);
});

Route::resource('posts', PostController::class);
