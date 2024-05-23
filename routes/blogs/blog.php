<?php

use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;

Route::middleware('SubscriberMiddleware')->prefix('blogs')->name('blogs.')->group(function(){
    Route::post('CreateBlog', [BlogController::class , 'CreateBlog'])->name('CreateBlog');
    Route::post('UpdateBlog/{blog_id}', [BlogController::class , 'UpdateBlog'])->name('UpdateBlog');
    Route::delete('DeleteBlog/{blog_id}', [BlogController::class , 'DeleteBlog'])->name('DeleteBlog');
    Route::post('SearchByTitleBlog', [BlogController::class , 'SearchByTitleBlog'])->name('SearchByTitleBlog');
    Route::post('SearchAdvancedBlog', [BlogController::class , 'SearchAdvancedBlog'])->name('SearchAdvancedBlog');

});



