<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'matric_id',
        'program',
        'current_semester',
        'mode_program',
        'mode_study',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function registration(){
        return $this->hasMany(Registration::class, 'student_id', 'user_id');
    }
}
