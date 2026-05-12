<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fighter;
use Illuminate\Support\Facades\Storage;

class FighterController extends Controller
{
    public function index()
    {
        $fighters = Fighter::orderBy('name', 'asc')->get();
        return view('admin.fighters.index', compact('fighters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'height_cm' => 'required|integer',
            'weight_kg' => 'required|integer',
            'country' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('fighters', 'public');
        }

        Fighter::create([
            'name' => $request->name,
            'height_cm' => $request->height_cm,
            'weight_kg' => $request->weight_kg,
            'country' => $request->country,
            'photo' => $photoPath,
        ]);

        return redirect()->back()->with('success', 'Petarung berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $fighter = Fighter::findOrFail($id);
        
        // Hapus foto dari storage jika ada
        if ($fighter->photo) {
            Storage::disk('public')->delete($fighter->photo);
        }
        
        $fighter->delete();
        return redirect()->back()->with('success', 'Data petarung berhasil dihapus!');
    }

    public function update(Request $request, $id)
    {
        $fighter = Fighter::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'height_cm' => 'required|integer',
            'weight_kg' => 'required|integer',
            'country' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = [
            'name' => $request->name,
            'height_cm' => $request->height_cm,
            'weight_kg' => $request->weight_kg,
            'country' => $request->country,
        ];

        // Jika admin mengunggah foto baru
        if ($request->hasFile('photo')) {
            // Hapus foto lama dari storage agar tidak menumpuk
            if ($fighter->photo) {
                Storage::disk('public')->delete($fighter->photo);
            }
            // Simpan foto baru
            $data['photo'] = $request->file('photo')->store('fighters', 'public');
        }

        $fighter->update($data);

        return redirect()->back()->with('success', 'Data petarung berhasil diperbarui!');
    }
}