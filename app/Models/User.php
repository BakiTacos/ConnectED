<?php

namespace App\Models;

// PENTING: Harus use Authenticatable, bukan Model biasa
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'user_id'; // Sesuai database kita

    public $timestamps = false;

    // app/Models/User.php

    protected $fillable = [
        'name',
        'email',
        'password',
        'nim',
        'role',
        'avatar_image',
        'phone',            // Pastikan ini ada
        'guardian_phone',   // TAMBAHKAN INI
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'user_id', 'user_id');
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Casting agar timestamps otomatis dikelola
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}