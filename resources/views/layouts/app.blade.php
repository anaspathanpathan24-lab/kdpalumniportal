<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KDP Alumni Association</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:wght@600;700;800&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            navy: '#1f355e', /* Updated to the exact IITDAA dark blue */
                            gold: '#d4af37',
                            maroon: '#8b0000',
                            crimson: '#dc143c'
                        }
                    },
                    fontFamily: {
                        serif: ['"Playfair Display"', 'serif'],
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        .animate-marquee { animation: marquee 25s linear infinite; }
        @keyframes marquee {
            0% { transform: translateX(100%); }
            100% { transform: translateX(-100%); }
        }
    </style>
</head>
<body class="font-sans bg-gray-50 text-gray-800 antialiased">

    <!-- ============================================== -->
    <!-- TIER 1: White Header (Logo, Socials, Auth)     -->
    <!-- ============================================== -->
    <div class="bg-white w-full shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex flex-col md:flex-row justify-between items-center">
            
            <!-- Left: Logo & Brand -->
            <div class="flex items-center space-x-3 mb-4 md:mb-0">
                <img class="h-16 w-auto" src="https://picsum.photos/id/147/100/100" alt="Institution Logo">
                <div class="flex flex-col justify-center">
                    <h1 class="font-serif text-brand-maroon text-2xl md:text-3xl font-bold tracking-tight leading-none">KDP</h1>
                    <h2 class="font-sans text-brand-navy text-xl font-bold tracking-tight leading-none mt-1">alumni association</h2>
                </div>
            </div>

            <!-- Right: Social Icons & Action Button -->
            <div class="flex items-center space-x-6">
                <!-- Social Icons -->
                <div class="flex space-x-2">
                    <a href="#" class="w-8 h-8 rounded-full bg-[#1877F2] text-white flex items-center justify-center hover:opacity-80 transition-opacity">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path></svg>
                    </a>
                    <a href="#" class="w-8 h-8 rounded-full bg-[#0A66C2] text-white flex items-center justify-center hover:opacity-80 transition-opacity">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"></path><circle cx="4" cy="4" r="2"></circle></svg>
                    </a>
                    <a href="#" class="w-8 h-8 rounded-full bg-[#1DA1F2] text-white flex items-center justify-center hover:opacity-80 transition-opacity">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path></svg>
                    </a>
                    <a href="#" class="w-8 h-8 rounded-full bg-[#FF0000] text-white flex items-center justify-center hover:opacity-80 transition-opacity">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M22.54 6.42a2.78 2.78 0 00-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 00-1.94 2A29 29 0 001 11.75a29 29 0 00.46 5.33 2.78 2.78 0 001.94 2c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 001.94-2 29 29 0 00.46-5.33 29 29 0 00-.46-5.33zM9.75 15.02V8.48L15.5 11.75l-5.75 3.27z"></path></svg>
                    </a>
                    <a href="#" class="w-8 h-8 rounded-full bg-gradient-to-tr from-[#f09433] via-[#dc2743] to-[#bc1888] text-white flex items-center justify-center hover:opacity-80 transition-opacity">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"></path></svg>
                    </a>
                </div>

                <!-- Sign Up / Login Button -->
                @auth
                    <a href="{{ route('dashboard') }}" class="bg-brand-maroon hover:bg-red-900 text-white font-bold py-2.5 px-6 rounded shadow-md transition-colors text-sm uppercase tracking-wide">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="bg-brand-maroon hover:bg-red-900 text-white font-bold py-2.5 px-6 rounded shadow-md transition-colors text-sm uppercase tracking-wide">
                        SIGN UP / LOGIN
                    </a>
                @endauth
            </div>
        </div>
    </div>

    <!-- ============================================== -->
    <!-- TIER 2: Dark Navy Main Navigation Bar          -->
    <!-- ============================================== -->
    <nav class="bg-brand-navy w-full shadow-md z-40 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-center items-center h-12 space-x-6 md:space-x-10">
                
                <div class="group relative flex items-center h-full cursor-pointer">
                    <a href="#" class="text-white hover:text-gray-300 text-[15px] font-medium tracking-wide flex items-center transition-colors">
                        Giving Back 
                        <svg class="w-3.5 h-3.5 ml-1.5 stroke-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path></svg>
                    </a>
                </div>
                
                <div class="group relative flex items-center h-full cursor-pointer">
                    <a href="{{ route('id-card.show') }}" class="text-white hover:text-gray-300 text-[15px] font-medium tracking-wide transition-colors">
                        Smart I-Card
                    </a>
                </div>
                
                <div class="group relative flex items-center h-full cursor-pointer">
                    <a href="#" class="text-white hover:text-gray-300 text-[15px] font-medium tracking-wide flex items-center transition-colors">
                        Events 
                        <svg class="w-3.5 h-3.5 ml-1.5 stroke-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path></svg>
                    </a>
                </div>
                
                <div class="group relative flex items-center h-full cursor-pointer">
                    <a href="#" class="text-white hover:text-gray-300 text-[15px] font-medium tracking-wide flex items-center transition-colors">
                        Startup 
                        <svg class="w-3.5 h-3.5 ml-1.5 stroke-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path></svg>
                    </a>
                </div>
                
                <div class="group relative flex items-center h-full cursor-pointer">
                    <a href="#" class="text-white hover:text-gray-300 text-[15px] font-medium tracking-wide flex items-center transition-colors">
                        Updates 
                        <svg class="w-3.5 h-3.5 ml-1.5 stroke-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path></svg>
                    </a>
                </div>

                <div class="group relative flex items-center h-full cursor-pointer">
                    <a href="#" class="text-white hover:text-gray-300 text-[15px] font-medium tracking-wide transition-colors">
                        Sponsorship
                    </a>
                </div>
                
                <!-- Services (WITH DROPDOWN) -->
                <div class="group relative flex items-center h-full cursor-pointer">
                    <a href="#" class="text-white hover:text-gray-300 text-[15px] font-medium tracking-wide flex items-center transition-colors">
                        Services 
                        <svg class="w-3.5 h-3.5 ml-1.5 stroke-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path></svg>
                    </a>
                    
                    <!-- Dropdown Menu -->
                    <div class="absolute top-12 left-0 w-56 bg-white shadow-lg border-t-4 border-brand-maroon opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 rounded-b-sm">
                        <ul class="py-2">
                            <li>
                                <a href="{{ route('alumni.index') }}" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-100 hover:text-brand-maroon font-medium transition-colors">Alumni Directory</a>
                            </li>
                            <li>
                                <a href="{{ route('jobs.index') }}" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-100 hover:text-brand-maroon font-medium transition-colors">Jobs & Opportunities</a>
                            </li>
                            <li>
                                <a href="{{ route('resources.index') }}" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-100 hover:text-brand-maroon font-medium transition-colors">Resource Vault</a>
                            </li>
                            <li>
                                <a href="{{ route('mentorship.index') }}" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-100 hover:text-brand-maroon font-medium transition-colors">Mentorship</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="group relative flex items-center h-full cursor-pointer">
                    <a href="#" class="text-white hover:text-gray-300 text-[15px] font-medium tracking-wide flex items-center transition-colors">
                        About 
                        <svg class="w-3.5 h-3.5 ml-1.5 stroke-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path></svg>
                    </a>
                </div>
                
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

</body>
</html>