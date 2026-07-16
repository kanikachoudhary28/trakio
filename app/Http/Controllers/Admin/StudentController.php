<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use App\Models\Batch;
use App\Mail\StudentWelcomeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
class StudentController extends Controller
{
   /**
     * 1. Students Dashboard - Grouped by Semesters/Batches
     */
    public function index()
    {
       
        $batches = Batch::withCount('students')->get();
        
        return view('admin.student.liststudent', compact('batches'));
    }


    public function viewByBatch($batchId)
    {
        $batch = Batch::findOrFail($batchId);
     
        $students = Student::with('user')->where('batch_id', $batchId)->latest()->get();
        
        return view('admin.student.batch_students', compact('students', 'batch'));
    }

    /**
     * 2. Single Student Add Form (Manual View)
     */
    public function create()
    {
        $batches = Batch::all();
        return view('admin.student.studentform', compact('batches'));
    }

    /**
     * 3. Single Student Save Engine (Manual Form Submit)
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:users,email',
            'batch_id'    => 'required|exists:batches,id',
            'phone'       => 'nullable|string|max:20',
            'roll_number' => 'required|string|unique:students,roll_number',
          
            ]);


        $defaultPassword = trim($request->roll_number);

        // Create User account
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($defaultPassword),
            'role'     => 'student',
            'is_first_login'=>1,
            'email_verfied_at'=>Carbon::now(),
        ]);

        // Create Student Profile
        Student::create([
            'user_id'     => $user->id,
            'batch_id'    => $request->batch_id,
            'phone'       => $request->phone,
            'roll_number' => $request->roll_number,
        ]);

        // Trigger welcome email to student
        $emailData = [
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => $defaultPassword
        ];

        try {
            Mail::to($request->email)->send(new StudentWelcomeMail($emailData));
        } catch (\Exception $e) {
            \Log::error("Manual Student Mail failed: " . $e->getMessage());
        }

        return redirect()->route('students.index')->with('success', 'Student added successfully!');
    }

    /**
     * 4. Show Bulk Excel/CSV Import Form View
     */
    public function showImportForm()
    {
        $batches = Batch::all();
        return view('admin.student.import', compact('batches'));
    }

    /**
     * 5. Bulk CSV Import Engine 
     */
    public function importExcel(Request $request)
    {
        $request->validate([
            'batch_id'   => 'required|exists:batches,id',
            'excel_file' => 'required|max:5120', 
        ]);

        $batchId = $request->batch_id;
        $file = $request->file('excel_file');

        if (($handle = fopen($file->getRealPath(), 'r')) !== FALSE) {
            
            $headers = fgetcsv($handle, 1000, ',');
            $headers = array_map(function($header) {
                return strtolower(trim($header));
            }, $headers);

           
            while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                
                if (count($headers) !== count($data)) {
                    continue; 
                }

                $row = array_combine($headers, $data);

                $name  = isset($row['name']) ? trim($row['name']) : '';
                $email = isset($row['email']) ? trim($row['email']) : '';
                $phone = isset($row['phone']) ? trim($row['phone']) : '';
                
               
                $csvRollNumber = isset($row['rollno']) ? trim($row['rollno']) : (isset($row['roll_number']) ? trim($row['roll_number']) : '');

                if (empty($email) || empty($name)) {
                    continue;
                }

                $existingUser = User::where('email', $email)->first();
                if ($existingUser) {
                    continue;
                }

               
                if (!empty($csvRollNumber)) {
                    $rollNumber = $csvRollNumber;
                    
                    if (Student::where('roll_number', $rollNumber)->exists()) {
                        \Log::warning("Duplicate CSV Roll Number skipped: " . $rollNumber);
                        continue; 
                    }
                } else {
                    
                    $rollNumber = 'STU' . date('Y') . rand(1000, 9999);
                    while (Student::where('roll_number', $rollNumber)->exists()) {
                        $rollNumber = 'STU' . date('Y') . rand(1000, 9999);
                    }
                }

              
                $defaultPassword = $rollNumber;

                
                $user = User::create([
                    'name'             => $name,
                    'email'            => $email,
                    'password'         => Hash::make($defaultPassword),
                    'role'             => 'student',
                    'is_first_login'   => 1,
                    'email_verfied_at' => Carbon::now(),
                ]);

             
                Student::create([
                    'user_id'     => $user->id,
                    'batch_id'    => $batchId,
                    'phone'       => $phone ?: null,
                    'roll_number' => $rollNumber,
                ]);

             
                $emailData = [
                    'name'     => $name,
                    'email'    => $email,
                    'password' => $defaultPassword
                ];

                try {
                    Mail::to($email)->send(new StudentWelcomeMail($emailData));
                } catch (\Exception $e) {
                    \Log::error("Bulk Import Mail failed for " . $email . " - " . $e->getMessage());
                }
            }
            fclose($handle);
        }

        return redirect()->route('students.index')->with('success', 'Bulk CSV students imported successfully! Passwords are set to their respective Roll Numbers.');
    }
    /**
     * 6. Edit Student Form
     */
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        $user = User::findOrFail($student->user_id);
        $batches = Batch::all();
        
        return view('admin.student.studentedit', compact('student', 'user', 'batches'));
    }

    /**
     * 7. Update Student Data
     */
    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        $user = User::findOrFail($student->user_id);

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'batch_id' => 'required|exists:batches,id',
            'phone'    => 'nullable|string|max:20',
        ]);

        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        $student->update([
            'batch_id' => $request->batch_id,
            'phone'    => $request->phone,
        ]);

        return redirect()->route('students.index')->with('success', 'Student details updated successfully!');
    }

    /**
     * 8. Delete Student Account
     */
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        

        $user = User::find($student->user_id);
        if ($user) {
            $user->delete();
        }
        
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
    }
}