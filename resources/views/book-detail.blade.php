<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $book->title }} - DigiLab</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased bg-[#fdfdfd] text-gray-900 font-sans min-h-screen flex flex-col">

    <header class="py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center max-w-7xl mx-auto w-full border-b border-gray-100">
        <div class="flex items-center gap-2">
            <a href="{{ url('/') }}">
                <img src="{{ asset('images/logolight.png') }}" alt="Logo DigiLab" class="h-10 w-auto object-contain">
            </a>
        </div>
        <div>
            <a href="{{ url('/') }}" class="text-sm font-semibold text-gray-500 hover:text-[#900b21] transition-colors flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Collection
            </a>
        </div>
    </header>

    <main class="flex-grow max-w-5xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white rounded-3xl border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8 p-8 md:p-12">

                <div class="md:col-span-4 flex flex-col items-center">
                    <div class="w-full max-w-[260px] aspect-[3/4] bg-[#f4f5f7] rounded-xl overflow-hidden border border-gray-200 shadow-md relative">
                        @if($book->image)
                        <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}" class="w-full h-full object-cover">
                        @else
                        <div class="w-full h-full flex flex-col items-center justify-center p-4">
                            <svg class="w-16 h-16 text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"></path>
                            </svg>
                            <span class="text-xs font-bold text-gray-400 text-center uppercase tracking-wider">No Cover</span>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="md:col-span-8 flex flex-col justify-center">

                    <div class="flex items-center gap-3 mb-4">
                        <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider">
                            {{ $book->category->name ?? 'General' }}
                        </span>

                        @if($book->stock > 0)
                        <div class="inline-flex items-center gap-1.5 bg-gray-50 border border-gray-200 px-3 py-1 rounded-full shadow-sm">
                            <svg class="w-3.5 h-3.5 text-[#00a870]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-[11px] font-bold text-gray-700 uppercase">Available</span>
                        </div>
                        @else
                        <div class="inline-flex items-center gap-1.5 bg-red-50 border border-red-100 px-3 py-1 rounded-full shadow-sm">
                            <span class="text-[11px] font-bold text-red-600 uppercase">Out of Stock</span>
                        </div>
                        @endif
                    </div>

                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 leading-tight mb-2">
                        {{ $book->title }}
                    </h1>
                    <p class="text-lg text-gray-500 font-medium mb-6">By <span class="text-[#900b21]">{{ $book->author }}</span></p>

                    <div class="prose prose-sm text-gray-600 mb-8">
                        <h3 class="text-gray-900 font-bold mb-2 text-base">Synopsis</h3>
                        <p class="leading-relaxed">
                            Discover the fascinating world within this book. Written by the renowned author {{ $book->author }}, this masterpiece offers profound insights and captivating narratives. Whether you are reading for academic purposes or leisure, this book is highly recommended for your collection.
                        </p>
                    </div>

                    <div class="pt-6 border-t border-gray-100 flex flex-col sm:flex-row items-center gap-4 relative">

                        @php
                            $alreadyBorrowed = false;
                            if(Auth::check()) {
                                $alreadyBorrowed = \App\Models\Loan::where('user_id', Auth::id())
                                                    ->where('book_id', $book->id)
                                                    ->where('status', 'borrowed')
                                                    ->exists();
                            }
                        @endphp

                        @if(session('error'))
                        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 -translate-y-10"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-300"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 -translate-y-10"
                            class="fixed top-8 left-1/2 -translate-x-1/2 z-[100] flex items-center gap-3 bg-white/90 backdrop-blur-md border border-gray-100 shadow-[0_8px_30px_rgb(220,38,38,0.12)] px-4 py-3 rounded-full pointer-events-auto">

                            <div class="w-8 h-8 rounded-full bg-red-50 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <span class="text-sm font-bold text-gray-800 pr-2 whitespace-nowrap">{{ session('error') }}</span>
                            <button @click="show = false" class="text-gray-400 hover:text-gray-600 transition-colors focus:outline-none border-l border-gray-200 pl-3">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                        @endif

                        @if($alreadyBorrowed)
                            <button disabled class="w-full sm:w-auto px-8 py-3.5 bg-gray-100 text-gray-500 font-bold rounded-xl cursor-not-allowed flex items-center justify-center gap-2 border border-gray-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Already Borrowed
                            </button>

                        @elseif($book->stock > 0)
                            <form action="{{ route('book.borrow', $book->id) }}" method="POST" class="w-full sm:w-auto" x-data="{ showModal: false }">
                                @csrf

                                <button type="button" @click="showModal = true" class="w-full sm:w-auto px-8 py-3.5 bg-[#900b21] hover:bg-[#7a091c] text-white font-bold rounded-xl shadow-sm transition duration-300 flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    Borrow This Book
                                </button>

                                <div x-show="showModal" style="display: none;" class="fixed inset-0 z-[110] flex items-center justify-center overflow-y-auto overflow-x-hidden bg-gray-900/60 backdrop-blur-sm p-4">
                                    <div x-show="showModal" @click.outside="showModal = false"
                                        x-transition:enter="transition ease-out duration-300"
                                        x-transition:enter-start="opacity-0 scale-95"
                                        x-transition:enter-end="opacity-100 scale-100"
                                        x-transition:leave="transition ease-in duration-200"
                                        x-transition:leave-start="opacity-100 scale-100"
                                        x-transition:leave-end="opacity-0 scale-95"
                                        class="relative bg-white rounded-3xl shadow-2xl w-full max-w-sm p-7 text-center border border-gray-100">

                                        <div class="w-16 h-16 bg-red-50 rounded-full flex items-center justify-center mx-auto mb-5 text-[#900b21]">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"></path>
                                            </svg>
                                        </div>

                                        <h3 class="text-xl font-bold text-gray-900 mb-2 font-['Gelasio']">Confirm Borrowing</h3>
                                        <p class="text-sm text-gray-500 mb-8 leading-relaxed">
                                            Are you sure you want to borrow <br><strong class="text-gray-800">"{{ $book->title }}"</strong>?
                                        </p>

                                        <div class="flex items-center justify-center gap-3">
                                            <button type="button" @click="showModal = false" class="px-5 py-3 bg-gray-100 text-gray-600 font-bold rounded-xl hover:bg-gray-200 transition-colors w-full text-sm">
                                                Cancel
                                            </button>
                                            <button type="submit" class="px-5 py-3 bg-[#900b21] text-white font-bold rounded-xl hover:bg-[#7a091c] transition-colors w-full shadow-md text-sm">
                                                Yes, Borrow
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        @else
                            <button disabled class="w-full sm:w-auto px-8 py-3.5 bg-gray-100 text-gray-400 font-bold rounded-xl cursor-not-allowed flex items-center justify-center gap-2 border border-gray-200">
                                Currently Unavailable
                            </button>
                        @endif

                    </div>

                </div>
            </div>
        </div>
    </main>

</body>

</html>