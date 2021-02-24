<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
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
    $page = 'home';
    return view('welcome', compact('page'));
});

Route::group(['middleware' => 'visitors'], function(){

    Route::get('/login/user', [LoginController::class, 'userLogin'])->name('userlogin');

    Route::get('/register/user', [UserController::class, 'userRegister'])->name('userregister');

    Route::Post('/login/user', [LoginController::class, 'userLoginPost'])->name('userlogin');

    Route::Post('/register/user', [UserController::class, 'userRegisterPost'])->name('userregister');
});

Route::group(['middleware' => 'usermid'], function(){
    Route::get('/user/dashboard', [UserController::class, 'userDashboard'])->name('userdash');
    Route::get('/user/search', [UserController::class, 'Search'])->name('search');
    Route::Post('/user/profile', [UserController::class, 'userProfileUpdate'])->name('updateuser');
    Route::get('/company/edit/{id}', [UserController::class, 'editCompany'])->name('editcompany');
    Route::Post('/company/edit', [UserController::class, 'editCompanyUpdate'])->name('updateusercompany');
    Route::get('/company/addnew', [UserController::class, 'addCompany'])->name('addcompany');
    Route::Post('/company/addnew', [UserController::class, 'addCompanyUpdate'])->name('addusercompany');
    Route::Post('/user/password', [UserController::class, 'userPasswordUpdate'])->name('userpassword');
    Route::get('/logout', [LoginController::class, 'Logout'])->name('logout');
    Route::get('/user/removecompany/{id}', [UserController::class, 'RemoveCompany'])->name('removecompany');
});
