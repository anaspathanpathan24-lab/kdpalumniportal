@extends('layouts.app')

@section('content')
    <!-- Rich Header Banner with Image & Gradient Overlay code -->
    <div class="relative w-full h-64 flex items-center justify-center overflow-hidden shadow-md">
        <!-- Background Image -->
        <img src="https://picsum.photos/id/1073/1920/600" class="absolute inset-0 w-full h-full object-cover" alt="Profile Background">
        <!-- Gradient Overlay matching your dashboard cards -->
        <div class="absolute inset-0 bg-gradient-to-r from-brand-navy via-brand-navy/90 to-[#8b0000]/80"></div>
        
        <!-- Header Content -->
        <div class="relative z-10 text-center text-white px-4">
            <h1 class="font-serif text-3xl md:text-4xl font-bold mb-3 tracking-wide">Your Alumni Profile</h1>
            <p class="text-sm md:text-base font-light text-gray-200 max-w-2xl mx-auto">
                Keep your information updated to strengthen your connections, discover new opportunities, and stay engaged with your community.
            </p>
        </div>
    </div>

    <!-- Main Form Card (Elevated over the banner) -->
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 pb-24 relative z-20">
        
        <!-- Success Message -->
        @if (session('status') === 'profile-updated')
            <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 text-sm rounded shadow-sm flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                Your profile information has been successfully updated.
            </div>
        @endif

        <div class="bg-white rounded-sm shadow-xl p-6 md:p-10 border-t-4 border-brand-maroon">
            
            <form method="post" action="{{ route('profile.update') }}" class="space-y-10">
                @csrf
                @method('patch')

                <!-- ============================================== -->
                <!-- SECTION 1: Personal Details                    -->
                <!-- ============================================== -->
                <div>
                    <h2 class="font-serif text-2xl font-bold text-brand-navy border-b border-gray-200 pb-3 mb-6">
                        Personal Details
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Full Name -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Full Name <span class="text-red-500">*</span></label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full border border-gray-300 rounded-sm shadow-sm py-2 px-3 text-gray-900 focus:outline-none focus:ring-1 focus:ring-brand-maroon focus:border-brand-maroon transition-colors text-sm">
                            @error('name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Email Address <span class="text-red-500">*</span></label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full border border-gray-300 rounded-sm shadow-sm py-2 px-3 text-gray-900 focus:outline-none focus:ring-1 focus:ring-brand-maroon focus:border-brand-maroon transition-colors text-sm">
                            @error('email') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Phone -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Phone Number</label>
                            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="w-full border border-gray-300 rounded-sm shadow-sm py-2 px-3 text-gray-900 focus:outline-none focus:ring-1 focus:ring-brand-maroon focus:border-brand-maroon transition-colors text-sm">
                        </div>
                        
                        <!-- Role (Disabled) -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Current Role</label>
                            <input type="text" disabled value="{{ ucfirst($user->role) }}" class="w-full border border-gray-200 bg-gray-50 rounded-sm shadow-inner py-2 px-3 text-gray-500 text-sm cursor-not-allowed">
                            <span class="text-xs text-gray-400 mt-1 block">Role cannot be changed after registration.</span>
                        </div>
                    </div>
                </div>

                <!-- ============================================== -->
                <!-- SECTION 2: Academic Record                     -->
                <!-- ============================================== -->
                @if($user->role === 'alumni' || $user->role === 'student')
                <div>
                    <h2 class="font-serif text-2xl font-bold text-brand-navy border-b border-gray-200 pb-3 mb-6">
                        Academic Record
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Degree -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Course / Degree</label>
                            <input type="text" name="degree" value="{{ old('degree', $user->degree) }}" placeholder="e.g. B.Tech" class="w-full border border-gray-300 rounded-sm shadow-sm py-2 px-3 text-gray-900 focus:outline-none focus:ring-1 focus:ring-brand-navy focus:border-brand-navy transition-colors text-sm">
                        </div>

                        <!-- Department -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Department</label>
                            <input type="text" name="department" value="{{ old('department', $user->department) }}" placeholder="e.g. Computer Science" class="w-full border border-gray-300 rounded-sm shadow-sm py-2 px-3 text-gray-900 focus:outline-none focus:ring-1 focus:ring-brand-navy focus:border-brand-navy transition-colors text-sm">
                        </div>

                        <!-- Year of Joining -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Year of Joining</label>
                            <select name="year_joining" class="w-full border border-gray-300 rounded-sm shadow-sm py-2 px-3 text-gray-900 focus:outline-none focus:ring-1 focus:ring-brand-navy focus:border-brand-navy transition-colors text-sm">
                                <option value="">Select Year</option>
                                @for($i = date('Y'); $i >= 1970; $i--)
                                    <option value="{{ $i }}" {{ old('year_joining', $user->year_joining) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        <!-- Year of Graduation -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Year of Graduation</label>
                            <select name="graduation_year" class="w-full border border-gray-300 rounded-sm shadow-sm py-2 px-3 text-gray-900 focus:outline-none focus:ring-1 focus:ring-brand-navy focus:border-brand-navy transition-colors text-sm">
                                <option value="">Select Year</option>
                                @for($i = date('Y') + 5; $i >= 1970; $i--)
                                    <option value="{{ $i }}" {{ old('graduation_year', $user->graduation_year) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        <!-- Entry No -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Entry No.</label>
                            <input type="text" name="entry_no" value="{{ old('entry_no', $user->entry_no) }}" class="w-full border border-gray-300 rounded-sm shadow-sm py-2 px-3 text-gray-900 focus:outline-none focus:ring-1 focus:ring-brand-navy focus:border-brand-navy transition-colors text-sm">
                        </div>
                    </div>
                </div>
                @endif

                <!-- ============================================== -->
                <!-- Submit Action                                  -->
                <!-- ============================================== -->
                <div class="pt-4 flex justify-end">
                    <button type="submit" class="bg-brand-maroon hover:bg-[#6b0d0d] text-white font-bold py-2.5 px-8 rounded-sm shadow-md transition-colors text-sm">
                        Save Profile Changes
                    </button>
                </div>
            </form>
            
        </div>
    </div>
@endsection
