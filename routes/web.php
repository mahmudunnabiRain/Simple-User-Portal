<?php

use Illuminate\Support\Facades\Route;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [UserController::class, 'login'])->name('login');
Route::post('auth/login_user', [UserController::class, 'loginUser'])->name('loginUser');

Route::get('registration', [UserController::class, 'registration']);
Route::post('auth/create_user', [UserController::class, 'createUser'])->name('createUser');

Route::post('auth/logout', [UserController::class, 'logoutUser'])->name('logoutUser');

Route::get('profile', [UserController::class, 'profile'])->name('profile')->middleware('auth');

Route::get('admin', [UserController::class, 'userlist'])->name('userlist');

Route::get('getallusers', [UserController::class, 'getAllUsers']);

Route::get('searchusers/{keyword}', [UserController::class, 'searchUsers']);

Route::get('verifyemail/{email}', [UserController::class, 'verifyEmail']);