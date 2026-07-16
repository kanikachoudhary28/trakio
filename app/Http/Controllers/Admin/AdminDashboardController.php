<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Warning;
use App\Models\Teacher; 
use App\Models\Attendance;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // 1. Basic Counts
        $totalStudents = Student::count();
        $totalSubjects = Subject::count();
        $totalTeachers = Teacher::count(); 
        $totalWarnings = Warning::where('status', 'active')->count();

        // 2. Simple Attendance Rate Calculation
        $totalAttendance = Attendance::count();
        if ($totalAttendance > 0) {
            $presentCount = Attendance::where('status', 'present')->count();
            $attendanceRate = round(($presentCount / $totalAttendance) * 100);
        } else {
            $attendanceRate = 90; 
        }

        // Calculate At Risk and Passing Students for the dashboard widgets
        $atRiskCount = Warning::where('status', 'active')->distinct('student_id')->count();
        $passingStudents = max(0, $totalStudents - $atRiskCount);

    //    Load relationships and calculate warnings count dynamically
        $recentStudents = Student::with(['user', 'batch'])
            ->withCount([
                'warnings' => function($query) {
                    $query->where('status', 'active'); 
                }
            ])
            ->latest()
            ->take(5)
            ->get();

        // 4. Simple Chart Engine Setup
        $recentAttendance = Attendance::latest()->take(7)->get();

        $chartLabels = [];
        $chartPercentages = [];

        foreach ($recentAttendance as $record) {
            $chartLabels[] = date('d M', strtotime($record->date));
            $chartPercentages[] = ($record->status == 'present') ? 100 : 0;
        }

        if (empty($chartLabels)) {
            $chartLabels = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
            $chartPercentages = [80, 85, 90, 88, 92, 85, 95];
        }

        // Send everything to the view safely
        return view('admin.dashboard', compact(
            'totalStudents',
            'totalTeachers',
            'totalSubjects',
            'totalWarnings',
            'attendanceRate',
            'passingStudents', 
            'atRiskCount',     
            'recentStudents',
            'chartLabels',
            'chartPercentages'
        ));
    }
}