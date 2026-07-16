<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\BatchSubject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $student = Student::where('user_id', $user->id)->first();

        if (!$student) {
            Auth::logout();
            return redirect()->route('login')->withErrors(['email' => 'Student profile record missing.']);
        }

        $batchId = $student->batch_id;

   
        //  CARD 1: DYNAMIC ATTENDANCE RATE
        
        $totalDays = DB::table('attendances')->where('student_id', $student->id)->count();
        $presentDays = DB::table('attendances')->where('student_id', $student->id)->where('status', 'present')->count();
        $attendanceRate = $totalDays > 0 ? round(($presentDays / $totalDays) * 100) : 100;

     
        //  CARD 2: DYNAMIC AVERAGE MARKS
       
        $marksData = DB::table('marks')->where('student_id', $student->id)->get();
        $averageMarks = 0;
        if ($marksData->count() > 0) {
            $totalObtained = $marksData->sum('marks_obtained');
            $totalMax = $marksData->sum('max_marks');
            $averageMarks = $totalMax > 0 ? round(($totalObtained / $totalMax) * 100) : 0;
        }

      
        //  CARD 3: TOTAL ASSIGNED SUBJECTS COUNT
       
      
        $totalSubjects = DB::table('batch_subjects')->where('batch_id', $batchId)->count();
        if($totalSubjects == 0){
            $totalSubjects = DB::table('subject_assignments')->where('batch_id', $batchId)->count();
        }
      
        $totalSubjects = $totalSubjects > 0 ? $totalSubjects : 6;

      
        //  CARD 4: DYNAMIC TRAKIO WARNING TRIGGER
       
        $warningsCount = 0;
        if ($attendanceRate < 75) { $warningsCount++; }
        if ($marksData->count() > 0 && $averageMarks < 40) { $warningsCount++; }

      
        //  RECENT RESULTS TABLE DATA (Top 3 Scores)
        
        $recentResults = DB::table('marks')
            ->join('subjects', 'marks.subject_id', '=', 'subjects.id')
            ->where('marks.student_id', $student->id)
            ->select('subjects.subject_name', 'marks.marks_obtained', 'marks.max_marks', 'marks.assessment_type')
            ->orderBy('marks.updated_at', 'desc')
            ->take(4)
            ->get();

        return view('student.dashboard', compact(
            'user', 'student', 'attendanceRate', 'averageMarks', 'totalSubjects', 'warningsCount', 'recentResults'
        ));
    }
    //  Student Attendance History
public function attendanceHistory()
{
    $user = Auth::user();
    $student = Student::where('user_id', $user->id)->first();

    if (!$student) {
        return redirect()->route('login');
    }

   
    $attendanceRecords = DB::table('attendances')
        ->where('student_id', $student->id)
        ->orderBy('date', 'desc')
        ->get();

  
    $totalDays = $attendanceRecords->count();
    $presentDays = $attendanceRecords->where('status', 'present')->count();
    $absentDays = $attendanceRecords->where('status', 'absent')->count();
    $attendanceRate = $totalDays > 0 ? round(($presentDays / $totalDays) * 100, 1) : 100;

    return view('student.attendance', compact('attendanceRecords', 'totalDays', 'presentDays', 'absentDays', 'attendanceRate'));
}
// Student Results Report
public function results()
{
    $user = Auth::user();
    $student = Student::where('user_id', $user->id)->first();

    if (!$student) {
        return redirect()->route('login');
    }

    
    $results = DB::table('marks')
        ->join('subjects', 'marks.subject_id', '=', 'subjects.id')
        ->where('marks.student_id', $student->id)
        ->select('subjects.subject_name', 'marks.marks_obtained', 'marks.max_marks', 'marks.assessment_type', 'marks.updated_at')
        ->orderBy('marks.assessment_type', 'asc')
        ->get();

 
    $totalExams = $results->count();
    $passedExams = 0;
    
    foreach ($results as $row) {
        $percentage = $row->max_marks > 0 ? ($row->marks_obtained / $row->max_marks) * 100 : 0;
        if ($percentage >= 40) {
            $passedExams++;
        }
    }

    return view('student.results', compact('results', 'totalExams', 'passedExams'));
}
// 1. Profile view method 
public function profile()
{
    $user = Auth::user();
    $student = Student::where('user_id', $user->id)->first();
    return view('student.profile', compact('user', 'student'));
}

