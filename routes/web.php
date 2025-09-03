<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TreasurerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChurchSavingController;
use App\Http\Controllers\CashflowController;
use App\Http\Controllers\Api\AuditLogController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\PledgeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ExpenseController;

Route::get('/', function () {
    return view('landing');
});

Route::get('/landing', function () {
    return view('landing');
})->name('landing');

Route::post('/donate/submit', [DonationController::class, 'store'])->name('donate.submit');
Route::post('/donation/store', [DonationController::class, 'store'])->name('donation.store');
Route::get('/project', [ProjectController::class, 'publicProjects'])->name('landing.project');
Route::get('/project', [ProjectController::class, 'publicProjects'])->name('landing.project');

    // Authentication Routes
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
    Route::get('/forgot', [AuthController::class, 'showForgot'])->name('forgot');
    Route::post('/forgot', [AuthController::class, 'forgot'])->name('forgot.post');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('reset.password');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('reset.password.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Protected Routes (Requires Auth)
    Route::middleware(['auth'])->group(function () {

    // Super Admin Routes
    Route::middleware([\App\Http\Middleware\RoleMiddleware::class . ':super_admin'])->group(function () {
        Route::get('/admin/home', [AdminController::class, 'dashboard'])->name('admin.home');
        Route::get('/admin/useraccess', [AdminController::class, 'useraccess'])->name('admin.useraccess');
        Route::get('/admin/userlogs', [AdminController::class, 'userlogs'])->name('admin.userlogs');
        Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
        Route::post('/admin/users', [AdminController::class, 'createUser'])->name('admin.users.create');
        Route::put('/admin/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
        Route::delete('/admin/users/{user}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
    });

    // Treasurer Routes
    Route::middleware([\App\Http\Middleware\RoleMiddleware::class . ':treasurer'])->group(function () {
        Route::get('/treasurer/home', [TreasurerController::class, 'dashboard'])->name('treasurer.home');
        Route::get('/treasurer/cshflw', [TreasurerController::class, 'cshflw'])->name('treasurer.cshflw');
        Route::get('/treasurer/project', [TreasurerController::class, 'project'])->name('treasurer.project');
        Route::get('/treasurer/savings', [TreasurerController::class, 'savings'])->name('treasurer.savings');
        Route::get('/savings', [ChurchSavingController::class, 'index'])->name('treasurer.savings.api');
        Route::post('/savings', [ChurchSavingController::class, 'store'])->name('treasurer.savings.store');
        Route::get('/treasurer/audit', [TreasurerController::class, 'audit'])->name('treasurer.audit');
        Route::get('/treasurer/reports', [TreasurerController::class, 'reports'])->name('treasurer.reports');   
        Route::get('/treasurer/cashflow/summary', [CashflowController::class, 'getSummary'])
            ->name('treasurer.cashflow.summary');
        Route::get('/treasurer/cashflow/weekly', [CashflowController::class, 'getWeeklyIncome'])->name('treasurer.cashflow.weekly');
        Route::get('/audit-logs', [AuditLogController::class, 'index']);
        Route::post('/audit-logs', [AuditLogController::class, 'store']);
            
        Route::get('/treasurer/pledges', [PledgeController::class, 'index'])->name('treasurer.pledges');
        Route::post('/treasurer/pledges', [PledgeController::class, 'store'])->name('treasurer.pledges.store');
        Route::get('/treasurer/pledges', [PledgeController::class, 'showPledgeLogs'])->name('treasurer.pledges');

        // Fetch donation logs (used in treasurer dashboard)
        Route::get('/treasurer/donate', [DonationController::class, 'index'])->name('treasurer.donate');

        // Cashflow Routes (Treasurer only)
        Route::prefix('cashflow')->group(function () {
            // Main views & reports
            Route::get('/', [CashflowController::class, 'index'])->name('cashflow.index');
            Route::get('/reports', [CashflowController::class, 'reports'])->name('cashflow.reports');
            

            // Data retrieval
            Route::get('/data/{date}', [CashflowController::class, 'getData'])->name('cashflow.data');
            Route::get('/income-entries/{date}', [CashflowController::class, 'getIncomeEntries'])->name('cashflow.income.entries');
            Route::get('/expense-entries/{date}', [CashflowController::class, 'getExpenseEntries'])->name('cashflow.expense.entries');
            Route::get('/previous-records', [CashflowController::class, 'getPreviousRecords'])->name('cashflow.previous.records');

            // Save routes
            Route::post('/save', [CashflowController::class, 'save'])->name('cashflow.save');
            Route::post('/save-income-entries', [CashflowController::class, 'saveIncomeEntries'])->name('cashflow.save.income');
            Route::post('/expense/save-entries', [ExpenseController::class, 'storeEntries']);

            // Delete
            Route::delete('/delete/{date}', [CashflowController::class, 'deleteRecord'])->name('cashflow.delete');

            //Project
            Route::get('/projects', [ProjectController::class, 'index'])->name('treasurer.projects');
            Route::post('/projects', [ProjectController::class, 'store'])->name('treasurer.projects.store');
            Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('treasurer.projects.edit');
            Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('treasurer.projects.update');
            Route::post('/projects/{project}/toggle', [ProjectController::class, 'toggle'])->name('treasurer.projects.toggle');
            Route::post('/projects/{project}/delete', [ProjectController::class, 'destroy'])->name('treasurer.projects.delete');
            });
});

    // Member Routes
    Route::middleware([\App\Http\Middleware\RoleMiddleware::class . ':member'])->group(function () {
        Route::get('/member/home', [MemberController::class, 'memberDashboard'])->name('member.home');
        Route::get('/member/donations', [UserController::class, 'donations'])->name('member.donations');
        Route::post('/member/donations', [UserController::class, 'makeDonation'])->name('member.donations.create');
        Route::post('/profile/update', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
        Route::get('/home-project', [ProjectController::class, 'memberProjects'])->name('home.projects');
    });
});