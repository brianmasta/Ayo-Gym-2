<?php

use App\Livewire\ManageUsers;
use App\Livewire\MemberCard;
use App\Livewire\MemberConfirmation;
use App\Livewire\MemberForm;
use App\Livewire\MembershipPlanForm;
use App\Livewire\MidtransPayment;
use App\Livewire\NonMemberForm;
use App\Livewire\PaymentForm;
use App\Livewire\PaymentReport;
use App\Livewire\Receipt;
use App\Livewire\Err404;
use App\Livewire\Err500;
use App\Livewire\Dashboard;
use App\Livewire\NonMember;
use App\Livewire\Auth\Login;
use App\Livewire\ReceiptMember;
use App\Livewire\ScanMember;
use App\Livewire\UpgradeToPro;
use App\Livewire\Auth\Register;
use App\Livewire\ResetPassword;
use App\Livewire\ForgotPassword;
use Illuminate\Support\Facades\Route;
use App\Livewire\KasirDashboard;
use App\Livewire\Member;
use App\Livewire\MembershipPlan;
use App\Livewire\Payment;
use App\Http\Controllers\MidtransCallbackController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/login');

Route::get('/register', Register::class)->name('register');

Route::get('/login', Login::class)->name('login');

Route::get('/forgot-password', ForgotPassword::class)->name('forgot-password');

Route::get('/reset-password/{id}', ResetPassword::class)->name('reset-password')->middleware('signed');

Route::get('/404', Err404::class)->name('404');
Route::get('/500', Err500::class)->name('500');
Route::get('/upgrade-to-pro', UpgradeToPro::class)->name('upgrade-to-pro');

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    Route::get('/membership-plan', MembershipPlan::class)->name('membership-plan');
    Route::get('/member', Member::class)->name('member');
    Route::get('/non-member', NonMember::class)->name('non-member');
    Route::get('/payment', Payment::class)->name('payment');
    Route::get('/member-card/{id}', MemberCard::class)->name('member-card');
    Route::get('/scan-member', ScanMember::class)->name('scan-member');
    Route::get('/non-member-form', NonMemberForm::class)->name('non-member-form');
    Route::get('/receipt/{orderId}', Receipt::class)->name('receipt');
    Route::get('/receipt-member/{orderId}', ReceiptMember::class)->name('receipt-member');
    Route::get('/kasir-dashboard', KasirDashboard::class)->name('kasir-dashboard');

    Route::get('/payment-form', PaymentForm::class)->name('payment-form');
    Route::get('/membership-plan-form', MembershipPlanForm::class)->name('membership-plan-form');
    Route::get('/member-form', MemberForm::class)->name('member-form');
    Route::get('/member-confirmation', MemberConfirmation::class)->name('member-confirmation');
    Route::get('/midtrans-payment', MidtransPayment::class)->name('midtrans-payment');
    Route::get('/manage-users', ManageUsers::class)->name('manage-users');

    Route::get('/payment-report', PaymentReport::class)->name('payment-report');
});


Route::middleware(['auth', 'role:kasir'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/kasir-dashboard', KasirDashboard::class)->name('kasir-dashboard');
    Route::get('/receipt/{orderId}', Receipt::class)->name('receipt');
    Route::get('/receipt-member/{orderId}', ReceiptMember::class)->name('receipt-member');
    Route::get('/scan-member', ScanMember::class)->name('scan-member');
    Route::get('/payment-form', PaymentForm::class)->name('payment-form');
    Route::get('/membership-plan-form', MembershipPlanForm::class)->name('membership-plan-form');
    Route::get('/member-form', MemberForm::class)->name('member-form');
    Route::get('/member-confirmation', MemberConfirmation::class)->name('member-confirmation');
    Route::get('/non-member-form', NonMemberForm::class)->name('non-member-form');
    Route::get('/member-card/{id}', MemberCard::class)->name('member-card');

});
