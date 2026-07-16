<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

  
    protected $fillable = [
        'user_id', 
        'roll_number', 
        'batch_id',
        'phone',
    'address',
    'image',
    'gender',

    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }
    /**
     * Get the warnings issued for this student.
     */
    public function warnings()
    {
        return $this->hasMany(\App\Models\Warning::class, 'student_id');
    }
}