// 2. Profile update method
public function updateProfile(Request $request)
{
    $user = Auth::user();
    $student = Student::where('user_id', $user->id)->first();

    $request->validate([
        'phone' => 'nullable|string|max:15',
        'address' => 'nullable|string|max:255',
        'gender' => 'nullable|string|max:10',
        'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:10240'
    ]);

    if ($request->hasFile('profile_image')) {
        $imageName = time() . '.' . $request->profile_image->extension();  
        $request->profile_image->move(public_path('uploads/profiles'), $imageName);
        if ($student->image && file_exists(public_path($student->image))) { 
            @unlink(public_path($student->image)); 
        }
        $student->image = 'uploads/profiles/' . $imageName;
    }

    DB::table('students')->where('id', $student->id)->update([
        'phone' => $request->phone,
        'address' => $request->address,
        'gender' => $request->gender, 
        'image' => $student->image,
    ]);

    return redirect()->back()->with('success', 'Profile updated successfully!');
}
// Student Performance Page
public function performance()
{
    $user = Auth::user();
    $student = Student::where('user_id', $user->id)->first();
    if (!$student) return redirect()->route('login');

    // Attendance Rate for analytics
    $totalDays = DB::table('attendances')->where('student_id', $student->id)->count();
    $presentDays = DB::table('attendances')->where('student_id', $student->id)->where('status', 'present')->count();
    $attendanceRate = $totalDays > 0 ? round(($presentDays / $totalDays) * 100, 1) : 100;

    // Subject-wise Detailed Marks Breakdown
    $subjectPerformance = DB::table('marks')
        ->join('subjects', 'marks.subject_id', '=', 'subjects.id')
        ->where('marks.student_id', $student->id)
        ->select('subjects.subject_name', 'marks.marks_obtained', 'marks.max_marks', 'marks.assessment_type')
        ->get();

    return view('student.performance', compact('attendanceRate', 'subjectPerformance'));
}

// Student Warnings / Alerts Page
public function warnings()
{
    $user = Auth::user();
    $student = Student::where('user_id', $user->id)->first();
    if (!$student) return redirect()->route('login');

    // Re-calculate checks
    $totalDays = DB::table('attendances')->where('student_id', $student->id)->count();
    $presentDays = DB::table('attendances')->where('student_id', $student->id)->where('status', 'present')->count();
    $attendanceRate = $totalDays > 0 ? round(($presentDays / $totalDays) * 100, 1) : 100;

    $marksData = DB::table('marks')->where('student_id', $student->id)->get();
    $averageMarks = 0;
    if ($marksData->count() > 0) {
        $totalObtained = $marksData->sum('marks_obtained');
        $totalMax = $marksData->sum('max_marks');
        $averageMarks = $totalMax > 0 ? ($totalObtained / $totalMax) * 100 : 0;
    }

    // Risk Array Generator
    $activeAlerts = [];
    if ($attendanceRate < 75) {
        $activeAlerts[] = [
            'type' => 'Attendance Alert',
            'severity' => 'Critical',
            'message' => "Your attendance is currently at {$attendanceRate}%, which is below the mandatory 75% threshold.",
            'solution' => 'Please contact your batch coordinator and submit leave applications if applicable.'
        ];
    }
    if ($marksData->count() > 0 && $averageMarks < 40) {
        $activeAlerts[] = [
            'type' => 'Academic Score Alert',
            'severity' => 'Warning',
            'message' => "Your current aggregate score average is {$averageMarks}%, which needs immediate academic improvement.",
            'solution' => 'Attend extra remedial classes and connect with your respective subject teachers for mentorship.'
        ];
    }

    return view('student.warnings', compact('activeAlerts'));
}
}
