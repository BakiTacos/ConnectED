<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSlide extends Model
{
    // Beri tahu nama tabelnya (karena tidak standar plural)
    protected $table = 'hero_slides';
    
    // Primary Key tabel Anda adalah 'slide_id', bukan 'id'
    protected $primaryKey = 'slide_id';

    protected $fillable = [
        'image_url', 'title', 'description', 'cta_text', 'cta_link', 'sort_order'
    ];
}