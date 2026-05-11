<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BoxingMatch extends Model
{
    // Mengizinkan kolom-kolom ini untuk diisi data
    protected $fillable = [
        'fighter_a_id', 
        'fighter_b_id', 
        'scheduled_at', 
        'status', 
        'winner', 
        'youtube_link'
    ];

    // Relasi ke tabel Fighter untuk Petarung A
    public function fighterA() {
        return $this->belongsTo(Fighter::class, 'fighter_a_id');
    }

    // Relasi ke tabel Fighter untuk Petarung B
    public function fighterB() {
        return $this->belongsTo(Fighter::class, 'fighter_b_id');
    }
}