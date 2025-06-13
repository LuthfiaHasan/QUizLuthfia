<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::with('user')->latest()->get();
        return view('berita.index', compact('beritas'));
    }


    public function create()
    {
        $this->authorizeAdmin();
        return view('berita.create');
    }

    public function store(Request $request)
    {
        $this->authorizeAdmin();

        $request->validate([
            'judul' => 'required|min:10',
            'konten' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = $request->file('foto')->store('berita', 'public');

        Berita::create([
            'judul' => $request->judul,
            'konten' => $request->konten,
            'foto' => $path,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('berita.index')->with('success', 'Berita ditambahkan.');
    }

    public function edit(Berita $berita)
    {
        $this->authorizeAdmin();
        return view('berita.edit', compact('berita'));
    }

    public function update(Request $request, Berita $berita)
    {
        $this->authorizeAdmin();

        $request->validate([
            'judul' => 'required|min:10',
            'konten' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            Storage::disk('public')->delete($berita->foto);
            $berita->foto = $request->file('foto')->store('berita', 'public');
        }

        $berita->update([
            'judul' => $request->judul,
            'konten' => $request->konten,
            'foto' => $berita->foto,
        ]);

        return redirect()->route('berita.index')->with('success', 'Berita diupdate.');
    }

    public function destroy(Berita $berita)
    {
        $this->authorizeAdmin();
        Storage::disk('public')->delete($berita->foto);
        $berita->delete();
        return redirect()->route('berita.index')->with('success', 'Berita dihapus.');
    }

    private function authorizeAdmin()
    {
        if (!Auth::user() || Auth::user()->role !== 'admin') {
            abort(403, 'Akses hanya untuk admin.');
        }
    }

}

