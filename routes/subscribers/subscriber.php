<?php

use App\Http\Controllers\SubscriberController;
use Illuminate\Support\Facades\Route;

Route::middleware(['AdminMiddleware'])->prefix('subscribers')->name('subscribers.')->group(function(){
    Route::post('/CreateSubscriber', [SubscriberController::class , 'CreateSubscriber'])->name('CreateSubscriber');
    Route::post('/UpdateSubscriber/{subscriber_id}', [SubscriberController::class , 'UpdateSubscriber'])->name('UpdateSubscriber');
    Route::delete('/DeleteSubscriber/{subscriber_id}', [SubscriberController::class , 'DeleteSubscriber'])->name('DeleteSubscriber');
    Route::post('/SearchByNameSubcriber', [SubscriberController::class , 'SearchByNameSubcriber'])->name('SearchByNameSubcriber');
    Route::post('/SearchAdvancedSubcriber', [SubscriberController::class , 'SearchAdvancedSubcriber'])->name('SearchAdvancedSubcriber');

});
