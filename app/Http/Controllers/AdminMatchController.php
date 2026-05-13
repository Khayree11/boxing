<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BoxingMatch;
use App\Models\Fighter;
use App\Models\Setting;

class AdminMatchController extends Controller
{
    // Menampilkan halaman admin beserta daftar pertandingan
    public function index()
    {
        $matches = BoxingMatch::with(['fighterA', 'fighterB'])->orderBy('scheduled_at', 'desc')->get();
        $fighters = Fighter::orderBy('name', 'asc')->get(); 
        
        // Mengambil link youtube global saat ini
        $youtubeLink = Setting::where('key', 'youtube_link')->first();
        
        return view('admin.matches.index', compact('matches', 'fighters', 'youtubeLink'));
    }

    // Menyimpan jadwal pertandingan baru (Sekarang HANYA untuk jadwal petarung)
    public function store(Request $request)
    {
        $data = $request->validate([
            'fighter_a_id' => 'required|exists:fighters,id',
            'fighter_b_id' => 'required|exists:fighters,id|different:fighter_a_id',
            'scheduled_at' => 'required|date',
        ]);

        $data['status'] = 'coming_soon';

        BoxingMatch::create($data);

        return redirect()->back()->with('success', 'Jadwal pertandingan berhasil ditambahkan!');
    }

    // Mengupdate status pertandingan (On Going / Finished)
    public function updateStatus(Request $request, $id)
    {
        $match = BoxingMatch::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:coming_soon,on_going,finished',
            'winner' => 'nullable|string|max:255'
        ]);

        $match->status = $request->status;
        
        // Jika status finished, simpan pemenangnya.
        if ($request->status === 'finished') {
            $match->winner = $request->winner;
        } else {
            $match->winner = null; 
        }

        $match->save();

        return redirect()->back()->with('success', 'Status pertandingan berhasil diupdate!');
    }

    // Menghapus pertandingan
    public function destroy($id)
    {
        $match = BoxingMatch::findOrFail($id);
        $match->delete();

        return redirect()->back()->with('success', 'Pertandingan berhasil dihapus!');
    }

    // Mengupdate Link Youtube Global
    public function updateYoutube(Request $request)
    {
        $request->validate(['youtube_link' => 'nullable|url']);

        Setting::updateOrCreate(
            ['key' => 'youtube_link'],
            ['value' => $request->youtube_link]
        );

        return redirect()->back()->with('success', 'Link YouTube Global berhasil diperbarui!');
    }

    // ========================================================
    // FUNGSI BARU: Mengupdate Informasi Event & Tiket Global
    // ========================================================
    public function updateEvent(Request $request)
    {
        $keys = ['event_name', 'event_location', 'event_gmaps', 'event_ticket'];
        
        foreach ($keys as $key) {
            if ($request->has($key)) {
                Setting::updateOrCreate(['key' => $key], ['value' => $request->$key]);
            }
        }

        if ($request->hasFile('event_poster')) {
            $path = $request->file('event_poster')->store('events', 'public');
            Setting::updateOrCreate(['key' => 'event_poster'], ['value' => $path]);
        }

        return redirect()->back()->with('success', 'Informasi Event & Tiket berhasil diperbarui!');
    }
}