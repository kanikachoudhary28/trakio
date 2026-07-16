<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['subject_name', 'subject_code', 'batch_id'];

    // Subject belongs to a Batch
    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }
}
