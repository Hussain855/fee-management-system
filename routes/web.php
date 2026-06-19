<?php

use App\Http\Controllers\ReceiptController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\TermController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\FeeStructureController;
use App\Http\Controllers\FeeDueController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\FineController;
use App\Http\Controllers\SettingController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {

    

Route::get('/students/{id}/profile', [StudentController::class, 'profile'])->name('students.profile');

    // PDF Export
Route::get('/students/pdf', [StudentController::class, 'exportPdf'])->name('students.pdf');
Route::get('/payments/pdf', [PaymentController::class, 'exportPdf'])->name('payments.pdf');
Route::get('/students/{id}/profile/pdf', [StudentController::class, 'profilePdf'])->name('students.profile.pdf');



// Settings
Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');

    Route::get('/receipts', [ReceiptController::class, 'index'])->name('receipts.index');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Classes
    Route::get('/classes', [ClassController::class, 'index'])->name('classes.index');
    Route::get('/classes/create', [ClassController::class, 'create'])->name('classes.create');
    Route::post('/classes', [ClassController::class, 'store'])->name('classes.store');
    Route::get('/classes/{id}/edit', [ClassController::class, 'edit'])->name('classes.edit');
    Route::put('/classes/{id}', [ClassController::class, 'update'])->name('classes.update');
    Route::delete('/classes/{id}', [ClassController::class, 'destroy'])->name('classes.destroy');

    // Sections
    Route::get('/sections', [SectionController::class, 'index'])->name('sections.index');
    Route::get('/sections/create', [SectionController::class, 'create'])->name('sections.create');
    Route::post('/sections', [SectionController::class, 'store'])->name('sections.store');
    Route::get('/sections/{id}/edit', [SectionController::class, 'edit'])->name('sections.edit');
    Route::put('/sections/{id}', [SectionController::class, 'update'])->name('sections.update');
    Route::delete('/sections/{id}', [SectionController::class, 'destroy'])->name('sections.destroy');

    // Terms
    Route::get('/terms', [TermController::class, 'index'])->name('terms.index');
    Route::get('/terms/create', [TermController::class, 'create'])->name('terms.create');
    Route::post('/terms', [TermController::class, 'store'])->name('terms.store');
    Route::get('/terms/{id}/edit', [TermController::class, 'edit'])->name('terms.edit');
    Route::put('/terms/{id}', [TermController::class, 'update'])->name('terms.update');
    Route::delete('/terms/{id}', [TermController::class, 'destroy'])->name('terms.destroy');

    // Students
    Route::get('/students', [StudentController::class, 'index'])->name('students.index');
    Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
    Route::post('/students', [StudentController::class, 'store'])->name('students.store');
    Route::get('/students/{id}/edit', [StudentController::class, 'edit'])->name('students.edit');
    Route::put('/students/{id}', [StudentController::class, 'update'])->name('students.update');
    Route::delete('/students/{id}', [StudentController::class, 'destroy'])->name('students.destroy');
    Route::get('/students/{id}/profile', [StudentController::class, 'profile'])->name('students.profile');

    // Fee Structure
    Route::get('/fee_structure', [FeeStructureController::class, 'index'])->name('fee_structure.index');
    Route::get('/fee_structure/create', [FeeStructureController::class, 'create'])->name('fee_structure.create');
    Route::post('/fee_structure', [FeeStructureController::class, 'store'])->name('fee_structure.store');
    Route::get('/fee_structure/{id}/edit', [FeeStructureController::class, 'edit'])->name('fee_structure.edit');
    Route::put('/fee_structure/{id}', [FeeStructureController::class, 'update'])->name('fee_structure.update');
    Route::delete('/fee_structure/{id}', [FeeStructureController::class, 'destroy'])->name('fee_structure.destroy');

    // Fee Dues
    Route::get('/fee_dues', [FeeDueController::class, 'index'])->name('fee_dues.index');
    Route::get('/fee_dues/create', [FeeDueController::class, 'create'])->name('fee_dues.create');
    Route::post('/fee_dues', [FeeDueController::class, 'store'])->name('fee_dues.store');
    Route::get('/fee_dues/{id}/edit', [FeeDueController::class, 'edit'])->name('fee_dues.edit');
    Route::put('/fee_dues/{id}', [FeeDueController::class, 'update'])->name('fee_dues.update');
    Route::delete('/fee_dues/{id}', [FeeDueController::class, 'destroy'])->name('fee_dues.destroy');

    // Payments
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('/payments/create', [PaymentController::class, 'create'])->name('payments.create');
    Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');
    Route::get('/payments/{id}', [PaymentController::class, 'show'])->name('payments.show');
    Route::delete('/payments/{id}', [PaymentController::class, 'destroy'])->name('payments.destroy');

    // Discounts
    Route::get('/discounts', [DiscountController::class, 'index'])->name('discounts.index');
    Route::get('/discounts/create', [DiscountController::class, 'create'])->name('discounts.create');
    Route::post('/discounts', [DiscountController::class, 'store'])->name('discounts.store');
    Route::get('/discounts/{id}/edit', [DiscountController::class, 'edit'])->name('discounts.edit');
    Route::put('/discounts/{id}', [DiscountController::class, 'update'])->name('discounts.update');
    Route::delete('/discounts/{id}', [DiscountController::class, 'destroy'])->name('discounts.destroy');

    // Fines
    Route::get('/fines', [FineController::class, 'index'])->name('fines.index');
    Route::get('/fines/create', [FineController::class, 'create'])->name('fines.create');
    Route::post('/fines', [FineController::class, 'store'])->name('fines.store');
    Route::get('/fines/{id}/edit', [FineController::class, 'edit'])->name('fines.edit');
    Route::put('/fines/{id}', [FineController::class, 'update'])->name('fines.update');
    Route::delete('/fines/{id}', [FineController::class, 'destroy'])->name('fines.destroy');

});