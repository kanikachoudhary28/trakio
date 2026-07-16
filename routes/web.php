<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\SubjectAssignmentController;
use App\Http\Controllers\Admin\BatchController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\MarkController;
use App\Http\Controllers\Admin\WarningController;
use App\Http\Controllers\Teacher\MarksController;
use App\Http\Controllers\Teacher\ProfileController as TeacherProfileController;
use App\Http\Controllers\Teacher\StudentController as TeacherStudentController;
use App\Http\Controllers\Admin\AttendanceController as AdminAttendanceController;
use App\Http\Controllers\Teacher\TeacherDashboardController; 
use App\Http\Controllers\Teacher\AttendanceController as TeacherAttendanceController;
use App\Http\Controllers\Teacher\PerformanceController;
use App\Http\Controllers\Teacher\WarningController as TeacherWarningController;

use App\Http\Controllers\Student\StudentDashboardController;


Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();
        if ($user->role == 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role == 'student') {
            return redirect('/student/dashboard');
        } elseif ($user->role == 'teacher') {
            return redirect('/teacher/dashboard');
        }
    }
    return view('pages.home');
})->name('home');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Forgot Password
Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');  
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetForm'])->name('password.update'); 



Route::middleware(['auth'])->group(function () {

    /* --- 1. Admin Specific Routes (Role: Admin) --- */
    Route::middleware(['role:admin'])->group(function() {
        
        Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::resource('students', StudentController::class);
        Route::resource('teachers', TeacherController::class);
        Route::resource('subjects', SubjectController::class);
        Route::resource('batches', BatchController::class);
        Route::resource('assignments', SubjectAssignmentController::class);

        // Student Extra CRUD Routes
        Route::get('/admin/students', [StudentController::class, 'index'])->name('students.index');
        Route::get('/admin/students/create', [StudentController::class, 'create'])->name('students.create');
        Route::get('/admin/students/import', [StudentController::class, 'showImportForm'])->name('students.importForm');
        Route::post('/admin/students/import', [StudentController::class, 'importExcel']);
        Route::get('/admin/students/{id}/edit', [StudentController::class, 'edit'])->name('students.edit');
        Route::put('/admin/students/{id}', [StudentController::class, 'update'])->name('students.update');
        Route::delete('/admin/students/{id}', [StudentController::class, 'destroy'])->name('students.destroy');
       Route::get('admin/students/batch/{batch_id}', [StudentController::class, 'viewByBatch'])->name('students.by_batch');
       Route::get('admin/subjects/batch/{batch_id}', [SubjectController::class, 'viewByBatch'])->name('subjects.by_batch');
       Route::get('admin/attendance/batch/{batch_id}', [AttendanceController::class, 'viewByBatch'])->name('attendance.by_batch');
        // Attendance 
        Route::get('/admin/attendance', [AdminAttendanceController::class, 'adminIndex'])->name('attendance.index');
       //Route::get('/admin/attendance/view-sheet', [AdminAttendanceController::class, 'adminViewSheet'])->name('admin.attendance.viewSheet');
Route::get('admin/attendance/show-sheet', [AttendanceController::class, 'showSheet'])->name('attendance.show_sheet');
        // Marks Management
        Route::get('/admin/marks', [MarkController::class, 'index'])->name('marks.index');
        Route::get('/admin/marks/create', [MarkController::class, 'create'])->name('marks.create');
        Route::post('/admin/marks/store', [MarkController::class, 'store'])->name('marks.store');
        Route::get('/admin/marks/view-sheet', [MarkController::class, 'viewMarksSheet'])->name('marks.viewSheet');

        // Early Warnings System
        Route::get('/admin/warnings', [WarningController::class, 'index'])->name('warnings.index');
        Route::get('/admin/warnings/create', [WarningController::class, 'create'])->name('warnings.create');
        Route::post('/admin/warnings/store', [WarningController::class, 'store'])->name('warnings.store');
        Route::get('/admin/warnings/{id}/status/{status}', [WarningController::class, 'updateStatus'])->name('warnings.updateStatus');
    });

    /* --- 2. Teacher Workspace Routes (Role: Teacher) --- */
    Route::middleware(['role:teacher'])->group(function() {
        
        // Dashboard
        Route::get('/teacher/dashboard', [TeacherDashboardController::class, 'index'])->name('teacher.dashboard');
        
        // Attendance Modules 
        Route::get('/teacher/attendance/select', [TeacherAttendanceController::class, 'index'])->name('teacher.attendance.select');
        Route::get('/teacher/attendance/manage', [TeacherAttendanceController::class, 'manage'])->name('teacher.attendance.manage');
        Route::post('/teacher/attendance/store', [TeacherAttendanceController::class, 'store'])->name('teacher.attendance.store');
    
        // Teacher Marks Entry Routes
    Route::get('/teacher/marks/select', [MarksController::class, 'index'])->name('teacher.marks.select');
    Route::get('/teacher/marks/manage', [MarksController::class, 'manage'])->name('teacher.marks.manage');
    Route::post('/teacher/marks/store', [MarksController::class, 'store'])->name('teacher.marks.store');
      //  Teacher My Students Routes
    Route::get('/teacher/my-students', [TeacherStudentController::class, 'index'])->name('teacher.students.index');
    Route::get('/teacher/my-students/batch/{batch_id}', [TeacherStudentController::class, 'viewByBatch'])->name('teacher.students.batch');  
    // Teacher Profile Routes
    Route::get('/teacher/profile', [TeacherProfileController::class, 'index'])->name('teacher.profile.index');
    Route::post('/teacher/profile/update', [TeacherProfileController::class, 'update'])->name('teacher.profile.update');
    //  Performance Routes
    Route::get('/teacher/performance', [PerformanceController::class, 'index'])->name('teacher.performance.index');
    Route::get('/teacher/performance/batch/{batch_id}', [PerformanceController::class, 'viewBatch'])->name('teacher.performance.batch');

   //  Early Warning System Route 
    Route::get('/teacher/warnings', [TeacherWarningController::class, 'index'])->name('teacher.warnings.index');

    
    });

    /* --- 3. Student Specific Routes (Role: Student) --- */
    Route::middleware(['role:student'])->group(function() {
        Route::view('/student/dashboard', 'student.dashboard')->name('student.dashboard');
    //  TRAKIO Student Dashboard Route
    Route::get('/student/dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');
    // Naya Attendance History Route
    Route::get('/student/attendance', [StudentDashboardController::class, 'attendanceHistory'])->name('student.attendance');    
    Route::get('/student/results', [StudentDashboardController::class, 'results'])->name('student.results');
    Route::get('/student/profile', [StudentDashboardController::class, 'profile'])->name('student.profile');
    Route::post('/student/profile/update', [StudentDashboardController::class, 'updateProfile'])->name('student.profile.update');
    Route::get('/student/performance', [StudentDashboardController::class, 'performance'])->name('student.performance');
    Route::get('/student/warnings', [StudentDashboardController::class, 'warnings'])->name('student.warnings');
    
    });

    /* --- 4. Shared / Common Authed Routes --- */
    Route::resource('attendance', AdminAttendanceController::class)->except(['index', 'create', 'store']);
    Route::get('/admin/attendance/create', [AdminAttendanceController::class, 'teacherCreate'])->name('attendance.create');
    Route::post('/admin/attendance/store', [AdminAttendanceController::class, 'teacherStore'])->name('attendance.store');
    
    // AJAX Global Data Loaders
    Route::get('/get-subjects/{batch_id}', [SubjectAssignmentController::class, 'getSubjects'])->name('get.subjects');
    Route::get('/get-students/{batch_id}', [AdminAttendanceController::class, 'getStudents'])->name('attendance.getStudents');

});