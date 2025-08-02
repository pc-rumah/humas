<div class="card bg-base-100 shadow-xl">
    <div class="card-body">
        <h2 class="card-title text-2xl mb-4">
            <i class="fas fa-lock text-secondary"></i>
            Update Password
        </h2>
        <form method="post" action="{{ route('password.update') }}" class="space-y-4 mt-6">
            @csrf
            @method('put')

            {{-- Current Password --}}
            <div class="form-control">
                <label class="label">
                    <span class="label-text font-medium">Current Password</span>
                </label>
                <div class="relative">
                    <input type="password" name="current_password" id="currentPassword"
                        placeholder="Enter current password" class="input input-bordered w-full pr-12"
                        autocomplete="current-password" required />
                    <button type="button"
                        class="btn btn-ghost btn-sm absolute right-1 top-1/2 transform -translate-y-1/2"
                        onclick="togglePassword('currentPassword')">
                        <i class="fas fa-eye" id="currentPasswordIcon"></i>
                    </button>
                </div>
                @if ($errors->updatePassword->has('current_password'))
                    <span
                        class="text-red-600 text-sm mt-1">{{ $errors->updatePassword->first('current_password') }}</span>
                @endif
            </div>

            {{-- New Password --}}
            <div class="form-control">
                <label class="label">
                    <span class="label-text font-medium">New Password</span>
                </label>
                <div class="relative">
                    <input type="password" name="password" id="newPassword" placeholder="Enter new password"
                        class="input input-bordered w-full pr-12" autocomplete="new-password" required />
                    <button type="button"
                        class="btn btn-ghost btn-sm absolute right-1 top-1/2 transform -translate-y-1/2"
                        onclick="togglePassword('newPassword')">
                        <i class="fas fa-eye" id="newPasswordIcon"></i>
                    </button>
                </div>
                @if ($errors->updatePassword->has('password'))
                    <span class="text-red-600 text-sm mt-1">{{ $errors->updatePassword->first('password') }}</span>
                @endif
            </div>

            {{-- Confirm New Password --}}
            <div class="form-control">
                <label class="label">
                    <span class="label-text font-medium">Confirm New Password</span>
                </label>
                <div class="relative">
                    <input type="password" name="password_confirmation" id="confirmPassword"
                        placeholder="Confirm new password" class="input input-bordered w-full pr-12"
                        autocomplete="new-password" required />
                    <button type="button"
                        class="btn btn-ghost btn-sm absolute right-1 top-1/2 transform -translate-y-1/2"
                        onclick="togglePassword('confirmPassword')">
                        <i class="fas fa-eye" id="confirmPasswordIcon"></i>
                    </button>
                </div>
                @if ($errors->updatePassword->has('password_confirmation'))
                    <span
                        class="text-red-600 text-sm mt-1">{{ $errors->updatePassword->first('password_confirmation') }}</span>
                @endif
            </div>

            {{-- Button & Feedback --}}
            <div class="card-actions justify-end mt-6">
                <button type="button" class="btn btn-outline">Cancel</button>
                <button type="submit" class="btn btn-secondary">
                    <i class="fas fa-key mr-2"></i>
                    Update Password
                </button>
            </div>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 mt-2">
                    {{ __('Password updated successfully.') }}
                </p>
            @endif
        </form>

    </div>
</div>
