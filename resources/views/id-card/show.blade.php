<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Digital Identity Card') }}
            </h2>
            <button onclick="window.print()" class="px-4 py-2 bg-gray-800 text-white rounded text-sm font-semibold hover:bg-gray-700">
                Print ID Card
            </button>
        </div>
    </x-slot>

    <div class="py-12">
        <!-- Added id-card-wrapper for targeted print centering -->
        <div id="id-card-wrapper" class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex justify-center">
            
            <!-- ID Card Container -->
            <div class="bg-white w-80 md:w-96 rounded-xl shadow-2xl overflow-hidden border border-gray-200 print:shadow-none print:border-gray-400">
                
                <!-- Header / Branding -->
                <div class="bg-indigo-700 p-4 text-center text-white">
                    <h3 class="font-bold text-lg tracking-wider">KDP ALUMNI ASSOCIATION</h3>
                    <p class="text-xs text-indigo-200">GIDC, Mehsana, Gujarat</p>
                </div>

                <!-- Body -->
                <div class="p-6 flex flex-col items-center relative">
                    <!-- Fake Barcode / Identifier at top right -->
                    <div class="absolute top-4 right-4 text-[10px] text-gray-400 font-mono tracking-widest">
                        ID: {{ str_pad($user->id, 6, '0', STR_PAD_LEFT) }}
                    </div>

                    <!-- Profile Photo or Fallback Placeholder -->
                    @if(optional($user->profile)->photo_path)
                        <img src="{{ asset('storage/' . $user->profile->photo_path) }}" alt="Profile Photo" class="w-24 h-24 rounded-full border-4 border-white shadow-md object-cover mb-4">
                    @else
                        <div class="w-24 h-24 bg-gray-200 rounded-full border-4 border-white shadow-md flex items-center justify-center text-3xl font-bold text-gray-500 mb-4 overflow-hidden">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    @endif

                    <!-- User Details -->
                    <h2 class="text-2xl font-bold text-gray-900 text-center">{{ $user->name }}</h2>
                    <p class="text-sm font-semibold text-indigo-600 mt-1 uppercase">{{ optional($user->profile)->degree ?? 'Alumnus' }}</p>
                    
                    <div class="w-full mt-6 space-y-2 border-t pt-4">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500 font-medium">Department:</span>
                            <span class="text-gray-900 font-bold text-right">{{ optional($user->profile)->department ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500 font-medium">Batch Year:</span>
                            <span class="text-gray-900 font-bold text-right">{{ optional($user->profile)->graduation_year ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500 font-medium">Blood Group:</span>
                            <span class="text-red-600 font-bold text-right">O+</span>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="bg-gray-100 p-3 text-center border-t">
                    <p class="text-xs text-gray-500">This is a system-generated digital identity card.</p>
                    <p class="text-[10px] text-gray-400 font-mono mt-1">* KDP-{{ date('Y') }}-{{ $user->id }} *</p>
                </div>
            </div>

        </div>
    </div>

    <style>
        @media print {
            /* This removes the default browser headers and footers (date, localhost URL) */
            @page {
                margin: 0mm; 
                size: portrait;
            }
            body {
                margin: 0;
                background-color: white;
            }
            body * {
                visibility: hidden;
            }
            /* Only show the ID card wrapper and its contents */
            #id-card-wrapper, #id-card-wrapper * {
                visibility: visible;
            }
            /* Center the wrapper exactly in the middle of the printed page */
            #id-card-wrapper {
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 100%;
                margin: 0;
                padding: 0;
            }
            button {
                display: none !important;
            }
        }
    </style>
</x-app-layout>