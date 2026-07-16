<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warning extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'warning_type',
        'severity_level',
        'reason',
        'issue_date',
        'issued_by',
        'status'
    ];

    // RELATIONSHIPS
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function issuer()
    {
        return $this->belongsTo(User::class, 'issued_by')->withDefault([
            'name' => 'System/Admin'
        ]);
    }
}
