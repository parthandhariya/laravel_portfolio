<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Pages\PagesController;
use App\Http\Controllers\ThemeOption\ThemeOptionController;
use App\Http\Controllers\FrontUser\FrontUserController;
use App\Http\Controllers\Property\PropertyController;
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

	//return redirect()->route('front.index');

    if(\Auth::check()){
    	 return redirect()->route('home');    	 
    }else{
    	return redirect()->route('login');    	
    }
});



/*Route::resource('front',FrontUserController::class);*/



Route::group(['prefix' => 'guest'], function(){
	
	Route::get('login',[AuthController::class,'index'])->name('login');
	Route::post('login',[AuthController::class,'login'])->name('login');

	Route::get('register',[AuthController::class,'registerView'])->name('register');
	Route::post('register',[AuthController::class,'register'])->name('register');

	Route::get('forgotpassword',[ForgotPasswordController::class,'forgotPasswordView'])->name('forgotpassword');
	Route::post('forgotpassword',[ForgotPasswordController::class,'submitForgetPasswordForm'])->name('submitforgotpasswordform');
	Route::get('resetpassword/{token}', [ForgotPasswordController::class,'resetPasswordFormView'])->name('resetpasswordget');
	Route::post('resetpassword', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('resetpasswordpost');

});

Route::group(['middleware' => 'customauth:user','prefix' => 'user'], function(){

	//dd('user');
	Route::get('home',[AuthController::class,'home'])->name('home');
	Route::get('profile',[AuthController::class,'profile'])->name('profile');
	Route::post('profile',[AuthController::class,'profileUpdate'])->name('profile');

	Route::post('updatepassword',[AuthController::class,'updatePassword'])->name('update.password');

	Route::resource('pages', PagesController::class);
	Route::get('pagesList', [PagesController::class,'getList'])->name('pages.list');

	Route::resource('themeoption', ThemeOptionController::class);
	Route::get('themeoptionList', [ThemeOptionController::class,'getList'])->name('themeoption.list');

	Route::resource('property', PropertyController::class);
	Route::get('propertyList', [PropertyController::class,'getList'])->name('property.list');
	Route::get('editpropertyimage/{id}', [PropertyController::class,'editImage'])->name('editpropertyimage');
	Route::post('updatepropertyimage', [PropertyController::class,'updateImage'])->name('updatepropertyimage');
	Route::post('deletepropertyimage', [PropertyController::class,'destroySelectedImage'])->name('deletepropertyimage');

});

Route::group(['middleware' => 'customauth:admin', 'prefix' => 'admin'], function(){

	Route::get('home',[AdminController::class,'home'])->name('admin.home');
	Route::resource('allusers', AdminController::class);
	Route::get('allusersList', [AdminController::class,'getList'])->name('allusers.list');
	Route::post('blockunblockuser', [AdminController::class,'blockUnblockUser'])->name('blockunblockuser');
	Route::post('resetuserpassword', [AdminController::class,'resetUserPassword'])->name('resetuserpassword');
});

Route::get('logout/{message?}',[AuthController::class,'logout'])->name('logout');