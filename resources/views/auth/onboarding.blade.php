@extends('layouts.app')

@section('content')
    <!-- Dark Header Banner -->
    <div class="bg-[#202124] w-full pt-16 pb-32 shadow-inner">
        <!-- Empty banner to create the overlapping card effect -->
    </div>

    <!-- Onboarding Card (Overlapping the banner) -->
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 -mt-24 pb-24 relative z-10">
        <div class="bg-white shadow-xl rounded-md overflow-hidden border border-gray-200">
            
            <div class="p-8 md:p-12">
                <h2 class="text-2xl font-sans text-gray-800 mb-6 tracking-wide">
                    Add your role details in - KDP Alumni Association
                </h2>
                <p class="text-sm text-gray-500 mb-6">Fields marked <span class="text-red-500">*</span> are mandatory</p>

                <form action="{{ route('onboarding.store') }}" method="POST" class="w-full">
    @csrf
    
    <!-- Form Content Container (Light Gray Background) -->
    <div class="bg-gray-50/80 p-6 md:p-10 rounded-t-md">
        
        <!-- Top Row: Role & Phone -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8 mb-8">
            
            <!-- Role Dropdown -->
            <div>
                <label for="role" class="block text-[13px] text-gray-600 mb-1">Role *</label>
                <select id="role" name="role" required class="w-full border-b border-gray-300 py-1.5 text-gray-900 focus:outline-none focus:border-[#1967d2] bg-transparent text-[15px] cursor-pointer">
                    <option value="" disabled selected>Select Role</option>
                    <option value="alumni">Alumni (Past Student)</option>
                    <option value="student">Current Student</option>
                    <option value="faculty">Faculty / Staff</option>
                </select>
            </div>

            <!-- Empty space for layout balance if needed, or other fields -->
            <div class="hidden md:block"></div>
        </div>

        <!-- DYNAMIC SECTION: Alumni Fields -->
        <div id="alumni-fields" class="hidden">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8 mb-8">
                <div>
                    <label class="block text-[13px] text-gray-600 mb-1">Course/Degree *</label>
                    <input type="text" name="degree" placeholder="Course/Degree" class="w-full border-b border-gray-300 py-1.5 text-gray-900 focus:outline-none focus:border-[#1967d2] bg-transparent text-[15px]">
                </div>
                <div>
                    <label class="block text-[13px] text-gray-600 mb-1">Department *</label>
                    <input type="text" name="department" placeholder="Department" class="w-full border-b border-gray-300 py-1.5 text-gray-900 focus:outline-none focus:border-[#1967d2] bg-transparent text-[15px]">
                </div>
                <div>
                    <label class="block text-[13px] text-gray-600 mb-1">Year of Joining*</label>
                    <select name="year_joining" class="w-full border-b border-gray-300 py-1.5 text-gray-900 focus:outline-none focus:border-[#1967d2] bg-transparent text-[15px]">
                        <option value="" disabled selected>Select Year of Joining</option>
                        @for($i = date('Y'); $i >= 1970; $i--)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                
                <!-- Matching the specific row from your image -->
                <div class="flex flex-col md:flex-row md:space-x-8 space-y-8 md:space-y-0">
                    <div class="flex-1">
                        <label class="block text-[13px] text-gray-600 mb-1">Year of Graduation*</label>
                        <select name="graduation_year" class="w-full border-b border-gray-300 py-1.5 text-gray-900 focus:outline-none focus:border-[#1967d2] bg-transparent text-[15px]">
                            <option value="" disabled selected>Select Year of Graduation</option>
                            @for($i = date('Y') + 5; $i >= 1970; $i--)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="flex-1 flex space-x-4">
                        <div class="w-24">
                            <label class="block text-[13px] text-gray-600 mb-1">Country code</label>
                            <select name="country_code" class="w-full border-b border-gray-300 py-1.5 text-gray-900 focus:outline-none focus:border-[#1967d2] bg-transparent text-[15px]">
                                <option value="+91">+91 India</option>
                            </select>
                        </div>
                        <div class="flex-1">
                            <label class="block text-[13px] text-gray-600 mb-1">&nbsp;</label>
                            <input type="text" name="phone" placeholder="Phone No *" class="w-full border-b border-gray-300 py-1.5 text-gray-900 focus:outline-none focus:border-[#1967d2] bg-transparent text-[15px] placeholder-gray-400">
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-[13px] text-gray-600 mb-1">Entry No. *</label>
                    <input type="text" name="entry_no" placeholder="Fill Your Entry No." class="w-full border-b border-gray-300 py-1.5 text-gray-900 focus:outline-none focus:border-[#1967d2] bg-transparent text-[15px]">
                </div>
            </div>
        </div>

        <!-- Agreements (Exact match to image checkboxes) -->
        <div class="mt-12 space-y-2.5">
            <label class="flex items-center space-x-3 text-[15px] text-gray-800 cursor-pointer">
                <!-- Using w-5 h-5 for slightly larger checkboxes like the design -->
                <input type="checkbox" required class="form-checkbox h-5 w-5 text-[#0d6efd] border-gray-500 rounded-[2px] focus:ring-[#0d6efd]">
                <span>I have read and agree to the <a href="#" class="text-[#0d6efd] hover:underline">Privacy Policy</a> and <a href="#" class="text-[#0d6efd] hover:underline">Terms and Conditions</a>.</span>
            </label>
            <label class="flex items-center space-x-3 text-[15px] text-gray-800 cursor-pointer">
                <input type="checkbox" required class="form-checkbox h-5 w-5 text-[#0d6efd] border-gray-500 rounded-[2px] focus:ring-[#0d6efd]">
                <span>I confirm that I have read and understood the <a href="#" class="text-[#0d6efd] hover:underline">Consent Form</a>.</span>
            </label>
        </div>

    </div> <!-- End Light Gray Container -->

    <!-- Submit Button Footer (Pure White Background) -->
    <div class="bg-white px-6 py-4 md:px-10 border-t border-gray-200 flex justify-end rounded-b-md">
        <button type="submit" class="bg-[#0b5ed7] hover:bg-[#0a53be] text-white font-medium py-2 px-5 rounded-[4px] shadow-sm transition-colors text-[15px]">
            Join Alumni Network
        </button>
    </div>
</form>

            </div>
        </div>
    </div>

    <!-- JavaScript to toggle dynamic fields -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const roleSelect = document.getElementById('role');
            const alumniFields = document.getElementById('alumni-fields');

            roleSelect.addEventListener('change', function() {
                // If Alumni is selected, show the extra fields. Otherwise, hide them.
                if (this.value === 'alumni') {
                    alumniFields.classList.remove('hidden');
                    // Add required attributes to alumni fields
                    alumniFields.querySelectorAll('input, select').forEach(el => el.setAttribute('required', 'true'));
                } else {
                    alumniFields.classList.add('hidden');
                    // Remove required attributes so form can submit for Students/Faculty
                    alumniFields.querySelectorAll('input, select').forEach(el => el.removeAttribute('required'));
                }
            });
        });
    </script>
@endsection