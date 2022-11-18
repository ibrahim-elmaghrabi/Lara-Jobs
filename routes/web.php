<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


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



Route::get('/ ', [ListingController::class , 'index'])->name('listings.index');

Route::post('/listings' , [ListingController::class , 'store'])->name('listings.store')->middleware('auth');

Route::get('/listings/createJob' , [ListingController::class , 'create'])->name('listings.create')->middleware('auth') ;

Route::get('/listings/manage' , [ListingController::class , 'manage'])->name('listings.manage')->middleware() ;

Route::get('/listings/{listing}', [ListingController::class , 'show' ])->name('listings.show');

Route::put('/listings/{listing}' , [ListingController::class , 'update'])->name('listings.update')->middleware('auth') ;

Route::delete('listings/{listing}' , [ListingController::class , 'destroy'])->name('listings.destroy')->middleware('auth') ;

Route::get('/listings/{listing}/edit' , [ListingController::class , 'edit'])->name('listings.edit')->middleware('auth') ;


/// users

Route::get('users/register' , [UserController::class , 'create'])->name('users.create')->middleware('guest') ;

Route::post('/users' , [UserController::class , 'store' ])->name('users.store') ;

Route::get('/users/login' , [UserController::class , 'login'])->name('users.login')->middleware('guest') ;

Route::post('users/authenticate' , [UserController::class , 'authenticate'])->name('users.authenticate') ;

Route::post('/logout' , [UserController::class , 'logout'])->name('users.logout')->middleware('auth') ;
