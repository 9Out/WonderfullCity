<?php

namespace App\Http\Controllers;

use App\Models\LandingPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LandingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = LandingPage::first();
        return view('pages.home', compact('data'));
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
        $data = LandingPage::first();
        return view('admin.pages.landing', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $data = LandingPage::first();
        return view('admin.pages.update.landing-edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'website_detail' => 'required',
            'email' => 'required|email',
            'whatsapp' => 'required',
            'map_link' => 'required|url',
            'carousel.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'visual_umkm' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'visual_wisata' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $landing = LandingPage::first();
        $oldImages = $landing->carousel_images ?? array_fill(0, 6, null);
        $updatedImages = $oldImages;

        // Loop tiap slot input (0-5)
        for ($i = 0; $i < 6; $i++) {
            $remove = $request->input("remove_carousel.$i");
            $file = $request->file("carousel.$i");

            // Hapus gambar jika diminta
            if ($remove && $oldImages[$i]) {
                Storage::disk('public')->delete($oldImages[$i]);
                $updatedImages[$i] = null;
            }

            // Ganti dengan gambar baru jika ada
            if ($file) {
                if ($oldImages[$i]) {
                    Storage::disk('public')->delete($oldImages[$i]);
                }
                $updatedImages[$i] = $file->store('carousel', 'public');
            }
        }

        // Buang null lalu validasi minimal 3 gambar
        $filteredImages = array_filter($updatedImages);
        if (count($filteredImages) < 3) {
            return back()->withErrors(['carousel' => 'Minimal 3 gambar carousel harus disediakan.'])->withInput();
        }

        // Simpan kembali dengan posisi tetap
        $updatedImages = array_values(array_pad($filteredImages, 6, null));

        // Proses upload gambar visual UMKM
        if ($request->hasFile('visual_umkm')) {
            if ($landing && $landing->visual_umkm) {
                Storage::disk('public')->delete($landing->visual_umkm);
            }
            $visualUmkmPath = $request->file('visual_umkm')->store('visuals', 'public');
        } else {
            $visualUmkmPath = $landing->visual_umkm ?? null;
        }

        // Proses upload gambar visual Wisata
        if ($request->hasFile('visual_wisata')) {
            if ($landing && $landing->visual_wisata) {
                Storage::disk('public')->delete($landing->visual_wisata);
            }
            $visualWisataPath = $request->file('visual_wisata')->store('visuals', 'public');
        } else {
            $visualWisataPath = $landing->visual_wisata ?? null;
        }

        // Data yang akan disimpan
        $data = [
            'website_detail' => $request->website_detail,
            'email' => $request->email,
            'whatsapp' => $request->whatsapp,
            'map_link' => $request->map_link,
            'carousel_images' => $updatedImages,
            'visual_umkm' => $visualUmkmPath,
            'visual_wisata' => $visualWisataPath,
        ];

        // Update atau buat data baru
        if ($landing) {
            $landing->update($data);
        } else {
            LandingPage::create($data);
        }

        return redirect()->route('landing.show')->with('success', 'Landing page berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
