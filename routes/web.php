<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\PelayananController;
use App\Http\Controllers\FkrtlController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\RekapController;


Route::get('/', function () {
    return redirect()->route('login');
});


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/monitoring-sla', [MonitoringController::class, 'index'])->name('monitoring.sla');
    Route::get('/fkrtl', [FkrtlController::class, 'index'])->name('fkrtl.index');
    Route::resource('pelayanan', PelayananController::class);
 
    Route::get('/pelayanan/{id}/files', [PelayananController::class, 'getFiles'])->name('pelayanan.files');
    Route::get('/pelayanan/{id}/download/{type}', [PelayananController::class, 'downloadFile'])->name('pelayanan.download');
    Route::get('/check-file/{filename}', [PelayananController::class, 'checkFile'])->name('file.check');
    Route::get('/export', [ExportController::class, 'index'])->name('export.index');
    Route::get('/export/process', [ExportController::class, 'export'])->name('export.process');
    Route::get('/pelayanan/export/preview', [PelayananController::class, 'exportPreview'])->name('pelayanan.export.preview');
    Route::get('/rekap', [RekapController::class, 'index'])->name('rekap.index');
    Route::get('/rekap/export', [RekapController::class, 'export'])->name('rekap.export');

});

Route::get('/test-storage', function () {
    $testContent = 'Test file content ' . date('Y-m-d H:i:s');
    Storage::put('public/files/test.txt', $testContent);
    $exists = Storage::exists('public/files/test.txt');
    $url = asset('storage/files/test.txt');
    $path = storage_path('app/public/files/test.txt');
    
    return response()->json([
        'storage_test' => $exists ? 'SUCCESS' : 'FAILED',
        'file_url' => $url,
        'file_path' => $path,
        'files_in_directory' => Storage::files('public/files')
    ]);

});






