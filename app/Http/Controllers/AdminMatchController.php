<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BoxingMatch;
use App\Models\Fighter; // <-- INI YANG KURANG SEBELUMNYA

class AdminMatchController extends Controller
{
    // Menampilkan halaman admin beserta daftar pertandingan
    public function index()
    {
        // Mengambil data match beserta relasi ke fighterA dan fighterB
        $matches = BoxingMatch::with(['fighterA', 'fighterB'])->orderBy('scheduled_at', 'desc')->get();
        
        // Mengambil semua data petarung untuk ditampilkan di dropdown form
        $fighters = Fighter::orderBy('name', 'asc')->get(); 
        
        return view('admin.matches.index', compact('matches', 'fighters'));
    }

    // Menyimpan jadwal pertandingan baru
    public function store(Request $request)
    {
        // Validasi sekarang mengecek apakah ID petarung ada di tabel fighters
        $request->validate([
            'fighter_a_id' => 'required|exists:fighters,id',
            'fighter_b_id' => 'required|exists:fighters,id|different:fighter_a_id', // Tidak boleh melawan diri sendiri
            'scheduled_at' => 'required|date',
            'youtube_link' => 'nullable|url'
        ]);

        BoxingMatch::create([
            'fighter_a_id' => $request->fighter_a_id,
            'fighter_b_id' => $request->fighter_b_id,
            'scheduled_at' => $request->scheduled_at,
            'status' => 'coming_soon',
            'youtube_link' => $request->youtube_link,
            'winner' => null // Pastikan saat pertama kali dibuat, tidak ada pemenang
        ]);

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
}