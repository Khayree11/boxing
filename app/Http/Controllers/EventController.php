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
        // 1. Ambil SEMUA data pertandingan beserta relasi petarungnya
        $matches = BoxingMatch::with(['fighterA', 'fighterB'])->get();

        // 2. Pisahkan data langsung di Controller agar View (HTML) tidak error
        $onGoingMatch = $matches->where('status', 'on_going')->first();
        $comingSoonMatches = $matches->where('status', 'coming_soon')->sortBy('scheduled_at');
        $finishedMatches = $matches->where('status', 'finished')->sortByDesc('scheduled_at');

        // 3. Ambil link youtube global
        $youtubeSetting = Setting::where('key', 'youtube_link')->first();
        $youtubeLink = $youtubeSetting ? $youtubeSetting->value : null;

        // 4. Kirim SEMUA variabel yang dibutuhkan ke halaman utama
        return view('event.index', compact(
            'matches', 
            'onGoingMatch', 
            'comingSoonMatches', 
            'finishedMatches', 
            'youtubeLink'
        ));
    }

    public function fighters()
    {
        // Mengambil semua data fighter diurutkan berdasarkan abjad
        $fighters = Fighter::orderBy('name', 'asc')->get();
        
        return view('event.fighters', compact('fighters'));
    }

    public function eventsList()
    {
        // Mengambil data event dari Setting Global
        $eventName = Setting::where('key', 'event_name')->value('value') ?? 'COMBAT ARENA BOUT';
        $eventLocation = Setting::where('key', 'event_location')->value('value');
        $eventGmaps = Setting::where('key', 'event_gmaps')->value('value');
        $eventTicket = Setting::where('key', 'event_ticket')->value('value');
        $eventPoster = Setting::where('key', 'event_poster')->value('value');

        return view('event.events', compact('eventName', 'eventLocation', 'eventGmaps', 'eventTicket', 'eventPoster'));
    }

    public function about()
    {
        return view('event.about');
    }
}