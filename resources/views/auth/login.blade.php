<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - DigiLab</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#f8f9fa] font-['Inter'] antialiased text-gray-900 min-h-screen flex flex-col justify-between">
    
    <header class="w-full py-6 px-8 sm:px-12 flex items-center gap-3">
        <img src="{{ asset('images/logolight.png') }}" alt="Logo DigiLab" class="h-10 w-auto object-contain">
    </header>

    <div class="flex-grow flex items-center justify-center p-6 lg:p-12">
        <div class="max-w-6xl w-full grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-24 items-center">
            
            <div class="bg-white p-8 md:p-10 rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] w-full max-w-md mx-auto lg:ml-auto lg:mr-0 border border-gray-100">
                
                <p class="text-gray-700 text-[15px] font-medium text-center mb-8">
                    Welcome Back! Please enter your credential
                </p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-5">
                        <label for="email" class="block font-bold text-gray-600 mb-2">Email Addres</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.53 4.518a2 2 0 002.04 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="bg-[#f4f5f7] border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-[#900b21] focus:border-[#900b21] block w-full pl-11 p-3.5 transition-colors">
                        </div>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="password" class="block font-bold text-gray-600 mb-2">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </div>
                            <input id="password" type="password" name="password" required autocomplete="current-password" class="bg-[#f4f5f7] border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-[#900b21] focus:border-[#900b21] block w-full pl-11 p-3.5 transition-colors">
                        </div>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between mb-8 px-1">
                        <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                            <input id="remember_me" type="checkbox" name="remember" class="rounded border-gray-300 text-[#900b21] shadow-sm focus:ring-[#900b21] transition duration-200">
                            <span class="ml-2 text-sm text-[#900b21] font-medium group-hover:underline underline-offset-2">Remember Me?</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm font-medium text-[#900b21] hover:underline underline-offset-2">
                                Forgot Password?
                            </a>
                        @endif
                    </div>

                    <button type="submit" class="w-full bg-[#900b21] hover:bg-[#7a091c] text-white font-bold py-3.5 px-4 rounded-xl flex justify-center items-center gap-2 transition duration-300">
                        Sign In 
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l3 3m0 0l-3 3m3-3H8.25"></path></svg>
                    </button>
                </form>
            </div>

            <div class="hidden lg:flex flex-col justify-center space-y-10">
                
                <div class="flex items-start gap-4 max-w-lg">
                    <div class="mt-1">
                        <svg class="w-8 h-8 text-[#900b21]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-[#900b21] font-medium text-lg tracking-wide">Get access from anywhere :</h3>
                        <h2 class="text-xl font-bold mt-1 leading-snug text-gray-900">Either through your desktop or <br> mobile device.</h2>
                        <p class="text-gray-600 mt-2 text-sm leading-relaxed">
                            DigiLab gives you the chance to get a swift and direct access to a wide range of books from anywhere you like.
                        </p>
                    </div>
                </div>

                <div class="flex items-start gap-4 max-w-lg">
                    <div class="mt-1">
                        <svg class="w-8 h-8 text-[#900b21]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-[#900b21] font-medium text-lg tracking-wide">Easy Book Borrowing</h3>
                        <h2 class="text-xl font-bold mt-1 leading-snug text-gray-900">Borrow books quickly without <br> complicated steps.</h2>
                        <p class="text-gray-600 mt-2 text-sm leading-relaxed">
                            The borrowing process is designed to be simple and efficient, allowing users to request books easily through the system.
                        </p>
                    </div>
                </div>

                <div class="flex items-start gap-4 max-w-lg">
                    <div class="mt-1">
                        <svg class="w-8 h-8 text-[#900b21]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-[#900b21] font-medium text-lg tracking-wide">Fast Book Search</h3>
                        <h2 class="text-xl font-bold mt-1 leading-snug text-gray-900">Find books by title, author, or <br> category.</h2>
                        <p class="text-gray-600 mt-2 text-sm leading-relaxed">
                            A smart search feature helps users locate books quickly from the library catalog.
                        </p>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <footer class="text-center py-6 text-gray-500 text-sm font-medium">
        &copy; {{ date('Y') }} Ahmad Maulana. All rights reserved.
    </footer>

</body>
</html>