<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Wisata;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;

class WisataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wisata = Wisata::latest()->take(3)->get();
        $wisataCard = Wisata::orderBy('nama_wisata', 'asc')->paginate(9);
        return view('pages.wisata', compact(['wisata', 'wisataCard']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.create.wisata-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_wisata' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto_utama' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'list_foto.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'alamat' => 'required|string|max:255',
            'link_map' => 'nullable|url',
            'harga_min' => 'nullable|numeric|min:0',
            'harga_max' => 'nullable|numeric|min:0|gte:harga_min',
            'nomor_telepon' => 'nullable|string|max:20',
        ], [
            'nama_wisata.required'   => 'Nama Wisata wajib diisi.',
            'nama_wisata.string'     => 'Nama Wisata harus berupa teks.',
            'nama_wisata.max'        => 'Nama Wisata maksimal 255 karakter.',
            
            'deskripsi.required'   => 'Deskripsi wajib diisi.',
            'deskripsi.string'     => 'Deskripsi harus berupa teks.',
            
            'foto_utama.image'     => 'Foto utama harus berupa gambar.',
            'foto_utama.mimes'     => 'Foto utama harus berformat jpeg, png, atau jpg.',
            'foto_utama.max'       => 'Ukuran foto utama maksimal 2MB.',

            'list_foto.*.image'    => 'Setiap foto tambahan harus berupa gambar.',
            'list_foto.*.mimes'    => 'Foto tambahan harus berformat jpeg, png, atau jpg.',
            'list_foto.*.max'      => 'Ukuran setiap foto tambahan maksimal 2MB.',

            'alamat.required'      => 'Alamat wajib diisi.',
            'alamat.string'        => 'Alamat harus berupa teks.',
            'alamat.max'           => 'Alamat tidak boleh lebih dari 255 karakter.',

            'link_map.url'         => 'Link Map harus berupa URL yang valid.',
        ]);

        $fotoUtamaPath = null;
        if ($request->hasFile('foto_utama')) {
            $fotoUtamaPath = $request->file('foto_utama')->store('wisata/foto_utama', 'public');
        }

        $listFotoPaths = [];
        if ($request->hasFile('list_foto')) {
            foreach ($request->file('list_foto') as $foto) {
                $listFotoPaths[] = $foto->store('wisata/galeri', 'public');
            }
        }

        $wisata = Wisata::create([
            'nama_wisata' => $request->nama_wisata,
            'slug' => Str::slug($request->nama_wisata) . '-' . Str::random(4),
            'deskripsi' => $request->deskripsi,
            'foto_utama' => $fotoUtamaPath,
            'list_foto' => $listFotoPaths,
            'alamat' => $request->alamat,
            'link_map' => $request->link_map,
            'rentang_harga' => ($request->harga_min && $request->harga_max)
                                ? [$request->harga_min, $request->harga_max]
                                : null,
            'nomor_telepon' => $request->nomor_telepon,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('wisata.admin')->with('success', 'Wisata berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $wisata = Wisata::where('slug', $slug)->firstOrFail();
        return view('pages.content', compact('wisata'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Wisata $wisata)
    {
        return view('admin.pages.update.wisata-edit', compact('wisata'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Wisata $wisata)
    {
        $request->validate([
            'nama_wisata' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto_utama' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'list_foto.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'alamat' => 'required|string|max:255',
            'link_map' => 'nullable|url',
            'harga_min' => 'nullable|numeric|min:0',
            'harga_max' => 'nullable|numeric|min:0|gte:harga_min',
            'nomor_telepon' => 'nullable|string|max:20'
        ], [
            'nama_wisata.required'   => 'Nama Wisata wajib diisi.',
            'nama_wisata.string'     => 'Nama Wisata harus berupa teks.',
            'nama_wisata.max'        => 'Nama Wisata maksimal 255 karakter.',
            
            'deskripsi.required'   => 'Deskripsi wajib diisi.',
            'deskripsi.string'     => 'Deskripsi harus berupa teks.',
            
            'foto_utama.image'     => 'Foto utama harus berupa gambar.',
            'foto_utama.mimes'     => 'Foto utama harus berformat jpeg, png, atau jpg.',
            'foto_utama.max'       => 'Ukuran foto utama maksimal 2MB.',

            'list_foto.*.image'    => 'Setiap foto tambahan harus berupa gambar.',
            'list_foto.*.mimes'    => 'Foto tambahan harus berformat jpeg, png, atau jpg.',
            'list_foto.*.max'      => 'Ukuran setiap foto tambahan maksimal 2MB.',

            'alamat.required'      => 'Alamat wajib diisi.',
            'alamat.string'        => 'Alamat harus berupa teks.',
            'alamat.max'           => 'Alamat tidak boleh lebih dari 255 karakter.',

            'link_map.url'         => 'Link Map harus berupa URL yang valid.',
        ]);

        // Update foto utama jika diubah
        if ($request->hasFile('foto_utama')) {
            if ($wisata->foto_utama && Storage::disk('public')->exists($wisata->foto_utama)) {
                Storage::disk('public')->delete($wisata->foto_utama);
            }
            $wisata->foto_utama = $request->file('foto_utama')->store('wisata/foto_utama', 'public');
        }

        $list_foto = $wisata->list_foto ?? [];

        // Jika user centang "Ganti semua galeri lama"
        if ($request->has('replace_all_galeri')) {
            // Hapus semua galeri lama
            foreach ($list_foto as $lama) {
                if (Storage::disk('public')->exists($lama)) {
                    Storage::disk('public')->delete($lama);
                }
            }
            $list_foto = [];
        }

        // Hapus satu per satu galeri yang dicentang
        if ($request->has('hapus_foto_lama')) {
            foreach ($request->hapus_foto_lama as $hapus) {
                if (($key = array_search($hapus, $list_foto)) !== false) {
                    if (Storage::disk('public')->exists($hapus)) {
                        Storage::disk('public')->delete($hapus);
                    }
                    unset($list_foto[$key]);
                }
            }
            $list_foto = array_values($list_foto); // Reset index
        }

        // Tambah foto galeri baru (jika ada)
        if ($request->hasFile('list_foto')) {
            foreach ($request->file('list_foto') as $foto) {
                $list_foto[] = $foto->store('wisata/galeri', 'public');
            }
        }

        // Update data
        $wisata->update([
            'nama_wisata' => $request->nama_wisata,
            'slug' => Str::slug($request->nama_wisata) . '-' . Str::random(4),
            'deskripsi' => $request->deskripsi,
            'foto_utama' => $wisata->foto_utama,
            'list_foto' => array_values($list_foto),
            'alamat' => $request->alamat,
            'link_map' => $request->link_map,
            'rentang_harga' => ($request->harga_min && $request->harga_max)
                                ? [$request->harga_min, $request->harga_max]
                                : null,
            'nomor_telepon' => $request->nomor_telepon,
        ]);

        return redirect()->route('wisata.admin')->with('success', 'Wisata berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Wisata $wisata)
    {
        // Hapus foto utama jika ada
        if ($wisata->foto_utama && Storage::disk('public')->exists($wisata->foto_utama)) {
            Storage::disk('public')->delete($wisata->foto_utama);
        }

        // Hapus semua list foto galeri
        if ($wisata->list_foto) {
            foreach ($wisata->list_foto as $foto) {
                if (Storage::disk('public')->exists($foto)) {
                    Storage::disk('public')->delete($foto);
                }
            }
        }

        $wisata->delete();

        return redirect()->route('wisata.admin')->with('success', 'Data Wisata berhasil dihapus.');
    }

    /**
     * Display Admin Views.
     */
    public function admindex()
    {
        if (request()->ajax()) {
            $wisata = Wisata::select(['id', 'nama_wisata', 'slug', 'deskripsi', 'foto_utama', 'list_foto', 'created_at']);
            return DataTables::of($wisata)
            ->addIndexColumn()
            ->editColumn('foto_utama', function ($row) {
                $src = $row->foto_utama ? asset('storage/' . $row->foto_utama) : '';
                return $src
                    ? '<img src="' . $src . '" width="75" height="75" style="object-fit: cover;" alt="foto">'
                    : '🖼️';
            })
            ->addColumn('jumlah_foto', function ($row) {
                return is_array($row->list_foto) ? count($row->list_foto) : 0;
            })
            ->editColumn('created_at', function ($row) {
                return Carbon::parse($row->created_at)->timezone('Asia/Jakarta')->format('d M Y H:i');
            })
            ->addColumn('action', function ($row) {
                return '<a href="' . route('wisata.edit', $row->id) . '"class="btn btn-sm btn-secondary btn-40">
                            <i class="fa fa-pen-to-square"></i>
                            Edit
                        </a>
                        <form action="' . route('wisata.destroy', $row->id) . '" method="POST" style="display:inline">'
                        . csrf_field()
                        . method_field('DELETE')
                        . '<button type="submit" onclick="return confirm(\'Hapus data ini?\')" class="btn btn-sm btn-danger btn-40">
                                <i class="fa fa-trash-can"></i>
                                Delete
                            </button></form>
                        <a href="' . route('wisata.show', $row->slug) . '"class="btn btn-sm btn-primary btn-40">
                            <i class="fa fa-eye"></i>
                            Lihat
                        </a>';
            })
            ->rawColumns(['foto_utama', 'action'])
            ->make(true);
        }
        
        return view('admin.pages.wisata-admin');
    }

    /**
     * Search Wisata Ajax.
     */
    public function search(Request $request)
    {
        $search = $request->input('search');

        // Query pencarian Wisata
        $wisataCard = \App\Models\Wisata::where('nama_wisata', 'like', "%{$search}%")
            ->orderBy('nama_wisata')
            ->paginate(9);

        // Cek apakah request AJAX
        if ($request->ajax()) {
            $html = view('partials.wisata-cards', compact('wisataCard'))->render();
            $pagination = view('partials.wisata-pagination', compact('wisataCard'))->render();

            return response()->json([
                'html' => $html,
                'pagination' => $pagination,
            ]);
        }

        // Kalau bukan AJAX, arahkan ke halaman yang sesuai (misal halaman daftar Wisata)
        $wisata = Wisata::latest()->take(3)->get();

        return view('pages.wisata', compact('wisata', 'wisataCard'));
    }
}
