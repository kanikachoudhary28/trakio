<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;

    protected $fillable = ['batch_name', 'academic_year']; 

  
    public function students()
    {
        return $this->hasMany(Student::class, 'batch_id');
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class, 'batch_id');
    }
}