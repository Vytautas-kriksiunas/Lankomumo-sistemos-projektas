<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'name',
        'description',
        'semester',
        'lecturer_id',
        'user_id',
    ];

    public function lecturer(){
        return $this->belongsTo(Lecturer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lectures()
    {
        return $this->hasMany(Lecture::class);
    }

}
