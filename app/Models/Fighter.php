<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fighter extends Model
{
    protected $fillable = ['name', 'photo', 'height_cm', 'weight_kg', 'country'];

    // Konversi Tinggi ke Feet/Inches
    public function getHeightFtAttribute()
    {
        $totalInches = $this->height_cm / 2.54;
        $feet = floor($totalInches / 12);
        $inches = round($totalInches % 12);
        return "{$feet}'{$inches}\"";
    }

    // Konversi Berat ke Lbs
    public function getWeightLbsAttribute()
    {
        return round($this->weight_kg * 2.20462, 1) . " lbs";
    }
}
