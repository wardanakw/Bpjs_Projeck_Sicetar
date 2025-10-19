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
use App\Http\Controllers\UploadController;

Route::get('/', fn() => redirect()->route('login'));

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {


    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/monitoring-sla', [PelayananController::class, 'monitoringSla'])->name('monitoring-sla');


    Route::middleware(['role:admin'])->group(function () {
        Route::resource('fkrtl', FkrtlController::class)->except(['show']);
});

    Route::middleware(['role:admin,finance'])->group(function () {
        Route::prefix('pelayanan')->name('pelayanan.')->group(function () {
            Route::get('/', [PelayananController::class, 'index'])->name('index');
            Route::get('/create', [PelayananController::class, 'create'])->name('create');
            Route::post('/', [PelayananController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [PelayananController::class, 'edit'])->name('edit');
            Route::put('/{id}', [PelayananController::class, 'update'])->name('update');
            Route::delete('/{id}', [PelayananController::class, 'destroy'])->name('destroy');
            Route::get('/{id}/files', [PelayananController::class, 'getFiles'])->name('files');
            Route::get('/{id}/download/{type}', [PelayananController::class, 'downloadFile'])->name('download');
            Route::get('/export/preview', [PelayananController::class, 'exportPreview'])->name('export.preview');
        });
    });

    Route::middleware(['role:keuangan,finance,verifikator,PMU'])->group(function () {
        Route::get('/pelayanan', [PelayananController::class, 'index'])->name('pelayanan.index');
    });

    Route::middleware(['role:admin,finance,PMU'])->group(function () {
        Route::prefix('koreksi')->name('koreksi.')->group(function () {
            Route::get('/', [KoreksiSlaController::class, 'index'])->name('index');
            Route::get('/{id}/edit', [KoreksiSlaController::class, 'edit'])->name('edit');
            Route::put('/{id}', [KoreksiSlaController::class, 'update'])->name('update');
            Route::delete('/{id}', [KoreksiSlaController::class, 'destroy'])->name('destroy');
        });
    });

    Route::middleware(['role:keuangan,finance,PMU'])->group(function () {
        Route::prefix('koreksi')->name('koreksi.')->group(function () {
            Route::get('/', [KoreksiSlaController::class, 'index'])->name('index');
            Route::get('/{id}/edit', [KoreksiSlaController::class, 'edit'])->name('edit');
            Route::put('/{id}', [KoreksiSlaController::class, 'update'])->name('update');
        });

        Route::get('/rekap', [RekapController::class, 'index'])->name('rekap.index');
    });
  
    Route::middleware(['role:admin,finance,keuangan,verifikator,PMU'])->group(function () {
        Route::get('/export', [ExportController::class, 'index'])->name('export.index');
        Route::get('/export/process', [ExportController::class, 'export'])->name('export.process');
        Route::get('/export/data-info', [ExportController::class, 'dataInfo'])->name('export.data-info');
        Route::get('/rekap', [RekapController::class, 'index'])->name('rekap.index');
        Route::get('/rekap/{id}/edit', [RekapController::class, 'edit'])->name('rekap.edit');
        Route::put('rekap/{id}', [RekapController::class, 'update'])->name('rekap.update');
        Route::get('/rekap/export', [RekapController::class, 'export'])->name('rekap.export');
    });

    Route::get('/check-file/{filename}', [PelayananController::class, 'checkFile'])->name('file.check');

   
    Route::middleware(['role:admin,finance,keuangan,PMU'])->group(function () {
        Route::prefix('upload')->group(function () {
            Route::post('/memorial/{id}', [UploadController::class, 'uploadMemorial'])->name('upload.memorial');
            Route::get('/download-memorial/{id}', [UploadController::class, 'downloadMemorial'])->name('upload.download.memorial');
            Route::delete('/delete-memorial/{id}', [UploadController::class, 'deleteMemorial'])->name('upload.delete.memorial');

            Route::post('/voucher/{id}', [UploadController::class, 'uploadVoucher'])->name('upload.voucher');
            Route::get('/download-voucher/{id}', [UploadController::class, 'downloadVoucher'])->name('upload.download.voucher');
            Route::delete('/delete-voucher/{id}', [UploadController::class, 'deleteVoucher'])->name('upload.delete.voucher');

            Route::get('/file-status/{id}', [UploadController::class, 'getFileStatus'])->name('upload.file.status');
        });
    });
});


Route::get('/test-storage', function () {
    $testContent = 'Test file content ' . date('Y-m-d H:i:s');
    Storage::put('public/files/test.txt', $testContent);

    return response()->json([
        'storage_test'      => Storage::exists('public/files/test.txt') ? 'SUCCESS' : 'FAILED',
        'file_url'          => asset('storage/files/test.txt'),
        'file_path'         => storage_path('app/public/files/test.txt'),
        'files_in_directory'=> Storage::files('public/files')
    ]);
});
