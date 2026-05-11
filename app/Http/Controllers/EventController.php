<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BoxingMatch;
use App\Models\Setting;
use App\Models\Fighter;

class EventController extends Controller
{
    public function index()
    {
        // Mengambil pertandingan yang sedang berlangsung
        $onGoingMatch = BoxingMatch::where('status', 'on_going')->first();
        
        // Mengambil jadwal yang akan datang
        $comingSoonMatches = BoxingMatch::where('status', 'coming_soon')->orderBy('scheduled_at', 'asc')->get();
        
        // Mengambil hasil pertandingan yang sudah selesai
        $finishedMatches = BoxingMatch::where('status', 'finished')->orderBy('scheduled_at', 'desc')->get();

        // Ambil link youtube global
        $youtubeSetting = Setting::where('key', 'youtube_link')->first();
        $youtubeLink = $youtubeSetting ? $youtubeSetting->value : null;

        return view('event.index', compact('onGoingMatch', 'comingSoonMatches', 'finishedMatches', 'youtubeLink'));
    }

    // FUNGSI INI YANG SEBELUMNYA HILANG DAN MEMBUAT ERROR
    public function fighters()
    {
        // Mengambil semua data fighter diurutkan berdasarkan abjad
        $fighters = Fighter::orderBy('name', 'asc')->get();
        
        return view('event.fighters', compact('fighters'));
    }
}