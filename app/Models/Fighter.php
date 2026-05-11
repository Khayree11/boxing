<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fighter extends Model
{
    // WAJIB ADA: Mengizinkan kolom ini diisi data dari form
    protected $fillable = ['name', 'photo', 'height_cm', 'weight_kg', 'country'];

    // Opsional: Accessor untuk konversi Tinggi ke Feet/Inches
    public function getHeightFtAttribute()
    {
        $totalInches = $this->height_cm / 2.54;
        $feet = floor($totalInches / 12);
        $inches = round($totalInches % 12);
        return "{$feet}'{$inches}\"";
    }

    // Opsional: Accessor untuk konversi Berat ke Lbs
    public function getWeightLbsAttribute()
    {
        return round($this->weight_kg * 2.20462, 1) . " lbs";
    }
}