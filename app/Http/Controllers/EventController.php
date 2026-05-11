<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BoxingMatch;

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

        return view('event.index', compact('onGoingMatch', 'comingSoonMatches', 'finishedMatches'));
    }
}