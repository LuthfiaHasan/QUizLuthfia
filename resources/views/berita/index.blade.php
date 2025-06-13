@extends('layouts.app')

@section('header')
    <div class="bg-gradient-to-r from-blue-500 to-blue-700 py-6 px-4 rounded-md shadow">
        <h2 class="text-white text-2xl font-semibold">
            {{ __('Daftar Berita') }}
        </h2>
    </div>
@endsection

@section('content')
<div class="py-10">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @auth
            @if(auth()->user()->role === 'admin')
            {{-- Tombol Tambah Berita (hanya admin) --}}
            <div class="mb-6">
                <a href="{{ route('berita.create') }}"
                class="inline-block bg-blue-600 text-white font-semibold px-5 py-2 rounded hover:bg-blue-700 transition duration-200 shadow">
                    + Tambah Berita
                </a>
            </div>
            @endif
        @endauth

        {{-- Daftar Berita --}}
        <div class="grid gap-6">
            @forelse ($beritas as $berita)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-blue-800">{{ $berita->judul }}</h3>
                        <p class="text-sm text-gray-500 mb-3">Oleh: {{ $berita->user->name }}</p>

                        @if ($berita->foto)
                            <img src="{{ asset('storage/' . $berita->foto) }}" alt="{{ $berita->judul }}"
                                 class="w-full max-w-lg rounded-md mb-4 border mx-auto">
                        @endif

                        <p class="text-gray-700">{{ $berita->konten }}</p>

                        @auth
                            @if(auth()->user()->role === 'admin')
                                {{-- Tombol Edit & Hapus hanya untuk admin --}}
                                <a href="{{ route('berita.edit', $berita->id) }}"
                                    class="inline-flex items-center mt-4 text-blue-600 hover:text-blue-800 transition text-sm font-medium">
                                    ✏️ Edit Berita
                                </a>
                                <form action="{{ route('berita.destroy', $berita->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus berita ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">Hapus</button>
                                </form>
                            @endif
                        @endauth
                    </div>
                </div>
            @empty
                <div class="text-gray-500">
                    Belum ada berita yang tersedia.
                </div>
            @endforelse
        </div>

    </div>
</div>
@endsection
