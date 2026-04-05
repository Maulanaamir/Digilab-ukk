@extends('layouts.admin')

@section('title', 'Transaksi Peminjaman - DigiLab')
@section('header_title', 'Transaksi Peminjaman')

@section('content')

    @if(session('success'))
    <div class="mb-6 bg-[#ebfaef] border border-[#b2e8cf] text-[#00a870] px-4 py-3 rounded-xl flex items-center gap-3 font-medium">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        {{ session('success') }}
    </div>
    @endif
    
    @if(session('error'))
    <div class="mb-6 bg-[#fce8eb] border border-[#fbd5db] text-[#900b21] px-4 py-3 rounded-xl flex items-center gap-3 font-medium">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        {{ session('error') }}
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

        <div class="lg:col-span-2">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-bold text-gray-900">Riwayat Peminjaman Buku</h2>
            </div>

            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="text-gray-600 font-bold bg-gray-50 border-b border-gray-200 uppercase text-xs tracking-wider">
                            <tr>
                                <th class="px-6 py-4">Peminjam</th>
                                <th class="px-6 py-4">Buku & Tanggal</th>
                                <th class="px-6 py-4 text-center">Status</th>
                                <th class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-gray-900 font-medium">
                            @forelse($loans as $loan)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4">
                                    <span class="font-bold text-gray-900 block">{{ $loan->user->name }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="font-bold text-gray-900 block mb-1">{{ $loan->book->title }}</span>
                                    <span class="text-xs text-gray-500">
                                        Pinjam: <span class="font-semibold text-gray-700">{{ \Carbon\Carbon::parse($loan->borrow_date)->format('d M Y') }}</span>
                                        @if($loan->status == 'returned' && $loan->return_date)
                                            <br>Kembali: <span class="font-semibold text-[#00a870]">{{ \Carbon\Carbon::parse($loan->return_date)->format('d M Y') }}</span>
                                        @endif
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($loan->status == 'borrowed')
                                        <span class="bg-[#fff7ed] text-[#ea580c] px-3 py-1 rounded-full text-xs font-bold border border-[#ffedd5]">Dipinjam</span>
                                    @else
                                        <span class="bg-[#ebfaef] text-[#00a870] px-3 py-1 rounded-full text-xs font-bold border border-[#b2e8cf]">Dikembalikan</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 flex justify-center gap-2">
                                    @if($loan->status == 'borrowed')
                                    <form action="{{ route('loans.update', $loan->id) }}" method="POST" onsubmit="return confirm('Selesaikan peminjaman ini? Buku akan dianggap sudah dikembalikan.');">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="p-2 text-[#00a870] hover:bg-[#ebfaef] rounded-lg transition-colors" title="Selesaikan Peminjaman">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        </button>
                                    </form>
                                    @endif
                                    
                                    <button type="button" onclick="openModal('{{ route('loans.destroy', $loan->id) }}', 'peminjaman {{ addslashes($loan->user->name) }}')" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus Data">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                    <p class="font-bold text-gray-900">Belum ada transaksi peminjaman.</p>
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
                <div class="flex items-center gap-3 mb-6 border-b border-gray-100 pb-4">
                    <div class="w-10 h-10 rounded-xl bg-[#fce8eb] text-[#900b21] flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900">Catat Peminjaman</h3>
                        <p class="text-xs text-gray-500">Pilih siswa & buku</p>
                    </div>
                </div>

                <form action="{{ route('loans.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Nama Peminjam (Siswa)</label>
                        <select name="user_id" required class="w-full bg-[#f4f5f7] border-gray-200 rounded-xl p-3 text-sm focus:ring-[#900b21] focus:border-[#900b21]">
                            <option value="" disabled selected>-- Pilih Siswa --</option>
                            @foreach($members as $member)
                                <option value="{{ $member->id }}">{{ $member->name }}</option>
                            @endforeach
                        </select>
                        @error('user_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Buku yang Dipinjam</label>
                        <select name="book_id" required class="w-full bg-[#f4f5f7] border-gray-200 rounded-xl p-3 text-sm focus:ring-[#900b21] focus:border-[#900b21]">
                            <option value="" disabled selected>-- Pilih Buku --</option>
                            @foreach($books as $book)
                                <option value="{{ $book->id }}">{{ $book->title }} (Sisa: {{ $book->stock }})</option>
                            @endforeach
                        </select>
                        @error('book_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <button type="submit" class="w-full bg-[#900b21] hover:bg-[#7a091c] text-white font-bold py-3 rounded-xl transition-colors mt-6 flex justify-center items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                        Simpan Transaksi
                    </button>
                </form>
            </div>
        </div>

    </div>

    <div id="deleteModal" class="fixed inset-0 z-[99] hidden items-center justify-center">
        <div class="fixed inset-0 bg-gray-900/40 backdrop-blur-sm transition-opacity" onclick="closeModal()"></div>
        <div class="bg-white rounded-3xl shadow-2xl max-w-sm w-full mx-4 relative z-10 p-6 border border-gray-100 transform scale-95 opacity-0 transition-all duration-300" id="modalPanel">
            <div class="flex items-center justify-center w-16 h-16 rounded-full bg-[#fce8eb] text-[#900b21] mx-auto mb-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            </div>
            <h3 class="text-xl font-bold text-center text-gray-900 mb-2">Konfirmasi Hapus</h3>
            <p class="text-center text-gray-500 text-sm mb-8 leading-relaxed">
                Apakah Anda yakin ingin menghapus data <strong id="deleteItemName" class="text-[#900b21] text-base"></strong> ?<br>Tindakan ini tidak dapat dibatalkan.
            </p>
            <div class="flex gap-3">
                <button type="button" onclick="closeModal()" class="flex-1 px-4 py-3 bg-gray-50 hover:bg-gray-100 text-gray-700 font-bold rounded-xl transition-colors text-sm">Batal</button>
                <form id="confirmDeleteForm" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full px-4 py-3 bg-[#900b21] hover:bg-[#7a091c] text-white font-bold rounded-xl transition-colors shadow-sm text-sm">Ya, Hapus</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openModal(actionUrl, itemName) {
            const modal = document.getElementById('deleteModal');
            const panel = document.getElementById('modalPanel');
            document.getElementById('deleteItemName').textContent = `"${itemName}"`;
            document.getElementById('confirmDeleteForm').action = actionUrl;
            modal.classList.remove('hidden'); modal.classList.add('flex');
            setTimeout(() => { panel.classList.remove('scale-95', 'opacity-0'); panel.classList.add('scale-100', 'opacity-100'); }, 10);
        }
        function closeModal() {
            const modal = document.getElementById('deleteModal');
            const panel = document.getElementById('modalPanel');
            panel.classList.remove('scale-100', 'opacity-100'); panel.classList.add('scale-95', 'opacity-0');
            setTimeout(() => { modal.classList.add('hidden'); modal.classList.remove('flex'); }, 300);
        }
    </script>
@endsection