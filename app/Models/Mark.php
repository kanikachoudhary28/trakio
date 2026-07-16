<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    use HasFactory;

   
    protected $table = 'marks'; 

    protected $fillable = [
        'student_id',
        'subject_id',
        'assessment_type',
        'marks_obtained',
        'max_marks',
        'entered_by'
    ];

   
    
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'entered_by')->withDefault([
            'name' => 'System/Admin'
        ]);
    }
}