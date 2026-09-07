<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    // Pastikan Primary Key tabel booking benar (sesuaikan dengan database Anda)
    protected $primaryKey = 'booking_id'; 

    protected $fillable = [
        'user_id',
        'psychologist_id',
        'booking_date',
        'booking_time',
        'method',
        'type',
        'topic',
        'description',
        'hope',
        'media',
        'status'
    ];

    //RELASI KE MAHASISWA (USER)
    public function user()
    {
        // belongsTo(ModelTujuan, 'foreign_key_di_sini', 'primary_key_tujuan')
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    // === PERBAIKAN UTAMA ADA DI SINI ===
    public function psychologist()
    {
        // Kita harus memberi tahu Laravel secara detail:
        // 1. Model tujuannya adalah 'User' (bukan Psychologist lagi)
        // 2. Kolom penghubungnya di tabel booking adalah 'psychologist_id'
        // 3. Kolom tujuannya di tabel users adalah 'user_id'
        
        return $this->belongsTo(User::class, 'psychologist_id', 'user_id');
    }
}