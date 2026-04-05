@extends('layouts.admin')

@section('title', 'Master Data Anggota - DigiLab')
@section('header_title', 'Master Data Anggota')

@section('content')

    @if(session('success'))
    <div class="mb-6 bg-[#ebfaef] border border-[#b2e8cf] text-[#00a870] px-4 py-3 rounded-xl flex items-center gap-3 font-medium">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        {{ session('success') }}
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

        <div class="lg:col-span-2">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-bold text-gray-900">Daftar Anggota Perpustakaan</h2>
            </div>

            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="text-gray-600 font-bold bg-gray-50 border-b border-gray-200 uppercase text-xs tracking-wider">
                            <tr>
                                <th class="px-6 py-4">Nama Lengkap</th>
                                <th class="px-6 py-4">Email / Kontak</th>
                                <th class="px-6 py-4 text-center w-32">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-gray-900 font-medium">
                            @forelse($members as $member)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-[#f4f5f7] border border-gray-200 flex items-center justify-center text-gray-600 font-bold uppercase">
                                            {{ substr($member->name, 0, 1) }}
                                        </div>
                                        <span class="font-bold text-gray-900">{{ $member->name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-500">{{ $member->email }}</td>
                                <td class="px-6 py-4 flex justify-center gap-2">
                                    <a href="{{ route('members.edit', $member->id) }}" class="p-2 text-[#900b21] hover:bg-[#fce8eb] rounded-lg transition-colors" title="Edit Anggota">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </a>
                                    <button type="button" onclick="openModal('{{ route('members.destroy', $member->id) }}', '{{ addslashes($member->name) }}')" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus Anggota">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="px-6 py-12 text-center text-gray-500">
                                    <p class="font-bold text-gray-900">Belum ada anggota terdaftar</p>
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
                            @if($memberToEdit)
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            @else
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                            </svg>
                            @endif
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900">{{ $memberToEdit ? 'Edit Anggota' : 'Tambah Anggota' }}</h3>
                        </div>
                    </div>

                    @if($memberToEdit)
                    <a href="{{ route('members.index') }}" class="text-xs font-semibold text-gray-500 hover:text-[#900b21] px-3 py-1.5 rounded-lg bg-gray-50 hover:bg-[#fce8eb] transition-colors">Batal</a>
                    @endif
                </div>

                <form action="{{ $memberToEdit ? route('members.update', $memberToEdit->id) : route('members.store') }}" method="POST" class="space-y-4">
                    @csrf
                    @if($memberToEdit) @method('PUT') @endif

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $memberToEdit ? $memberToEdit->name : '') }}" required
                            class="w-full bg-[#f4f5f7] border-gray-200 rounded-xl p-3 text-sm focus:ring-[#900b21] focus:border-[#900b21]">
                        @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email', $memberToEdit ? $memberToEdit->email : '') }}" required
                            class="w-full bg-[#f4f5f7] border-gray-200 rounded-xl p-3 text-sm focus:ring-[#900b21] focus:border-[#900b21]">
                        @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Password @if($memberToEdit) <span class="text-xs font-normal text-gray-400">(Kosongkan jika tidak diganti)</span> @endif</label>
                        <input type="password" name="password" {{ $memberToEdit ? '' : 'required' }}
                            class="w-full bg-[#f4f5f7] border-gray-200 rounded-xl p-3 text-sm focus:ring-[#900b21] focus:border-[#900b21]">
                        @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <button type="submit" class="w-full bg-[#900b21] hover:bg-[#7a091c] text-white font-bold py-3 rounded-xl transition-colors mt-4 flex justify-center items-center gap-2">
                        @if($memberToEdit)
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Simpan Perubahan
                        @else
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                            Daftarkan Anggota
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
                Apakah Anda yakin ingin menghapus anggota <br>
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