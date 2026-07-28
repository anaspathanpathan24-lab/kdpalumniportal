@extends('layouts.app')

@section('content')
    <!-- Dark Header Banner -->
    <div class="bg-[#1a202c] w-full pt-12 pb-24 px-4 sm:px-6 lg:px-8 shadow-inner">
        <div class="max-w-5xl mx-auto">
            <h1 class="text-3xl font-sans text-white font-light tracking-wide">Login</h1>
        </div>
    </div>

    <!-- Login Card (Overlapping the banner) -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 pb-24 relative z-10">
        <div class="bg-white shadow-xl flex flex-col md:flex-row overflow-hidden border border-gray-200">
            
            <!-- Left Side: Branding -->
            <div class="md:w-1/2 p-12 flex flex-col items-center justify-center border-b md:border-b-0 md:border-r border-gray-200 text-center bg-white">
                <img src="https://picsum.photos/id/147/200/100" class="mb-8 object-contain" alt="KDP Logo">
                <h2 class="text-2xl font-sans text-gray-800 mb-3 tracking-wide">KDP Alumni<br>Association</h2>
                <p class="text-[15px] text-gray-500 px-4 leading-relaxed">
                    Log in to stay connected with your community.
                </p>
            </div>

            <!-- Right Side: Authentication -->
            <div class="md:w-1/2 p-10 md:p-14 flex flex-col justify-center bg-white">
                <p class="text-gray-700 text-lg mb-8 leading-snug font-light">
                    Welcome back! Please login to your account.
                </p>

                <!-- Google Login Button -->
                <a href="{{ route('auth.google') }}" class="w-full bg-[#ea4335] text-white font-medium text-[15px] py-3 px-4 shadow-[0_2px_4px_rgba(0,0,0,0.2)] hover:bg-[#d33426] transition-colors text-center uppercase tracking-wide mb-8 rounded-[2px]">
                    Connect with Google
                </a>

                <!-- Custom OR Divider -->
                <div class="flex items-center mb-8 relative">
                    <hr class="flex-grow border-gray-300">
                    <div class="absolute left-1/2 transform -translate-x-1/2 bg-gray-200 text-gray-600 text-xs font-medium px-2 py-1 rounded-full border border-gray-300">
                        OR
                    </div>
                </div>

                <!-- Email Input Form -->
                <form action="{{ route('login.email') }}" method="POST" class="relative mt-2">
                    @csrf
                    <input type="email" name="email" placeholder="Enter your Email..." required
                           class="w-full border-b border-gray-300 py-2 pr-8 text-gray-700 focus:outline-none focus:border-brand-maroon transition-colors bg-transparent placeholder-gray-400 text-[15px]">
                    
                    <button type="submit" class="absolute right-0 top-2.5 text-brand-maroon hover:text-red-900 transition-colors">
                        <svg class="w-5 h-5 transform rotate-45" fill="currentColor" viewBox="0 0 20 20"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.751V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path></svg>
                    </button>
                </form>

                <!-- Link to Register -->
                <div class="mt-8 text-center">
                    <p class="text-sm text-gray-600">
                        Don't have an account? 
                        <a href="{{ route('register') }}" class="text-brand-maroon font-semibold hover:underline">Register here</a>
                    </p>
                </div>
            </div>
            
        </div>
    </div>
@endsection