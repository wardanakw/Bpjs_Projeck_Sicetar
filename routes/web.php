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
use App\Http\Controllers\KoreksiSlaController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/fkrtl', [FkrtlController::class, 'index'])->name('fkrtl.index');
 
    Route::get('/pelayanan', [PelayananController::class, 'index'])->name('pelayanan.index');
    Route::get('/pelayanan/create', [PelayananController::class, 'create'])->name('pelayanan.create');
    Route::post('/pelayanan', [PelayananController::class, 'store'])->name('pelayanan.store');
    Route::get('/pelayanan/{id}/edit', [PelayananController::class, 'edit'])->name('pelayanan.edit');
    Route::put('/pelayanan/{id}', [PelayananController::class, 'update'])->name('pelayanan.update');
    Route::delete('/pelayanan/{id}', [PelayananController::class, 'destroy'])->name('pelayanan.destroy');
    

    Route::get('/monitoring-sla', [PelayananController::class, 'monitoringSla'])->name('monitoring-sla');
    Route::get('/pelayanan/{id}/files', [PelayananController::class, 'getFiles'])->name('pelayanan.files');
    Route::get('/pelayanan/{id}/download/{type}', [PelayananController::class, 'downloadFile'])->name('pelayanan.download');
    Route::get('/check-file/{filename}', [PelayananController::class, 'checkFile'])->name('file.check');
    Route::get('/export', [ExportController::class, 'index'])->name('export.index');
    Route::get('/export/process', [ExportController::class, 'export'])->name('export.process');
    Route::get('/pelayanan/export/preview', [PelayananController::class, 'exportPreview'])->name('pelayanan.export.preview');
    Route::get('/rekap', [RekapController::class, 'index'])->name('rekap.index');
    Route::get('/rekap/export', [RekapController::class, 'export'])->name('rekap.export');
});


// Route::middleware(['auth', 'can:koreksi'])->group(function () {
    Route::get('/koreksi', [KoreksiSlaController::class, 'index'])->name('koreksi.index');
    Route::get('/koreksi/{id}/edit', [KoreksiSlaController::class, 'edit'])->name('koreksi.edit');
    Route::post('/koreksi/{id}/update', [KoreksiSlaController::class, 'update'])->name('koreksi.update');
    Route::delete('/koreksi/{id}', [KoreksiSlaController::class, 'destroy'])->name('koreksi.destroy');
// });

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

