<?php

Route::group(['namespace' => 'InstallerErag\Controllers', 'middleware' => ['web', 'installCheck']], function () {
     // Your routes go here
     Route::get('install', [InstallerErag\Controllers\InstallerController::class, 'index'])->name('installs');
     Route::post('install-check', [InstallerErag\Controllers\InstallerController::class, 'install_check'])->name('install_check');
     Route::get('database-import', [InstallerErag\Controllers\InstallerController::class, 'database_import'])->name('database_import');
     Route::post('save-Wizard', [InstallerErag\Controllers\InstallerController::class, 'saveWizard'])->name('saveWizard');
     Route::get('account', [InstallerErag\Controllers\InstallerController::class, 'account'])->name('account');
     Route::post('account-save', [InstallerErag\Controllers\InstallerController::class, 'saveAccount'])->name('saveAccount');
     Route::get('finish', [InstallerErag\Controllers\InstallerController::class, 'finish'])->name('finish');
     Route::get('finish-save', [InstallerErag\Controllers\InstallerController::class, 'finishSave'])->name('finishSave');
});
