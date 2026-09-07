<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Psychologist extends Model
{
    use HasFactory;

    // PENTING: Beri tahu Laravel nama tabelnya 'psychologists'
    protected $table = 'psychologists';
    
    // PENTING: Karena primary key di DB Anda 'psy_id', bukan 'id'
    protected $primaryKey = 'psy_id';
    
    protected $guarded = [];
}