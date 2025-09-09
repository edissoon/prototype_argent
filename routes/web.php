<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TreasurerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChurchSavingController;
use App\Http\Controllers\CashflowController;
use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PledgeController;
use App\Http\Controllers\ProjectController;

/*landing page*/


    //Donation Controller
    Route::post('/donate/submit', [DonationController::class, 'store'])->name('donate.submit');
    Route::post('/donation/store', [DonationController::class, 'store'])->name('donation.store');

    //Project Controller
    Route::get('/', [HomeController::class, 'allProject'])->name('landing');

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

    // Super Admin Routes - Admin Controller
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
        //Treasurer Controller
        Route::get('/treasurer/home', [TreasurerController::class, 'dashboard'])->name('treasurer.home');
        Route::get('/treasurer/cshflw', [TreasurerController::class, 'cshflw'])->name('treasurer.cshflw');
        Route::post('/treasurer/projects', [TreasurerController::class, 'project'])->name('treasurer.projects');
        Route::get('/treasurer/savings', [TreasurerController::class, 'savings'])->name('treasurer.savings');
        Route::get('/treasurer/audit', [TreasurerController::class, 'audit'])->name('treasurer.audit');
        Route::get('/treasurer/reports', [TreasurerController::class, 'reports'])->name('treasurer.reports'); 

        //Cashflow Controller
        Route::get('/treasurer/cashflow/summary', [CashflowController::class, 'getSummary'])
            ->name('treasurer.cashflow.summary');
        Route::get('/treasurer/cashflow/weekly', [CashflowController::class, 'getWeeklyIncome'])->name('treasurer.cashflow.weekly');

            // Cashflow Routes (Treasurer only)
            Route::prefix('cshflw')->group(function () {
                Route::get('/treasurer/cshflw', [CashflowController::class, 'index'])->name('treasurer.cshflw');
                Route::post('/treasurer/cshflw/load', [CashflowController::class, 'loadByDate'])->name('treasurer.cshflw.load');
                Route::post('/treasurer/cshflw/save', [CashflowController::class, 'store'])->name('treasurer.cshflw.save');
                Route::get('/treasurer/cshflw/archive', [CashflowController::class, 'archiveList'])->name('treasurer.cshflw.archive');
            });

        //Church Saving Controller
        Route::get('/savings', [ChurchSavingController::class, 'index'])->name('treasurer.savings.api');
        Route::post('/savings', [ChurchSavingController::class, 'store'])->name('treasurer.savings.store');

        //Project Controller
        Route::post('/treasurer/projects', [ProjectController::class, 'store'])->name('treasurer.projects.store');

            //Project Routes (Treasurer only)
            Route::get('/treasurer/projects', [ProjectController::class, 'index'])->name('treasurer.projects');
            Route::post('/treasurer/projects/store', [ProjectController::class, 'store'])->name('treasurer.projects.store');
            Route::patch('/projects/{id}/deactivate', [ProjectController::class, 'deactivate'])->name('treasurer.projects.deactivate');

        //Pledge Controller
        Route::get('/treasurer/pledges', [PledgeController::class, 'index'])->name('treasurer.pledges');
        Route::post('/treasurer/pledges', [PledgeController::class, 'store'])->name('treasurer.pledges.store');
        Route::get('/treasurer/pledges', [PledgeController::class, 'showPledgeLogs'])->name('treasurer.pledges');

        //Audit Log Controller
        Route::get('/audit-logs', [AuditLogController::class, 'index']);
        Route::post('/audit-logs', [AuditLogController::class, 'store']);
            
        // Fetch donation logs (fpr treasurer dashboard)
        Route::get('/treasurer/donate', [DonationController::class, 'index'])->name('treasurer.donate');
    }); // End Treasurer Routes
    
    // Member Routes
    Route::middleware([\App\Http\Middleware\RoleMiddleware::class . ':member'])->group(function () {
        //Member Controller
        Route::get('/member/home', [MemberController::class, 'memberDashboard'])->name('member.home');
        Route::get('member/home', [MemberController::class, 'memberIndex'])->name('member.home');

        //User Controller
        Route::get('/member/donations', [UserController::class, 'donations'])->name('member.donations');
        Route::post('/member/donations', [UserController::class, 'makeDonation'])->name('member.donations.create');

        Route::post('/profile/update', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    });

}); // End Protected Routes (Requires Auth)