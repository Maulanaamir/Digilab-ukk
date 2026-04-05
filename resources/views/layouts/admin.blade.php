<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'DigiLab Admin')</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#fdfdfd] font-['Inter'] antialiased text-gray-900 flex h-screen overflow-hidden">

    <aside class="w-64 bg-white border-r border-gray-100 flex flex-col justify-between h-full flex-shrink-0">
        <div>
            <div class="h-24 flex items-center px-8">
                <img src="{{ asset('images/logolight.png') }}" alt="Logo DigiLab" class="h-10 w-auto object-contain">
            </div>

            <nav class="p-4 space-y-2 mt-2">
                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors {{ request()->routeIs('dashboard') ? 'bg-[#fce8eb] text-[#900b21] font-semibold' : 'text-[#900b21] hover:bg-[#fce8eb] font-medium' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                        </path>
                    </svg>
                    Dashboard
                </a>

                <a href="{{ route('books.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors {{ request()->routeIs('books.*') ? 'bg-[#fce8eb] text-[#900b21] font-semibold' : 'text-[#900b21] hover:bg-[#fce8eb] font-medium' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25">
                        </path>
                    </svg>
                    Books
                </a>
                <a href="{{ route('categories.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors {{ request()->routeIs('categories.*') ? 'bg-[#fce8eb] text-[#900b21] font-semibold' : 'text-[#900b21] hover:bg-[#fce8eb] font-medium' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                        </path>
                    </svg>
                    Categories
                </a>

                <a href="{{ route('members.index') }}"
                    class="flex items-center gap-3 px-4 py-3 text-[#900b21] hover:bg-[#fce8eb] rounded-xl font-medium transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                        </path>
                    </svg>
                    Members
                </a>
                <a href="{{ route('loans.index') }}"
                    class="flex items-center gap-3 px-4 py-3 text-[#900b21] hover:bg-[#fce8eb] rounded-xl font-medium transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                    </svg>
                    Transactions
                </a>

                <div class="px-4 py-4">
                    <hr class="border-gray-100">
                </div>
            </nav>
        </div>
    </aside>

    <main class="flex-1 flex flex-col h-full overflow-hidden bg-transparent">

        <header class="h-24 flex items-center justify-between px-10 flex-shrink-0">

            <h1 class="text-2xl font-bold text-gray-900 tracking-wide">@yield('header_title')</h1>

            <div class="flex items-center gap-8">
                <div class="text-right flex flex-col items-end">
                    <p class="text-sm font-bold text-gray-900">{{ Auth::user()->name ?? 'Admin' }}</p>
                    <span
                        class="inline-block bg-[#fce8eb] text-[#900b21] text-[10px] font-bold px-3 py-1 rounded-full mt-1">Administrator</span>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="flex items-center gap-2 text-[#900b21] hover:text-[#7a091c] font-bold text-sm transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                            </path>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto px-10 py-2">
            @yield('content')
        </div>

    </main>
</body>

</html>