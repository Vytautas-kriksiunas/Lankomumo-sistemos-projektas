<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Lecture extends Model
{
    protected $fillable = [
        'subject_id',
        'created_by',
        'date',
        'qr_code',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public static function generateQrCode(): string
    {
        do {
            $code = strtoupper(Str::random(8));
        } while (self::where('qr_code', $code)->exists());

        return $code;
    }
}
