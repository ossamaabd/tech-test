<?php

use App\Http\Controllers\AuthContoller;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->name('auth.')->group(function(){
    Route::post('loginAdmin', [AuthContoller::class , 'loginAdmin'])->name('loginAdmin');
    Route::post('loginSubscriber', [AuthContoller::class , 'loginSubscriber'])->name('loginSubscriber')->middleware('LoggedInMiddleware');

});


