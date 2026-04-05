@extends('layouts.admin')

@section('title', 'Edit Buku - DigiLab')
@section('header_title', 'Edit Data Buku')

@section('content')
<div class="max-w-4xl mx-auto">

    <div class="mb-6">
        <a href="{{ route('books.index') }}"
            class="inline-flex items-center gap-2 text-sm font-semibold text-gray-500 hover:text-[#900b21] transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                </path>
            </svg>
            Kembali ke Daftar Buku
        </a>
    </div>

    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-8">
        <div class="flex items-center gap-4 mb-8 border-b border-gray-100 pb-6">
            <div class="w-12 h-12 rounded-2xl bg-[#fce8eb] text-[#900b21] flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
            </div>
            <div>
                <h2 class="text-xl font-bold text-gray-900">Form Edit Buku</h2>
                <p class="text-sm text-gray-500 mt-1">Ubah informasi buku atau ganti cover buku di bawah ini.
                </p>
            </div>
        </div>

        <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div class="md:col-span-2">
                    <label for="title" class="block text-sm font-bold text-gray-700 mb-2">Judul Buku <span
                            class="text-red-500">*</span></label>
                    <input type="text" id="title" name="title" value="{{ old('title', $book->title) }}"
                        class="bg-[#f4f5f7] border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-[#900b21] focus:border-[#900b21] block w-full p-3.5 font-medium transition-colors @error('title') border-red-500 bg-red-50 @enderror"
                        required>
                    @error('title') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="author" class="block text-sm font-bold text-gray-700 mb-2">Penulis <span
                            class="text-red-500">*</span></label>
                    <input type="text" id="author" name="author" value="{{ old('author', $book->author) }}"
                        class="bg-[#f4f5f7] border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-[#900b21] focus:border-[#900b21] block w-full p-3.5 font-medium transition-colors @error('author') border-red-500 bg-red-50 @enderror"
                        required>
                    @error('author') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="category_id" class="block text-sm font-bold text-gray-700 mb-2">Kategori <span
                            class="text-red-500">*</span></label>
                    <select id="category_id" name="category_id"
                        class="bg-[#f4f5f7] border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-[#900b21] focus:border-[#900b21] block w-full p-3.5 font-medium transition-colors @error('category_id') border-red-500 bg-red-50 @enderror"
                        required>
                        <option value="" disabled>-- Pilih Kategori --</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('category_id') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="published_year" class="block text-sm font-bold text-gray-700 mb-2">Tahun Terbit <span
                            class="text-red-500">*</span></label>
                    <input type="text" id="published_year" name="published_year" value="{{ old('published_year', $book->published_year) }}"
                        maxlength="4" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                        class="bg-[#f4f5f7] border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-[#900b21] focus:border-[#900b21] block w-full p-3.5 font-medium transition-colors @error('published_year') border-red-500 bg-red-50 @enderror"
                        required>
                    @error('published_year') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="stock" class="block text-sm font-bold text-gray-700 mb-2">Jumlah Stok <span
                            class="text-red-500">*</span></label>
                    <input type="number" id="stock" name="stock" value="{{ old('stock', $book->stock) }}" 
                        min="0"
                        class="bg-[#f4f5f7] border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-[#900b21] focus:border-[#900b21] block w-full p-3.5 font-medium transition-colors @error('stock') border-red-500 bg-red-50 @enderror"
                        required>
                    @error('stock') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                </div>

                <div class="md:col-span-2 mt-2">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Cover Buku <span class="text-xs font-normal text-gray-500">(Biarkan kosong jika tidak ingin diganti)</span></label>
                    <div class="flex items-center justify-center w-full">
                        <label for="image" class="relative flex flex-col items-center justify-center w-full h-48 border-2 border-dashed border-gray-300 rounded-2xl cursor-pointer bg-[#f4f5f7] hover:bg-gray-50 hover:border-[#900b21] transition-all overflow-hidden group">
                            
                            <div id="upload-text" class="flex flex-col items-center justify-center pt-5 pb-6 transition-all duration-300 {{ $book->image ? 'hidden' : '' }}">
                                <svg class="w-10 h-10 text-gray-400 mb-3 group-hover:text-[#900b21] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <p class="mb-1 text-sm text-gray-500 font-medium"><span class="font-bold text-[#900b21]">Klik untuk pilih foto baru</span></p>
                                <p class="text-xs text-gray-400">PNG, JPG, JPEG (Maks. 2MB)</p>
                            </div>

                            <img id="image-preview" src="{{ $book->image ? asset('storage/' . $book->image) : '#' }}" alt="Preview Cover" class="absolute inset-0 w-full h-full object-contain p-2 z-10 {{ $book->image ? '' : 'hidden' }}" />

                            <div id="change-text" class="absolute inset-0 bg-gray-900/40 backdrop-blur-sm flex items-center justify-center text-white font-bold text-sm opacity-0 group-hover:opacity-100 transition-opacity z-20 {{ $book->image ? '' : 'hidden' }}">
                                Klik untuk Ganti Foto
                            </div>

                            <input id="image" name="image" type="file" class="hidden" accept="image/png, image/jpeg, image/jpg" onchange="previewImage(event)" />
                        </label>
                    </div>
                    @error('image') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                </div>

            </div>

            <hr class="my-8 border-gray-100">

            <div class="flex justify-end gap-4">
                <a href="{{ route('books.index') }}"
                    class="px-6 py-3 bg-gray-50 hover:bg-gray-100 text-gray-700 font-bold rounded-xl transition-colors text-sm">
                    Batal
                </a>
                <button type="submit"
                    class="px-8 py-3 bg-[#900b21] hover:bg-[#7a091c] text-white font-bold rounded-xl transition-colors shadow-sm text-sm flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('image-preview');
        const uploadText = document.getElementById('upload-text');
        const changeText = document.getElementById('change-text');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                if (uploadText) uploadText.classList.add('hidden');
                if (changeText) changeText.classList.remove('hidden');
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection