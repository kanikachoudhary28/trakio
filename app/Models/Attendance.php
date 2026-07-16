<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    // Aapke actual database columns ke mutabik fillable array
    protected $fillable = ['student_id', 'subject_id', 'date', 'status', 'marked_by'];

    // Teacher (User) ki relationship
public function marker()
{
    return $this->belongsTo(\App\Models\User::class, 'marked_by')->withDefault([
        'name' => 'System/Unknown'
    ]);
}

// Student ki relationship
public function student()
{
    return $this->belongsTo(\App\Models\Student::class, 'student_id');
}

// Subject ki relationship
public function subject()
{
    return $this->belongsTo(\App\Models\Subject::class, 'subject_id');
}
}
