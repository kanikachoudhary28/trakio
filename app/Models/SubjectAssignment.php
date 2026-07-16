<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectAssignment extends Model
{
    use HasFactory;
    protected $fillable=['teacher_id','batch_id','subject_id'];
   // Assignment belongs to a Teacher
    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }
    // Assignment belongs to a Batch
    public function batch(){
        return $this->belongsTo(Batch::class);
    }
    // Assignment belongs to a Subject
    public function subject(){
        return $this->belongsTo(Subject::class);
    }
}
