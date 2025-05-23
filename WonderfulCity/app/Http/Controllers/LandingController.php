<?php

namespace App\Http\Controllers;

use App\Models\LandingPage;
use App\Models\Umkm;
use App\Models\Wisata;
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
        $umkm = Umkm::orderBy('created_at', 'desc')->take(4)->get();
        $wisata = Wisata::orderBy('created_at', 'desc')->take(4)->get();
        return view('pages.home', compact(['data', 'umkm', 'wisata']));
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
            'map_link' => 'required|regex:/^https:\/\/www\.google\.com\/maps\/embed\?/i',
            'carousel.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'visual_umkm' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'visual_wisata' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'website_detail.required' => 'Deskripsi website wajib diisi.',

            'email.required' => 'Email wajib diisi.',
            'email.email'    => 'Format email tidak valid.',

            'whatsapp.required' => 'Nomor WhatsApp wajib diisi.',

            'map_link.required' => 'Link peta wajib diisi.',
            'map_link.regex'    => 'Link peta harus diawali dengan "https://www.google.com/maps/embed?".',

            'carousel.*.image' => 'Setiap gambar carousel harus berupa file gambar.',
            'carousel.*.mimes' => 'Format gambar carousel harus jpg, jpeg, atau png.',
            'carousel.*.max'   => 'Ukuran setiap gambar carousel maksimal 2MB.',

            'visual_umkm.image' => 'Visual UMKM harus berupa gambar.',
            'visual_umkm.mimes' => 'Format gambar visual UMKM harus jpg, jpeg, atau png.',
            'visual_umkm.max'   => 'Ukuran gambar visual UMKM maksimal 2MB.',

            'visual_wisata.image' => 'Visual wisata harus berupa gambar.',
            'visual_wisata.mimes' => 'Format gambar visual wisata harus jpg, jpeg, atau png.',
            'visual_wisata.max'   => 'Ukuran gambar visual wisata maksimal 2MB.',
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
