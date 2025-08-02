<div class="card bg-base-100 shadow-xl">
    <div class="card-body">
        <h2 class="card-title text-2xl mb-4">
            <i class="fas fa-user text-primary"></i>
            Profile Information
        </h2>
        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>

        <form method="post" action="{{ route('profile.update') }}" class="space-y-4 mt-6">
            @csrf
            @method('patch')

            <div class="form-control">
                <label class="label">
                    <span class="label-text font-medium">Full Name</span>
                </label>
                <input type="text" name="name" id="name" placeholder="Enter your full name"
                    class="input input-bordered w-full" value="{{ old('name', $user->name) }}" required autofocus
                    autocomplete="name" />
                @error('name')
                    <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-control">
                <label class="label">
                    <span class="label-text font-medium">Email Address</span>
                </label>
                <input type="email" name="email" id="email" placeholder="Enter your email"
                    class="input input-bordered w-full" value="{{ old('email', $user->email) }}" required
                    autocomplete="username" />
                @error('email')
                    <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                @enderror

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                    <div class="mt-2 text-sm text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-green-600">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>

            <div class="card-actions justify-end mt-6">
                <button type="button" class="btn btn-outline">Cancel</button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-2"></i>
                    Save Changes
                </button>
            </div>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 mt-2">{{ __('Saved.') }}</p>
            @endif
        </form>
    </div>
</div>
