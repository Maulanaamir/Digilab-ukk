<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Katalog Buku') }}
            </h2>
            
            @if(auth()->user()->role === 'admin')
            <a href="{{ route('books.create') }}" class="bg-[#900b21] hover:bg-[#7a091c] text-white px-5 py-2.5 rounded-xl text-sm font-bold transition duration-300 shadow-sm flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Buku
            </a>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl relative flex items-center gap-3">
                    <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    <span class="block sm:inline font-medium">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.04)] sm:rounded-[1.5rem] border border-gray-100">
                <div class="p-6 text-gray-900 overflow-x-auto">
                    
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-400 uppercase bg-gray-50/50 border-b border-gray-100">
                            <tr>
                                <th class="px-6 py-4 font-semibold">No</th>
                                <th class="px-6 py-4 font-semibold">Judul Buku</th>
                                <th class="px-6 py-4 font-semibold">Penulis</th>
                                <th class="px-6 py-4 font-semibold">Kategori</th>
                                <th class="px-6 py-4 font-semibold text-center">Stok</th>
                                <th class="px-6 py-4 font-semibold text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($books as $index => $book)
                                <tr class="bg-white hover:bg-gray-50/50 transition-colors">
                                    <td class="px-6 py-4">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 font-bold text-gray-900">{{ $book->title }}</td>
                                    <td class="px-6 py-4">{{ $book->author }}</td>
                                    <td class="px-6 py-4">
                                        <span class="bg-red-50 text-[#900b21] text-xs font-bold px-3 py-1 rounded-full border border-red-100">
                                            {{ $book->category ? $book->category->name : 'Tanpa Kategori' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="font-medium {{ $book->stock > 0 ? 'text-green-600' : 'text-red-500' }}">
                                            {{ $book->stock }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 flex justify-center gap-3">
                                        
                                        @if(auth()->user()->role === 'admin')
                                            <a href="{{ route('books.edit', $book->id) }}" class="text-blue-500 hover:text-blue-700 font-medium transition-colors">Edit</a>
                                            <form action="{{ route('books.destroy', $book->id) }}" method="POST" onsubmit="return confirm('Apakah kamu yakin ingin menghapus buku ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700 font-medium transition-colors">Hapus</button>
                                            </form>
                                        @else
                                            <a href="#" class="bg-[#900b21] hover:bg-[#7a091c] text-white px-4 py-1.5 rounded-lg text-xs font-bold transition-colors shadow-sm">Pinjam</a>
                                        @endif

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"></path></svg>
                                        <p class="text-gray-500 font-medium">Belum ada data buku.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>