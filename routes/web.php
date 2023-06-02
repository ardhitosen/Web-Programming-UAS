<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ReservationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('patients.index');
    
});


Route::middleware('auth:admin')->group(function () {
    Route::get('/admins/dashboard', [AdminController::class, 'dashboard'])->name('admins.dashboard');
    Route::delete('/admins/dashboard/doctors/delete/{id}', [DoctorController::class, 'destroy'])->name('doctors.destroy');
    Route::put('/admins/dashboard/doctors/edit/{id}/update', [DoctorController::class, 'update'])->name('doctors.update');
    Route::get('/admins/dashboard/doctors/edit/{id}', [DoctorController::class, 'edit'])->name('doctors.edit');
    Route::get('/admins/dashboard/doctors', [AdminController::class, 'doctors'])->name('admins.doctors');
    Route::get('/admins/dashboard/doctors/create', [AdminController::class, 'doctorscreate'])->name('admins.doctors.create');
    Route::post('/admins/dashboard/doctors/create/store', [DoctorController::class, 'store'])->name('doctors.store');
    Route::get('/admins/dashboard/patients', [AdminController::class, 'patients'])->name('admins.patients');
    Route::get('/admins/dashboard/reservations', [ReservationController::class, 'index'])->name('admins.reservations');
    Route::post('/admins/logout', [AdminController::class, 'logout'])->name('admins.logout');
    Route::put('/admins/dashboard/reservations/{id}/approve', [ReservationController::class, 'approve'])->name('admins.reservations.approve');
    Route::put('/admins/dashboard/reservations/{id}/decline', [ReservationController::class, 'decline'])->name('admins.reservations.decline');
    
});

Route::get('/patients/forgot', [PatientController::class, 'forgot'])->name('patients.forgot');
Route::post('/patients/forgotProcess', [PatientController::class, 'forgotProcess'])->name('patients.forgotProcess');
Route::post('/patients/loginProcess', [PatientController::class, 'loginProcess'])->name('patients.loginProcess');
Route::get('/patients/login', [PatientController::class, 'login'])->name('patients.login');
Route::get('/patients/create', [PatientController::class, 'create'])->name('patients.create');


Route::middleware('auth:patient')->group(function () {
    Route::get('/patients/dashboard/doctorview/{doctor_id}/{patient_id}', [PatientController::class, 'doctorview'])->name('patients.doctorview');
    Route::get('/patients/dashboard/{id}', [PatientController::class, 'dashboard'])->name('patients.dashboard');
    Route::get('/patients/profile/{id}',[PatientController::class, 'profile'])->name('patients.profile');
    Route::post('/patients/logout', [PatientController::class, 'logout'])->name('patients.logout');
});

Route::resource('patients', PatientController::class)->except(['create']);


Route::post('/admins/loginProcess', [AdminController::class, 'loginProcess'])->name('admins.loginProcess');
Route::get('/admins/login', [AdminController::class, 'login'])->name('admins.login');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
