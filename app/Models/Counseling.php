<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Counseling extends Model
{
    use HasFactory;

    protected $table = 'counselings';
    protected $guarded = [];
    protected $primaryKey = 'counseling_id'; // Sesuai migrasi

    protected $fillable = [
        'booking_id',
        'user_id',
        'psychologist_id',
        'counselor_notes',
        'mental_issue_tag',
        'status'
    ];

    // Relasi ke Mahasiswa (User)
    public function student()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    // Relasi ke Psikolog (User)
    public function psychologist()
    {
        return $this->belongsTo(User::class, 'psychologist_id', 'user_id');
    }

    // Relasi ke Booking Asal
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id', 'booking_id');
    }
}