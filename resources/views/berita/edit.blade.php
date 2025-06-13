@extends('layouts.app')

@section('header')
    <div class="bg-gradient-to-r from-blue-500 to-blue-700 py-6 px-4 rounded-md shadow mb-6">
        <h2 class="text-white text-2xl font-semibold">
            Edit Berita
        </h2>
    </div>
@endsection

@section('content')
    <div class="py-6 bg-gray-50">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow">

                {{-- Menampilkan error validasi --}}
                @if ($errors->any())
                    <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                        <ul class="list-disc ml-6">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="judul" class="block text-sm font-medium text-gray-700">Judul</label>
                        <input type="text" name="judul" id="judul" value="{{ old('judul', $berita->judul) }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label for="konten" class="block text-sm font-medium text-gray-700">Konten</label>
                        <textarea name="konten" id="konten" rows="6"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>{{ old('konten', $berita->konten) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="foto" class="block text-sm font-medium text-gray-700">Foto (opsional)</label>
                        <input type="file" name="foto" id="foto"
                            class="mt-1 block w-full text-sm text-gray-500">

                        @if ($berita->foto)
                            <p class="text-sm mt-2">Foto saat ini:</p>
                            <img src="{{ asset('storage/' . $berita->foto) }}" alt="Foto Berita" class="h-32 mt-1 rounded">
                        @endif
                    </div>

                    <div class="flex justify-end">
                        <a href="{{ route('berita.index') }}" class="text-sm text-gray-600 hover:underline mr-4">Batal</a>
                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Perbarui</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
