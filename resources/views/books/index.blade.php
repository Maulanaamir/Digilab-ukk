@extends('layouts.admin')

@section('title', 'Master Data Buku - DigiLab')
@section('header_title', 'Master Data Buku')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <div class="relative w-72">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <input type="text" placeholder="Cari judul buku..." class="bg-[#f4f5f7] border-none text-gray-600 text-sm rounded-xl focus:ring-0 block w-full pl-10 p-2.5 font-medium">
        </div>

        <a href="{{ route('books.create') }}" class="px-5 py-2.5 bg-[#900b21] hover:bg-[#7a091c] text-white text-sm font-bold rounded-xl transition-colors shadow-sm flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Buku
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-gray-600 font-bold bg-gray-50 border-b border-gray-200 uppercase text-xs tracking-wider">
                    <tr>
                        <th class="px-6 py-4">No</th>
                        <th class="px-6 py-4">Judul Buku</th>
                        <th class="px-6 py-4">Penulis</th>
                        <th class="px-6 py-4 text-center">Tahun</th>
                        <th class="px-6 py-4 text-center">Stok</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-gray-900 font-medium">
                    
                    @forelse($book as $index => $book)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4 text-gray-500">{{ $index + 1 }}</td>
                        <td class="px-6 py-4">
                            <p class="font-bold text-gray-900">{{ $book->title }}</p>
                        </td>
                        <td class="px-6 py-4 text-gray-600">{{ $book->author }}</td>
                        <td class="px-6 py-4 text-center">{{ $book->published_year }}</td>
                        <td class="px-6 py-4 text-center">
                            <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs font-bold">{{ $book->stock }} pcs</span>
                        </td>
                        <td class="px-6 py-4 flex justify-center gap-2">
                            <a href="{{ route('books.edit', $book->id) }}" class="p-2 text-[#900b21] hover:bg-[#fce8eb] rounded-lg transition-colors" title="Edit Data">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                            <button type="button" onclick="openModal('{{ route('books.destroy', $book->id) }}', '{{ addslashes($book->title) }}')" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus Data">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">Belum ada data buku</td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
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
                Apakah Anda yakin ingin menghapus buku <br>
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