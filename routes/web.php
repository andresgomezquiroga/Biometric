<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FichaController;
use App\Http\Controllers\ProgramaController;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\ExcusesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('/')->group(function () {

    // Rutas para el login
    Route::get('/' , [AuthController::class, 'login'])->name('login');
    Route::post('/' , [AuthController::class, 'authenticate'])->name('authenticate');

    // Rutas para el registro
    Route::get('/register' , [AuthController::class, 'register'])->name('register.index');
    Route::post('/register' , [AuthController::class, 'store'])->name('register.store');

    // Rutas para el password reset
    Route::get('/forgot-password' , [AuthController::class, 'forgotPassword'])->name('forgot-password');
    Route::post('/forgot-password' , [AuthController::class, 'verifyEmail'])->name('verifyEmail');
    Route::get('/resetPassword/{token}' , [AuthController::class, 'resetPassword']);
    Route::post('/resetPassword' , [AuthController::class, 'updatePassword'])->name('updatePassword');

    // Rutas para el logout
    Route::get('/logout' , [AuthController::class, 'logout'])->name('logout');

});


Route::group(['middleware' => 'prevent-back-history-middleware'], function () {

    Route::middleware('auth')->group(function () {


        Route::get('/dashboard', function () {
            return view('home.homePage');
        })->name('dashboard');




        // Rutas para el perfil
        Route::get('/profile/edit', [UserController::class, 'profile_edit'])->name('profile.edit');
        Route::put('/profile/edit', [UserController::class, 'profile_update'])->name('profile.update');

        // Rutas para el usuario
        Route::get('/user', [UserController::class, 'index'])->name('user.index');
        Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/user', [UserController::class, 'store'])->name('user.store');
        Route::get('/user/{id}', [UserController::class, 'show'])->name('user.show');
        Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
        Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');

        Route::get('ficha', [FichaController::class, 'index'])->name('ficha.index');
        Route::get('ficha/create', [FichaController::class, 'create'])->name('ficha.create');
        Route::post('ficha', [FichaController::class, 'store'])->name('ficha.store');
        Route::get('ficha/{ficha}/edit', [FichaController::class, 'edit'])->name('ficha.edit');
        Route::put('ficha/update', [FichaController::class, 'update'])->name('ficha.update');
        Route::delete('ficha/{ficha}', [FichaController::class, 'destroy'])->name('ficha.destroy');

        Route::get('programa', [ProgramaController::class, 'index'])->name('programa.index');
        Route::get('programa/create', [ProgramaController::class, 'create'])->name('programa.create');
        Route::post('programa', [ProgramaController::class, 'store'])->name('programa.store');
        Route::get('programa/{programa}/edit', [ProgramaController::class, 'edit'])->name('programa.edit');
        Route::put('programa/{programa}', [ProgramaController::class, 'update'])->name('programa.update');
        Route::delete('programa/{programa}', [ProgramaController::class, 'destroy'])->name('programa.destroy');

        
        Route::get('attendance', [AsistenciaController::class, 'index'])->name('attendance.index');
        Route::get('attendance/create', [AsistenciaController::class, 'create'])->name('attendance.create');
        Route::post('attendance', [AsistenciaController::class, 'store'])->name('attendance.store');
        Route::get('attendance/{asistencia}/edit', [AsistenciaController::class, 'edit'])->name('attendance.edit');
        Route::put('attendance/{asistencia}', [AsistenciaController::class, 'update'])->name('attendance.update');
        Route::delete('attendance/{asistencia}', [AsistenciaController::class, 'destroy'])->name('attendance.destroy');

        Route::get('excuse', [ExcusesController::class, 'index'])->name('excuse.index');
        Route::get('excuse/create', [ExcusesController::class, 'create'])->name('excuse.create');
        Route::post('excuse', [ExcusesController::class, 'store'])->name('excuse.store');
        Route::get('excuse/{excuse}/edit', [ExcusesController::class, 'edit'])->name('excuse.edit');
        Route::put('excuse/{excuse}', [ExcusesController::class, 'update'])->name('excuse.update');
        Route::delete('excuse/{excuse}', [ExcusesController::class, 'destroy'])->name('excuse.destroy');
        Route::get('excuse/file/{filename}', [ExcusesController::class, 'viewFile'])->name('excuse.viewFile');
        
        
        
    });
});
