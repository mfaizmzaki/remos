<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'location_id',
        'date',
        'time',
        'chair_id'
    ];

    public function getDateAttribute($value){

        return Carbon::parse($value);
    }

    public function getTimeAttribute($value){
        return Carbon::parse($value)->format('h:i A');
    }
    public function location(){
        return $this->belongsTo(Location::class);
    }

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function user(){
        return $this->belongsTo(User::class, 'chair_id');
    }

    public function registration(){
        return $this->hasMany(Registration::class);
    }

}
