<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DigiLab | Library</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&family=gelasio:400,500,600,700&display=swap"
        rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Animasi pop-up halus untuk buku saat difilter */
        @keyframes popIn {
            0% {
                opacity: 0;
                transform: scale(0.95) translateY(15px);
            }

            100% {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        .animate-pop {
            animation: popIn 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
    </style>
</head>

<body class="antialiased bg-[#fdfdfd] text-gray-900 font-['Inter']">

    <header
        class="py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center max-w-7xl mx-auto w-full border-b border-gray-100">
        <div class="flex items-center gap-2">
            <a href="{{ url('/') }}">
                <img src="{{ asset('images/logolight.png') }}" alt="Logo DigiLab" class="h-10 w-auto object-contain">
            </a>
        </div>

        @if (Route::has('login'))
        <nav class="flex items-center gap-4">
            @auth
            @if(auth()->user()->role === 'admin')
            <a href="{{ url('/dashboard') }}"
                class="font-semibold text-white bg-[#900b21] hover:bg-[#7a091c] px-6 py-2.5 rounded-full shadow-sm transition duration-300 flex items-center gap-2 text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                    </path>
                </svg>
                Admin Dashboard
            </a>
            @else
           <form action="{{ url('/') }}" method="GET" class="hidden md:block relative w-64 mr-2">
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif

                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search books..."
                    class="bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-full focus:ring-[#900b21] focus:border-[#900b21] block w-full pl-10 pr-10 px-4 py-2 outline-none transition-colors">
                
                @if(request('search'))
                    <a href="{{ url('/' . (request('category') ? '?category='.request('category') : '')) }}" 
                       class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-[#900b21] transition-colors cursor-pointer"
                       title="Clear Search">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </a>
                @else
                    <button type="submit" class="hidden">Search</button>
                @endif
            </form>

            <div class="relative ml-2" x-data="{ open: false }" @click.outside="open = false"
                @close.stop="open = false">
                <button @click="open = ! open"
                    class="flex items-center gap-3 bg-white border border-gray-200 hover:border-[#900b21] hover:shadow-sm pl-1.5 pr-4 py-1.5 rounded-full transition-all duration-300 ease-in-out focus:outline-none">
                    <div
                        class="w-8 h-8 rounded-full bg-[#fce8eb] text-[#900b21] font-bold flex items-center justify-center text-xs uppercase">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <span class="text-sm font-bold text-gray-700">{{ explode(' ', Auth::user()->name)[0] }}</span>
                    <svg class="h-4 w-4 text-gray-400 transition-transform duration-200" :class="{'rotate-180': open}"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>

                <div x-show="open" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                    x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                    x-transition:leave-end="opacity-0 scale-95 translate-y-2"
                    class="absolute right-0 mt-3 w-60 rounded-2xl bg-white border border-gray-100 shadow-[0_10px_40px_rgb(0,0,0,0.08)] py-2 z-50"
                    style="display: none;">

                    <div class="px-5 py-3 border-b border-gray-50 mb-1">
                        <p class="text-[11px] text-gray-400 font-semibold uppercase tracking-wider">Logged In As</p>
                        <p class="text-sm font-bold text-gray-900 truncate mt-0.5">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                    </div>

                    <a href="#"
                        class="flex items-center gap-3 px-5 py-2.5 text-sm font-semibold text-gray-700 hover:bg-red-50 hover:text-[#900b21] transition-colors">
                        <svg class="w-5 h-5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                            </path>
                        </svg>
                        My Borrowed Books
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center gap-3 px-5 py-2.5 text-sm font-bold text-red-600 hover:bg-[#fce8eb] transition-colors mt-1 border-t border-gray-50">
                            <svg class="w-5 h-5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                </path>
                            </svg>
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
            @endif
            @else
            @if (Route::has('register'))
            <a href="{{ route('register') }}"
                class="font-semibold text-[#900b21] border-2 border-[#900b21] bg-transparent hover:bg-red-50 px-6 py-2 rounded-full transition duration-300 text-sm">Register</a>
            @endif
            <a href="{{ route('login') }}"
                class="font-semibold text-white bg-[#900b21] hover:bg-[#7a091c] px-6 py-2 rounded-full shadow-sm transition duration-300 text-sm">Login</a>
            @endauth
        </nav>
        @endif
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col items-center pb-20">

        <div class="w-full relative rounded-2xl overflow-hidden mt-6 flex items-center justify-center">
            <img src="{{ asset('images/banner(1).png') }}" alt="Library Books" class="w-full h-auto object-contain">
            <h1
                class="absolute left-8 sm:left-12 lg:left-20 top-1/2 -translate-y-1/2 z-10 text-white text-3xl sm:text-4xl lg:text-5xl font-['Gelasio'] font-medium text-left leading-snug max-w-4xl drop-shadow-lg">
                Where Every Page is an <br> Experiment, Every Chapter is <br> a Discovery.
            </h1>
        </div>

        <div class="w-full grid grid-cols-1 md:grid-cols-3 gap-8 mt-16 px-4">
            <div class="flex gap-4 items-start">
                <svg class="w-8 h-8 text-[#900b21] flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.5"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25">
                    </path>
                </svg>
                <div>
                    <h3 class="font-bold text-[#900b21] text-lg">Access from anywhere.</h3>
                    <p class="text-sm text-gray-600 mt-1">Whether on desktop or mobile device.</p>
                </div>
            </div>
            <div class="flex gap-4 items-start">
                <svg class="w-8 h-8 text-[#900b21] flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.5"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25">
                    </path>
                </svg>
                <div>
                    <h3 class="font-bold text-[#900b21] text-lg">Easy Book Borrowing.</h3>
                    <p class="text-sm text-gray-600 mt-1">The borrowing process is designed to be simple and efficient.
                    </p>
                </div>
            </div>
            <div class="flex gap-4 items-start">
                <svg class="w-8 h-8 text-[#900b21] flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.5"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"></path>
                </svg>
                <div>
                    <h3 class="font-bold text-[#900b21] text-lg">Fast Book Search</h3>
                    <p class="text-sm text-gray-600 mt-1">A smart search helps users find books quickly in the catalog.
                    </p>
                </div>
            </div>
        </div>

        <div class="w-full mt-20 bg-white border border-gray-200 rounded-xl p-8 shadow-sm">
            <h2 class="text-xl font-semibold mb-8">Book Categories</h2>

            <div class="flex flex-wrap gap-4" id="category-wrapper">
                <button onclick="filterBooks('all', this)"
                    class="cat-btn px-6 py-3 rounded-full bg-[#900b21] border border-[#900b21] text-white font-semibold text-sm transition-all duration-300 shadow-sm flex items-center gap-2 outline-none">
                    <svg class="w-4 h-4 cat-icon opacity-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                        </path>
                    </svg>
                    All Categories
                </button>

                @foreach ($categories as $category)
                <button onclick="filterBooks('{{ $category->id }}', this)"
                    class="cat-btn px-6 py-3 rounded-full bg-red-50 border border-red-100 text-red-700 hover:bg-[#900b21] hover:text-white font-semibold text-sm transition-all duration-300 shadow-sm flex items-center gap-2 outline-none">
                    <svg class="w-4 h-4 cat-icon opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                    </svg>
                    {{ $category->name }}
                </button>
                @endforeach
            </div>
        </div>

        <div id="koleksi" class="w-full mt-24 mb-20 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto scroll-mt-10">
            <h2
                class="text-xl md:text-2xl text-gray-900 mb-8 font-medium tracking-wide flex justify-between items-center">
                <span>Book Collection</span>
            </h2>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4 md:gap-6">
                @foreach($books as $book)
                <a href="{{ route('book.show', $book->id) }}"
                    class="book-card group bg-white rounded-2xl border border-gray-200 hover:shadow-[0_8px_30px_rgb(0,0,0,0.06)] transition-all duration-300 flex flex-col h-full overflow-hidden block"
                    data-category="{{ $book->category_id }}">

                    <div class="relative w-full pt-3 px-3">
                        <div
                            class="w-full aspect-[3/4] bg-[#f4f5f7] rounded-lg overflow-hidden border border-gray-100 relative">
                            @if($book->image)
                            <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                            <div class="w-full h-full flex flex-col items-center justify-center p-4">
                                <svg class="w-10 h-10 text-gray-300 mb-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25">
                                    </path>
                                </svg>
                                <span
                                    class="text-[10px] font-bold text-gray-400 text-center uppercase tracking-wider">No
                                    Cover</span>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="p-4 flex flex-col flex-grow">
                        <p class="text-[11px] text-gray-500 mb-1.5 line-clamp-1 font-semibold uppercase tracking-wide">
                            {{ $book->author }}</p>
                        <h3 class="text-sm font-bold text-gray-900 line-clamp-2 leading-snug"
                            title="{{ $book->title }}">{{ $book->title }}</h3>
                    </div>
                </a>
                @endforeach
            </div>

            <div id="empty-state"
                class="{{ $books->isEmpty() ? 'flex' : 'hidden' }} flex-col items-center justify-center py-16 px-4 bg-gray-50 border border-dashed border-gray-200 rounded-2xl w-full mt-6">
                <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25">
                    </path>
                </svg>
                <h3 class="text-gray-900 font-bold text-lg mb-1">No books found</h3>
                <p class="text-gray-500 text-sm text-center">There are no books available in this category.</p>
            </div>
        </div>

        <div class="w-full mt-24 mb-20 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold font-['Gelasio'] text-gray-900 mb-4">
                    What People Say
                </h2>
                <p class="text-gray-500 max-w-2xl mx-auto">
                    Experiences from students and teachers who have enjoyed the ease of borrowing books at DigiLab.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div
                    class="bg-white p-8 rounded-3xl shadow-[0_4px_20px_rgb(0,0,0,0.03)] border border-gray-100 hover:-translate-y-2 transition-transform duration-300 relative group">
                    <div
                        class="absolute top-6 right-6 text-gray-100 group-hover:text-red-50 transition-colors duration-300">
                        <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.999v10h-9.999z" />
                        </svg>
                    </div>
                    <div class="flex gap-1 text-yellow-400 mb-6 relative z-10">
                        @for ($s = 0; $s < 5; $s++) <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                            </path></svg>@endfor
                    </div>
                    <p class="text-gray-700 leading-relaxed mb-8 relative z-10 line-clamp-4">
                        "The borrowing system is incredibly easy to understand. The UI is super modern, I didn't expect
                        this from a school library app. Finding references for vocational assignments is super fast!"
                    </p>
                    <div class="flex items-center gap-4 relative z-10 border-t border-gray-100 pt-6">
                        <img src="https://ui-avatars.com/api/?name=Deswita+Maharani&background=900b21&color=fff"
                            alt="User Avatar" class="w-12 h-12 rounded-full object-cover">
                        <div>
                            <h4 class="font-bold text-gray-900 text-sm">Deswita Maharani</h4>
                            <p class="text-xs text-gray-500">Grade 12 Software Engineering</p>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white p-8 rounded-3xl shadow-[0_4px_20px_rgb(0,0,0,0.03)] border border-gray-100 hover:-translate-y-2 transition-transform duration-300 relative group">
                    <div
                        class="absolute top-6 right-6 text-gray-100 group-hover:text-red-50 transition-colors duration-300">
                        <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.999v10h-9.999z" />
                        </svg>
                    </div>
                    <div class="flex gap-1 text-yellow-400 mb-6 relative z-10">
                        @for ($s = 0; $s < 5; $s++) <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                            </path></svg>@endfor
                    </div>
                    <p class="text-gray-700 leading-relaxed mb-8 relative z-10 line-clamp-4">
                        "Very helpful! The book catalog is complete and up-to-date. The search feature is accurate, so I
                        don't have to wander around the library shelves looking for the books I need."
                    </p>
                    <div class="flex items-center gap-4 relative z-10 border-t border-gray-100 pt-6">
                        <img src="https://ui-avatars.com/api/?name=Budi+Santoso&background=f3f4f6&color=374151"
                            alt="User Avatar" class="w-12 h-12 rounded-full object-cover">
                        <div>
                            <h4 class="font-bold text-gray-900 text-sm">Budi Santoso</h4>
                            <p class="text-xs text-gray-500">Grade 11 Computer Networking</p>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white p-8 rounded-3xl shadow-[0_4px_20px_rgb(0,0,0,0.03)] border border-gray-100 hover:-translate-y-2 transition-transform duration-300 relative group">
                    <div
                        class="absolute top-6 right-6 text-gray-100 group-hover:text-red-50 transition-colors duration-300">
                        <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.999v10h-9.999z" />
                        </svg>
                    </div>
                    <div class="flex gap-1 text-yellow-400 mb-6 relative z-10">
                        @for ($s = 0; $s < 5; $s++) <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                            </path></svg>@endfor
                    </div>
                    <p class="text-gray-700 leading-relaxed mb-8 relative z-10 line-clamp-4">
                        "As a teacher, I find it very helpful to monitor students who actively read literature. The
                        interface is very user-friendly. Wishing continued success for our beloved school's
                        innovations!"
                    </p>
                    <div class="flex items-center gap-4 relative z-10 border-t border-gray-100 pt-6">
                        <img src="https://ui-avatars.com/api/?name=Siti+Aminah&background=f3f4f6&color=374151"
                            alt="User Avatar" class="w-12 h-12 rounded-full object-cover">
                        <div>
                            <h4 class="font-bold text-gray-900 text-sm">Mrs. Siti Aminah</h4>
                            <p class="text-xs text-gray-500">Indonesian Language Teacher</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        function filterBooks(categoryId, clickedBtn) {
            // 1. Reset semua tombol ke warna pudar
            document.querySelectorAll('.cat-btn').forEach(btn => {
                btn.classList.remove('bg-[#900b21]', 'text-white');
                btn.classList.add('bg-red-50', 'text-red-700');
                btn.querySelector('.cat-icon').classList.replace('opacity-100', 'opacity-70');
            });

            // 2. Aktifkan tombol yang sedang diklik (Warna Merah Pekat)
            clickedBtn.classList.remove('bg-red-50', 'text-red-700');
            clickedBtn.classList.add('bg-[#900b21]', 'text-white');
            clickedBtn.querySelector('.cat-icon').classList.replace('opacity-70', 'opacity-100');

            // 3. Filter Buku dengan Animasi
            const cards = document.querySelectorAll('.book-card');
            let hasVisibleBooks = false;

            cards.forEach(card => {
                // Sembunyikan & reset animasi dulu
                card.style.display = 'none';
                card.classList.remove('animate-pop');

                // Cek apakah buku ini masuk kategori yang dipilih
                if (categoryId === 'all' || card.getAttribute('data-category') === categoryId) {
                    card.style.display = 'block'; // Tampilkan kembali
                    
                    // Trik Javascript untuk memicu ulang animasi CSS (Reflow)
                    void card.offsetWidth; 
                    
                    card.classList.add('animate-pop'); // Tambahkan animasi
                    hasVisibleBooks = true;
                }
            });

            // 4. Tampilkan pesan kosong jika tidak ada buku yang cocok
            const emptyState = document.getElementById('empty-state');
            if (hasVisibleBooks) {
                emptyState.classList.add('hidden');
                emptyState.classList.remove('flex');
            } else {
                emptyState.classList.remove('hidden');
                emptyState.classList.add('flex');
            }
        }
    </script>
</body>

</html>