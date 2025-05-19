<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UmkmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.umkm');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        // $Umkm = Umkm::findOrFail($id);
        // return view('pages.content', compact('Umkm'));
        return view('pages.content');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('umkm.edit', compact('umkm'));
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_umkm' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto_utama' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'list_foto.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        // Update foto utama jika diunggah
        if ($request->hasFile('foto_utama')) {
            Storage::disk('public')->delete($umkm->foto_utama);
            $umkm->foto_utama = $request->file('foto_utama')->store('umkm', 'public');
        }
    
        // Update list foto jika diunggah
        if ($request->hasFile('list_foto')) {
            // Hapus foto lama
            $oldFotos = explode(',', $umkm->list_foto);
            foreach ($oldFotos as $old) {
                Storage::disk('public')->delete($old);
            }
    
            $listFotoNames = [];
            foreach ($request->file('list_foto') as $foto) {
                $path = $foto->store('umkm', 'public');
                $listFotoNames[] = $path;
            }
    
            $umkm->list_foto = implode(',', $listFotoNames);
        }
    
        $umkm->nama_umkm = $request->nama_umkm;
        $umkm->deskripsi = $request->deskripsi;
        $umkm->save();
    
        return redirect()->route('umkm.index')->with('success', 'UMKM berhasil diperbarui.');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Storage::disk('public')->delete($umkm->foto_utama);
        foreach (explode(',', $umkm->list_foto) as $foto) {
            Storage::disk('public')->delete($foto);
        }

        $umkm->delete();

        return redirect()->route('umkm.index')->with('success', 'UMKM berhasil dihapus.');
    }
}
