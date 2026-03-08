<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DigiLab | UKK</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased bg-[#fdfdfd] text-gray-900 font-sans">

    <header class="py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center max-w-7xl mx-auto w-full">
        <div class="flex items-center gap-2">
            <img src="{{ asset('images/logolight.png') }}" alt="Logo DigiLab" class="h-10 w-auto object-contain">
        </div>

        @if (Route::has('login'))
        <nav class="flex space-x-3 items-center">
            @auth
            <a href="{{ url('/dashboard') }}"
                class="font-semibold text-white bg-red-600 hover:bg-red-700 px-6 py-2 rounded-full shadow-sm transition duration-300">
                Dashboard
            </a>
            @else
            @if (Route::has('register'))
            <a href="{{ route('register') }}"
                class="font-semibold text-red-600 border-2 border-red-600 bg-transparent hover:bg-red-50 px-6 py-2 rounded-full transition duration-300">
                Register
            </a>
            @endif

            <a href="{{ route('login') }}"
                class="font-semibold text-white bg-red-600 hover:bg-red-700 px-6 py-2 rounded-full shadow-sm transition duration-300">
                Login
            </a>
            @endauth
        </nav>
        @endif
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col items-center pb-20">

        <div class="w-full relative rounded-2xl overflow-hidden mt-6  flex items-center justify-center">
            <img src="{{ asset('images/banner(1).png') }}" alt="Library Books" class="w-full h-auto object-contain">
            <h1
                class="absolute left-8 sm:left-12 lg:left-20 top-1/2 -translate-y-1/2 z-10 text-white text-3xl sm:text-4xl lg:text-5xl font-[Gelasio] font-medium  text-left leading-snug max-w-4xl drop-shadow-lg">
                Where Every Page is an <br> Experiment, Every Chapter is <br> a Discovery.
            </h1>
        </div>

        <div class="w-full grid grid-cols-1 md:grid-cols-3 gap-8 mt-16 px-4">
            <div class="flex gap-4 items-start">
                <svg class="w-8 h-8 text-red-700 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.5"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25">
                    </path>
                </svg>
                <div>
                    <h3 class="font-bold text-red-700 text-lg">Access from anywhere.</h3>
                    <p class="text-sm text-gray-600 mt-1">Whether on desktop or mobile device.</p>
                </div>
            </div>
            <div class="flex gap-4 items-start">
                <svg class="w-8 h-8 text-red-700 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.5"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25">
                    </path>
                </svg>
                <div>
                    <h3 class="font-bold text-red-700 text-lg">Easy Book Borrowing.</h3>
                    <p class="text-sm text-gray-600 mt-1">The borrowing process is designed to be simple and efficient.
                    </p>
                </div>
            </div>
            <div class="flex gap-4 items-start">
                <svg class="w-8 h-8 text-red-700 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.5"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"></path>
                </svg>
                <div>
                    <h3 class="font-bold text-red-700 text-lg">Fast Book Search</h3>
                    <p class="text-sm text-gray-600 mt-1">A smart search helps users find books quickly in the catalog.
                    </p>
                </div>
            </div>
        </div>

        <div class="w-full mt-20 bg-white border border-gray-200 rounded-xl p-8 shadow-sm">
            <h2 class="text-xl font-semibold mb-8">Categories</h2>

            <div class="flex flex-wrap justify-between gap-6">

                @for ($i = 0; $i < 7; $i++) <div
                    class="flex flex-col items-center gap-3 w-20 text-center cursor-pointer group">
                    <div
                        class="w-14 h-14 rounded-full bg-red-700 text-white flex items-center justify-center group-hover:bg-red-800 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9">
                            </path>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-gray-800 leading-tight">Sports,<br>Travel
                        &<br>Tourism</span>
            </div>
            @endfor

        </div>
        </div>
        <div class="w-full mt-24 mb-20 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">

            <h2 class="text-xl md:text-2xl text-gray- dark:text-black mb-8 font-['Inter'] font-medium tracking-wide">
                Newly Added Books
            </h2>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 md:gap-6">

                <div class="group cursor-pointer">
                    <img src="{{ asset('images/coverbook1.jpg') }}" alt="Book Cover 1"
                        class="w-full h-auto aspect-[2/3] object-cover rounded border border-gray-200 shadow-sm group-hover:shadow-xl transition-all duration-300 group-hover:-translate-y-2">
                </div>

                <div class="group cursor-pointer">
                    <img src="{{ asset('images/coverbook2.jpg') }}" alt="Book Cover 2"
                        class="w-full h-auto aspect-[2/3] object-cover rounded border border-gray-200 shadow-sm group-hover:shadow-xl transition-all duration-300 group-hover:-translate-y-2">
                </div>

                <div class="group cursor-pointer">
                    <img src="{{ asset('images/coverbook3.jpg') }}" alt="Book Cover 3"
                        class="w-full h-auto aspect-[2/3] object-cover rounded border border-gray-200 shadow-sm group-hover:shadow-xl transition-all duration-300 group-hover:-translate-y-2">
                </div>

                <div class="group cursor-pointer">
                    <img src="{{ asset('images/coverbook4.jpg') }}" alt="Book Cover 4"
                        class="w-full h-auto aspect-[2/3] object-cover rounded border border-gray-200 shadow-sm group-hover:shadow-xl transition-all duration-300 group-hover:-translate-y-2">
                </div>

                <div class="group cursor-pointer">
                    <img src="{{ asset('images/coverbook5.jpg') }}" alt="Book Cover 5"
                        class="w-full h-auto aspect-[2/3] object-cover rounded border border-gray-200 shadow-sm group-hover:shadow-xl transition-all duration-300 group-hover:-translate-y-2">
                </div>

                <div class="group cursor-pointer">
                    <img src="{{ asset('images/coverbook6.jpg') }}" alt="Book Cover 6"
                        class="w-full h-auto aspect-[2/3] object-cover rounded border border-gray-200 shadow-sm group-hover:shadow-xl transition-all duration-300 group-hover:-translate-y-2">
                </div>

            </div>
        </div>
        <div class="w-full mt-24 mb-20 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">

            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold font-[Gelasio] text-gray-900 mb-4">
                    Apa Kata Mereka?
                </h2>
                <p class="text-gray-500 font-['Inter'] max-w-2xl mx-auto">
                    Cerita pengalaman dari para siswa dan guru yang sudah merasakan kemudahan meminjam buku di DigiLab.
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
                            </path></svg>
                            @endfor
                    </div>

                    <p class="text-gray-700 font-['Inter'] leading-relaxed mb-8 relative z-10 line-clamp-4">
                        "Sistem peminjamannya gampang banget dipahami. UI-nya juga modern parah, nggak nyangka ini
                        aplikasi perpustakaan sekolah. Nyari referensi buat tugas kejuruan jadi super cepat!"
                    </p>

                    <div class="flex items-center gap-4 relative z-10 border-t border-gray-100 pt-6">
                        <img src="https://ui-avatars.com/api/?name=Deswita+Maharani&background=900b21&color=fff"
                            alt="User Avatar" class="w-12 h-12 rounded-full object-cover">
                        <div>
                            <h4 class="font-bold text-gray-900 text-sm">Deswita Maharani</h4>
                            <p class="text-xs text-gray-500">Siswa XII RPL</p>
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
                            </path></svg>
                            @endfor
                    </div>
                    <p class="text-gray-700 font-['Inter'] leading-relaxed mb-8 relative z-10 line-clamp-4">
                        "Sangat membantu! Katalog bukunya lengkap dan up-to-date. Fitur pencariannya akurat, jadi saya
                        nggak perlu repot keliling rak perpustakaan nyari buku yang saya butuhin."
                    </p>
                    <div class="flex items-center gap-4 relative z-10 border-t border-gray-100 pt-6">
                        <img src="https://ui-avatars.com/api/?name=Budi+Santoso&background=f3f4f6&color=374151"
                            alt="User Avatar" class="w-12 h-12 rounded-full object-cover">
                        <div>
                            <h4 class="font-bold text-gray-900 text-sm">Budi Santoso</h4>
                            <p class="text-xs text-gray-500">Siswa XI TKJ</p>
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
                            </path></svg>
                            @endfor
                    </div>
                    <p class="text-gray-700 font-['Inter'] leading-relaxed mb-8 relative z-10 line-clamp-4">
                        "Sebagai guru, saya sangat terbantu memantau siswa yang rajin membaca karya sastra. Tampilannya
                        sangat bersahabat. Sukses terus untuk inovasi sekolah kita tercinta!"
                    </p>
                    <div class="flex items-center gap-4 relative z-10 border-t border-gray-100 pt-6">
                        <img src="https://ui-avatars.com/api/?name=Siti+Aminah&background=f3f4f6&color=374151"
                            alt="User Avatar" class="w-12 h-12 rounded-full object-cover">
                        <div>
                            <h4 class="font-bold text-gray-900 text-sm">Ibu Siti Aminah</h4>
                            <p class="text-xs text-gray-500">Guru Bahasa Indonesia</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </main>

</body>

</html>