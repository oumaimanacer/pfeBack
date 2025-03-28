<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\AuthenticatedSessionController;


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

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register.form');
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('loginF');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::get('/forgot-password', [PasswordResetController::class, 'create'])->name('password.request');
Route::post('/forgot-password', [PasswordResetController::class, 'store']);
Route::get('/reset-password/{token}', [PasswordResetController::class, 'edit'])->name('password.reset');
Route::post('/reset-password', [PasswordResetController::class, 'update']);
Route::middleware(['auth', 'role:SuperAdmin'])->group(function () {
Route::get('/entreprise/list', [AdminController::class, 'index'])->name('entreprise.list');
});
Route::middleware(['auth', 'role:SuperAdmin'])->group(function () {
Route::get('/entreprise/create', [AdminController::class, 'create'])->name('entreprise.create');
});
Route::middleware(['auth', 'role:SuperAdmin'])->group(function () {
Route::post('/entreprise/store', [AdminController::class, 'store'])->name('entreprise.store');
});
Route::middleware(['auth', 'role:SuperAdmin'])->group(function () {
Route::get('/entreprise/edit/{id}', [AdminController::class, 'edit'])->name('entreprise.edit');
});
Route::middleware(['auth', 'role:SuperAdmin'])->group(function () {
Route::put('/entreprise/update/{id}', [AdminController::class, 'update'])->name('entreprise.update');
});
Route::middleware(['auth', 'role:SuperAdmin'])->group(function () {
Route::delete('/entreprise/delete/{id}', [AdminController::class, 'destroy'])->name('entreprise.destroy');
});
Route::get('/formations', [FormationController::class, 'index'])->name('formations.index');
Route::get('/formations/edit/{id}', [FormationController::class, 'edit'])->name('formations.edit');
Route::put('/formations/{id}', [FormationController::class, 'update'])->name('formations.update');
Route::get('/formations/create', [FormationController::class, 'create'])->name('formations.create');
Route::post('/formations', [FormationController::class, 'store'])->name('formations.store');
Route::delete('/formations/{id}', [FormationController::class, 'destroy'])->name('formations.destroy');

