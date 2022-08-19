<?php


Route::prefix('subcription')->group(function() {
    Route::get('/', 'SubcriptionController@index');
    Route::resource('packages','PackageController');
    Route::resource('packages-invoices','InvoiceController');
    Route::resource('payment-methods','PaymentMethodController');

});
