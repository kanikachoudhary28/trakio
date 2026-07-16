<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\Batch;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WarningController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $teacher = Teacher::where('user_id', $user->id)->first();

        if (!$teacher) {
            return redirect()->route('login');
        }

      
        $batchIds = Batch::where('teacher_id', $teacher->id)->pluck('id')->toArray();

       
        $allStudents = Student::with('user', 'batch')->whereIn('batch_id', $batchIds)->get();

        $atRiskStudents = [];

        
        foreach ($allStudents as $student) {
            
           
            $totalDays = DB::table('attendances')->where('student_id', $student->id)->count();
            $presentDays = DB::table('attendances')->where('student_id', $student->id)->where('status', 'present')->count();
            $attendancePercentage = $totalDays > 0 ? round(($presentDays / $totalDays) * 100, 1) : 100;

            $marksData = DB::table('marks')->where('student_id', $student->id)->get();
            $marksPercentage = null;
            if ($marksData->count() > 0) {
                $totalObtained = $marksData->sum('marks_obtained');
                $totalMax = $marksData->sum('max_marks');
                $marksPercentage = $totalMax > 0 ? round(($totalObtained / $totalMax) * 100, 1) : 0;
            }

           
            $isLowAttendance = $attendancePercentage < 75;
            $isLowMarks = ($marksPercentage !== null && $marksPercentage < 40);

            if ($isLowAttendance || $isLowMarks) {
              
                $recommendation = "";
                if ($isLowAttendance && $isLowMarks) {
                    $recommendation = "Arrange parent-teacher meeting & mandatory remedial classes.";
                } elseif ($isLowAttendance) {
                    $recommendation = "Verify medical reasons or counsel student regarding 75% attendance criteria.";
                } else {
                    $recommendation = "Provide extra assignments and peer-tutoring for academic improvement.";
                }

                $atRiskStudents[] = [
                    'roll_number' => $student->roll_number ?? 'N/A',
                    'name' => $student->user->name ?? 'Unknown',
                    'batch_name' => $student->batch->batch_name ?? 'N/A',
                    'attendance' => $attendancePercentage,
                    'marks' => $marksPercentage ?? 'N/A',
                    'reason' => $isLowAttendance && $isLowMarks ? 'Low Attendance & Poor Academic Score' : ($isLowAttendance ? 'Short Attendance' : 'Low Academic Score'),
                    'recommendation' => $recommendation
                ];
            }
        }

        return view('teacher.warnings.index', compact('atRiskStudents'));
    }
}
