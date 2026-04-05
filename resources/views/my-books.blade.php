<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Borrowed Books - DigiLab</title>
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
        <div>
            <a href="{{ url('/') }}" class="text-sm font-semibold text-gray-500 hover:text-[#900b21] transition-colors flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Library
            </a>
        </div>
    </header>

    <main class="flex-grow max-w-5xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-12">
        
        <div class="mb-10">
            <h1 class="text-3xl font-bold text-gray-900 font-['Gelasio'] mb-2">My Bookshelf</h1>
            <p class="text-gray-500">Manage your borrowed books and reading history here.</p>
        </div>

        @if(session('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" class="mb-8 flex items-center gap-3 bg-[#f0fdf4] border border-[#bbf7d0] px-4 py-3 rounded-xl shadow-sm">
            <div class="w-8 h-8 rounded-full bg-[#dcfce7] flex items-center justify-center flex-shrink-0 text-[#16a34a]">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
            </div>
            <span class="text-sm font-bold text-[#166534]">{{ session('success') }}</span>
        </div>
        @endif

        <div class="bg-white rounded-3xl border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] overflow-hidden">
            <div class="p-8">
                @if($loans->isEmpty())
                    <div class="text-center py-16">
                        <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-300">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">No Books Borrowed Yet</h3>
                        <p class="text-gray-500 mb-6">Looks like you haven't borrowed any books from DigiLab.</p>
                        <a href="{{ url('/') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-[#900b21] text-white font-bold rounded-xl hover:bg-[#7a091c] transition-colors">
                            Explore Library
                        </a>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($loans as $loan)
                        <div class="flex gap-5 p-5 border border-gray-100 rounded-2xl {{ $loan->status == 'borrowed' ? 'bg-white shadow-sm' : 'bg-gray-50 opacity-80' }}">
                            
                            <div class="w-24 aspect-[3/4] bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                                @if($loan->book && $loan->book->image)
                                    <img src="{{ asset('storage/' . $loan->book->image) }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-300">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"></path></svg>
                                    </div>
                                @endif
                            </div>

                            <div class="flex flex-col justify-center flex-grow">
                                
                                @if($loan->status == 'borrowed')
                                    <span class="inline-block bg-orange-50 text-orange-600 text-[10px] font-bold px-2.5 py-1 rounded-md w-max mb-2 uppercase tracking-wide">Currently Reading</span>
                                @else
                                    <span class="inline-block bg-green-50 text-green-600 text-[10px] font-bold px-2.5 py-1 rounded-md w-max mb-2 uppercase tracking-wide">Returned on {{ \Carbon\Carbon::parse($loan->updated_at)->format('d M Y') }}</span>
                                @endif

                                <h3 class="font-bold text-gray-900 text-lg leading-tight line-clamp-1">{{ $loan->book->title ?? 'Book Removed' }}</h3>
                                <p class="text-sm text-gray-500 mb-4">Borrowed: {{ \Carbon\Carbon::parse($loan->created_at)->format('d M Y') }}</p>

                                @if($loan->status == 'borrowed')
                                    <form action="{{ route('book.return', $loan->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to return this book?');">
                                        @csrf
                                        <button type="submit" class="w-full px-4 py-2 bg-[#900b21] hover:bg-[#7a091c] text-white text-sm font-bold rounded-lg transition-colors flex items-center justify-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path></svg>
                                            Return Book
                                        </button>
                                    </form>
                                @else
                                    <button disabled class="w-full px-4 py-2 bg-gray-100 text-gray-400 text-sm font-bold rounded-lg cursor-not-allowed">
                                        Completed
                                    </button>
                                @endif
                            </div>

                        </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </main>

</body>
</html>