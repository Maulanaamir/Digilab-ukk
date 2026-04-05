<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Books - DigiLab</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&family=gelasio:400,500,600,700&display=swap" rel="stylesheet" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-[#fdfdfd] text-gray-900 font-['Inter'] min-h-screen flex flex-col">

    <header class="py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center max-w-7xl mx-auto w-full border-b border-gray-100">
        <div class="flex items-center gap-2">
            <a href="{{ url('/') }}">
                <img src="{{ asset('images/logolight.png') }}" alt="Logo DigiLab" class="h-10 w-auto object-contain">
            </a>
        </div>

        <nav class="flex items-center gap-4">
            <a href="{{ url('/') }}" class="text-sm font-semibold text-gray-500 hover:text-[#900b21] transition-colors flex items-center gap-1 mr-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Browse Books
            </a>
            
            <div class="relative" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
                <button @click="open = ! open" class="flex items-center gap-3 bg-white border border-gray-200 hover:border-[#900b21] hover:shadow-sm pl-1.5 pr-4 py-1.5 rounded-full transition-all duration-300 ease-in-out focus:outline-none">
                    <div class="w-8 h-8 rounded-full bg-[#fce8eb] text-[#900b21] font-bold flex items-center justify-center text-xs uppercase">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <span class="text-sm font-bold text-gray-700">{{ explode(' ', Auth::user()->name)[0] }}</span>
                    <svg class="h-4 w-4 text-gray-400 transition-transform duration-200" :class="{'rotate-180': open}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>

                <div x-show="open" x-transition class="absolute right-0 mt-3 w-60 rounded-2xl bg-white border border-gray-100 shadow-[0_10px_40px_rgb(0,0,0,0.08)] py-2 z-50" style="display: none;">
                    <div class="px-5 py-3 border-b border-gray-50 mb-1">
                        <p class="text-[11px] text-gray-400 font-semibold uppercase tracking-wider">Logged In As</p>
                        <p class="text-sm font-bold text-gray-900 truncate mt-0.5">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                    </div>
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 px-5 py-2.5 text-sm font-bold text-red-600 hover:bg-[#fce8eb] transition-colors mt-1">
                            <svg class="w-5 h-5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </nav>
    </header>

    <main class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 w-full">
        
        @if(session('success'))
            <div class="mb-8 bg-[#ebfaef] border border-[#b2e8cf] text-[#00a870] px-6 py-4 rounded-xl flex items-center gap-3 shadow-sm" role="alert">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="block sm:inline font-semibold">{{ session('success') }}</span>
            </div>
        @endif

        <div class="mb-10 border-b border-gray-100 pb-6 flex items-end justify-between">
            <div>
                <h1 class="text-3xl font-bold font-['Gelasio'] text-gray-900 mb-2">My Borrowed Books</h1>
                <p class="text-gray-500">Track and manage the books you are currently reading.</p>
            </div>
            <div class="hidden sm:block">
                <span class="bg-gray-100 text-gray-600 px-4 py-2 rounded-lg text-sm font-bold">
                    Total: {{ $loans->count() }} Books
                </span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            
            @forelse($loans as $loan)
                <div class="bg-white border border-gray-200 rounded-2xl p-5 flex gap-5 hover:shadow-md transition-shadow duration-300 relative overflow-hidden group">
                    
                    <div class="absolute left-0 top-0 bottom-0 w-1 bg-[#900b21]"></div>

                    <div class="w-24 flex-shrink-0 aspect-[3/4] bg-gray-100 rounded-lg overflow-hidden border border-gray-200">
                        @if($loan->book->image)
                            <img src="{{ asset('storage/' . $loan->book->image) }}" alt="{{ $loan->book->title }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center p-2 bg-[#fce8eb]">
                                <span class="font-bold text-lg text-[#900b21] uppercase tracking-widest">
                                    {{ collect(explode(' ', $loan->book->title))->map(fn($w) => substr($w, 0, 1))->take(2)->join('') }}
                                </span>
                            </div>
                        @endif
                    </div>

                    <div class="flex flex-col justify-center flex-grow">
                        <div class="mb-3">
                            <h3 class="text-base font-bold text-gray-900 line-clamp-2 leading-tight mb-1" title="{{ $loan->book->title }}">
                                {{ $loan->book->title }}
                            </h3>
                            <p class="text-xs text-gray-500 font-medium uppercase tracking-wide">
                                By {{ $loan->book->author }}
                            </p>
                        </div>

                        <div class="mt-auto space-y-2">
                            <div class="flex items-center gap-2 text-sm text-gray-600 bg-gray-50 p-2 rounded-md border border-gray-100">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <span>Borrowed on: <strong class="text-gray-800">{{ \Carbon\Carbon::parse($loan->borrow_date)->format('M d, Y') }}</strong></span>
                            </div>
                            
                            <div class="inline-flex items-center gap-1.5 bg-[#ebfaef] border border-[#b2e8cf] px-2.5 py-1 rounded shadow-sm">
                                <span class="relative flex h-2 w-2">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#00a870] opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-[#00a870]"></span>
                                </span>
                                <span class="text-[10px] font-bold text-[#00a870] uppercase tracking-wider">Active</span>
                            </div>
                        </div>
                    </div>
                </div>

            @empty
                <div class="col-span-full flex flex-col items-center justify-center py-20 px-4 bg-gray-50 border border-dashed border-gray-300 rounded-3xl mt-4">
                    <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center shadow-sm mb-6 text-gray-300">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"></path></svg>
                    </div>
                    <h3 class="text-gray-900 font-bold text-xl mb-2">Your reading list is empty</h3>
                    <p class="text-gray-500 text-sm text-center max-w-sm mb-8">You haven't borrowed any books yet. Explore our collection and find your next great read!</p>
                    <a href="{{ url('/') }}" class="px-8 py-3 bg-[#900b21] hover:bg-[#7a091c] text-white font-bold rounded-full shadow-md transition duration-300 flex items-center gap-2">
                        Browse Books
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
            @endforelse

        </div>
    </main>

</body>
</html>