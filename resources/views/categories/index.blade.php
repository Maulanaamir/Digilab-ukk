@extends('layouts.admin')

@section('title', 'Master Data Kategori - DigiLab')
@section('header_title', 'Master Data Kategori')

@section('content')

@if(session('success'))
<div
    class="mb-6 bg-[#ebfaef] border border-[#b2e8cf] text-[#00a870] px-4 py-3 rounded-xl flex items-center gap-3 font-medium">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
    </svg>
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div
    class="mb-6 bg-[#fce8eb] border border-[#fbd5db] text-[#900b21] px-4 py-3 rounded-xl flex items-center gap-3 font-medium">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
    </svg>
    {{ session('error') }}
</div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

    <div class="lg:col-span-2">

        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-bold text-gray-900">Daftar Kategori Buku</h2>

            <form action="{{ route('categories.index') }}" method="GET" class="relative w-64">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari kategori... (Tekan Enter)"
                    class="bg-[#f4f5f7] border-none text-gray-600 text-sm rounded-xl focus:ring-0 block w-full pl-10 p-2 font-medium">
            </form>
        </div>

        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead
                        class="text-gray-600 font-bold bg-gray-50 border-b border-gray-200 uppercase text-xs tracking-wider">
                        <tr>
                            <th class="px-6 py-4 w-16">No</th>
                            <th class="px-6 py-4">Nama Kategori</th>
                            <th class="px-6 py-4 text-center w-32">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-gray-900 font-medium">

                        @forelse($categories as $index => $category)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4 text-gray-500">{{ $index + 1 }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 rounded-full bg-[#fce8eb] text-[#900b21] flex items-center justify-center">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                            </path>
                                        </svg>
                                    </div>
                                    <span class="font-bold text-gray-900">{{ $category->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 flex justify-center gap-2">
                                <a href="{{ route('categories.edit', $category->id) }}"
                                    class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors"
                                    title="Edit Kategori">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                </a>
                                <button type="button"
                                    onclick="openModal('{{ route('categories.destroy', $category->id) }}', '{{ $category->name }}')"
                                    class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                                    title="Hapus Kategori">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-12 text-center text-gray-500">
                                <p class="font-bold text-gray-900">Belum ada kategori buku</p>
                                <p class="text-sm mt-1">Silakan tambahkan kategori baru di form sebelah kanan.</p>
                            </td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="lg:col-span-1">
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 sticky top-6">

            <div class="flex items-center justify-between mb-6 border-b border-gray-100 pb-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-[#fce8eb] text-[#900b21] flex items-center justify-center">
                        @if($categoryToEdit)
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                        @else
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                            </path>
                        </svg>
                        @endif
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900">{{ $categoryToEdit ? 'Edit Kategori' : 'Tambah Kategori' }}
                        </h3>
                        <p class="text-xs text-gray-500">{{ $categoryToEdit ? 'Ubah label kategori' : 'Buat label
                            kategori baru' }}</p>
                    </div>
                </div>

                @if($categoryToEdit)
                <a href="{{ route('categories.index') }}"
                    class="text-xs font-semibold text-gray-500 hover:text-[#900b21] px-3 py-1.5 rounded-lg bg-gray-50 hover:bg-[#fce8eb] transition-colors">
                    Batal
                </a>
                @endif
            </div>

            <form
                action="{{ $categoryToEdit ? route('categories.update', $categoryToEdit->id) : route('categories.store') }}"
                method="POST" class="space-y-5">
                @csrf

                @if($categoryToEdit)
                @method('PUT')
                @endif

                <div>
                    <label for="name" class="block text-sm font-bold text-gray-700 mb-2">Nama Kategori</label>
                    <input type="text" id="name" name="name" placeholder="Misal: Fiksi, Sejarah, Sains..."
                        class="bg-[#f4f5f7] border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-[#900b21] focus:border-[#900b21] block w-full p-3 font-medium transition-colors @error('name') border-red-500 bg-red-50 @enderror"
                        value="{{ old('name', $categoryToEdit ? $categoryToEdit->name : '') }}" required>

                    @error('name')
                    <p class="mt-1.5 text-xs text-red-600 font-medium flex items-center gap-1">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full bg-[#900b21] hover:bg-[#7a091c] text-white font-bold rounded-xl px-5 py-3 text-sm transition-colors shadow-sm flex items-center justify-center gap-2">
                    @if($categoryToEdit)
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                        </path>
                    </svg>
                    Simpan Perubahan
                    @else
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4">
                        </path>
                    </svg>
                    Simpan Kategori
                    @endif
                </button>
            </form>

        </div>
    </div>

</div>

<div id="deleteModal" class="fixed inset-0 z-[99] hidden items-center justify-center">
    <div class="fixed inset-0 bg-gray-900/40 backdrop-blur-sm transition-opacity" onclick="closeModal()"></div>

    <div class="bg-white rounded-3xl shadow-2xl max-w-sm w-full mx-4 relative z-10 p-6 border border-gray-100 transform scale-95 opacity-0 transition-all duration-300"
        id="modalPanel">

        <div class="flex items-center justify-center w-16 h-16 rounded-full bg-[#fce8eb] text-[#900b21] mx-auto mb-4">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                </path>
            </svg>
        </div>

        <h3 class="text-xl font-bold text-center text-gray-900 mb-2">Konfirmasi Hapus</h3>

        <p class="text-center text-gray-500 text-sm mb-8 leading-relaxed">
            Apakah Anda yakin ingin menghapus kategori <br>
            <strong id="deleteItemName" class="text-[#900b21] text-base"></strong> ?<br>
            Tindakan ini tidak dapat dibatalkan.
        </p>

        <div class="flex gap-3">
            <button type="button" onclick="closeModal()"
                class="flex-1 px-4 py-3 bg-gray-50 hover:bg-gray-100 text-gray-700 font-bold rounded-xl transition-colors text-sm">
                Batal
            </button>

            <form id="confirmDeleteForm" method="POST" class="flex-1">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="w-full px-4 py-3 bg-[#900b21] hover:bg-[#7a091c] text-white font-bold rounded-xl transition-colors shadow-sm text-sm">
                    Ya, Hapus
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function openModal(actionUrl, itemName) {
            const modal = document.getElementById('deleteModal');
            const panel = document.getElementById('modalPanel');
            const nameLabel = document.getElementById('deleteItemName');
            const form = document.getElementById('confirmDeleteForm');

            nameLabel.textContent = `"${itemName}"`;
            form.action = actionUrl;

            modal.classList.remove('hidden');
            modal.classList.add('flex');
            
            setTimeout(() => {
                panel.classList.remove('scale-95', 'opacity-0');
                panel.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeModal() {
            const modal = document.getElementById('deleteModal');
            const panel = document.getElementById('modalPanel');

            panel.classList.remove('scale-100', 'opacity-100');
            panel.classList.add('scale-95', 'opacity-0');

            setTimeout(() => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }, 300);
        }
</script>

@endsection