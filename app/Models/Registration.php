<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'event_id',
        'event_mode',
        'title',
        'abstract',
        'report_upload_path',
        'sv_1_id',
        'sv_2_id'
    ];


    public function student(){
        return $this->belongsTo(Student::class, 'student_id', 'user_id');
    }

    public function supervisor_1(){
        return $this->belongsTo(User::class, 'sv_1_id');
    }

    public function supervisor_2(){
        return $this->belongsTo(User::class, 'sv_2_id');
    }

    public function event(){
        return $this->belongsTo(Event::class);
    }
}


