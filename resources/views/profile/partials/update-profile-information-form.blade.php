<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information, email address, and alumni details.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- Profile Photo -->
        <div>
            <x-input-label for="photo" :value="__('Profile Photo (For ID Card)')" />
            <input id="photo" name="photo" type="file" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
            <x-input-error class="mt-2" :messages="$errors->get('photo')" />
        </div>

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Degree -->
        <div>
            <x-input-label for="degree" :value="__('Degree (e.g., Diploma, B.Tech)')" />
            <x-text-input id="degree" name="degree" type="text" class="mt-1 block w-full" :value="old('degree', optional($user->profile)->degree)" />
            <x-input-error class="mt-2" :messages="$errors->get('degree')" />
        </div>

        <!-- Department -->
        <div>
            <x-input-label for="department" :value="__('Department (e.g., Computer Engineering)')" />
            <x-text-input id="department" name="department" type="text" class="mt-1 block w-full" :value="old('department', optional($user->profile)->department)" />
            <x-input-error class="mt-2" :messages="$errors->get('department')" />
        </div>

        <!-- Graduation Year -->
        <div>
            <x-input-label for="graduation_year" :value="__('Graduation Year')" />
            <x-text-input id="graduation_year" name="graduation_year" type="number" class="mt-1 block w-full" :value="old('graduation_year', optional($user->profile)->graduation_year)" />
            <x-input-error class="mt-2" :messages="$errors->get('graduation_year')" />
        </div>

        <!-- Current Company -->
        <div>
            <x-input-label for="current_company" :value="__('Current Company')" />
            <x-text-input id="current_company" name="current_company" type="text" class="mt-1 block w-full" :value="old('current_company', optional($user->profile)->current_company)" />
            <x-input-error class="mt-2" :messages="$errors->get('current_company')" />
        </div>

        <!-- Job Title -->
        <div>
            <x-input-label for="job_title" :value="__('Job Title')" />
            <x-text-input id="job_title" name="job_title" type="text" class="mt-1 block w-full" :value="old('job_title', optional($user->profile)->job_title)" />
            <x-input-error class="mt-2" :messages="$errors->get('job_title')" />
        </div>

        <!-- Location -->
        <div>
            <x-input-label for="location" :value="__('Current Location (City, State)')" />
            <x-text-input id="location" name="location" type="text" class="mt-1 block w-full" :value="old('location', optional($user->profile)->location)" />
            <x-input-error class="mt-2" :messages="$errors->get('location')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>