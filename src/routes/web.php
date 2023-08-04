<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CustomerController;

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

Route::get('/', [ContactController::class, 'index'])->name('contact.form');
Route::post('/contacts/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');
Route::get('/contacts/edit', [ContactController::class, 'edit'])->name('contact.edit');
Route::post('/contacts/store', [ContactController::class, 'store'])->name('contact.store');



Route::get('/customer', [CustomerController::class, 'index'])->name('customer.system');
Route::get('/customer/search', [CustomerController::class, 'search'])->name('customer.search');
Route::get('/customer/reset', [CustomerController::class, 'reset'])->name('customer.reset');
Route::delete('/customer/delete', [CustomerController::class, 'destroy'])->name('customer.delete');
