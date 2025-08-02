<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.24/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="min-h-screen bg-base-200">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="card w-full max-w-md bg-base-100 shadow-xl">
            <div class="card-body">
                <!-- Header -->
                <div class="text-center mb-6">
                    <div class="avatar placeholder mb-4">
                        <div class="bg-primary text-primary-content rounded-full w-16">
                            <i class="fas fa-key text-2xl"></i>
                        </div>
                    </div>
                    <h1 class="text-2xl font-bold text-base-content">Reset Password</h1>
                    <p class="text-base-content/70 mt-2">Enter your email and new password</p>
                </div>

                <!-- Reset Password Form -->
                <form id="resetPasswordForm" method="POST" action="{{ route('password.store') }}" class="space-y-4">
                    @csrf

                    <!-- Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- Email Field -->
                    <div class="form-control">
                        <label class="label" for="email">
                            <span class="label-text font-medium">Email Address</span>
                        </label>
                        <div class="relative">
                            <input type="email" id="email" name="email" placeholder="Enter your email"
                                class="input input-bordered w-full pl-10 @error('email') border-red-500 @enderror"
                                required value="{{ old('email', $request->email) }}" autocomplete="username" />
                            <i
                                class="fas fa-envelope absolute left-3 top-1/2 transform -translate-y-1/2 text-base-content/50"></i>
                        </div>
                        @error('email')
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- New Password Field -->
                    <div class="form-control">
                        <label class="label" for="password">
                            <span class="label-text font-medium">New Password</span>
                        </label>
                        <div class="relative">
                            <input type="password" id="password" name="password" placeholder="Enter new password"
                                class="input input-bordered w-full pl-10 pr-10 @error('password') border-red-500 @enderror"
                                required autocomplete="new-password" minlength="8" />
                            <i
                                class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-base-content/50"></i>
                            <button type="button"
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-base-content/50 hover:text-base-content"
                                onclick="togglePassword('password')">
                                <i class="fas fa-eye" id="passwordToggle"></i>
                            </button>
                        </div>
                        <label class="label">
                            <span class="label-text-alt text-base-content/70">Minimum 8 characters</span>
                        </label>
                        @error('password')
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="form-control">
                        <label class="label" for="password_confirmation">
                            <span class="label-text font-medium">Confirm New Password</span>
                        </label>
                        <div class="relative">
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                placeholder="Confirm new password" class="input input-bordered w-full pl-10 pr-10"
                                required autocomplete="new-password" />
                            <i
                                class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-base-content/50"></i>
                            <button type="button"
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-base-content/50 hover:text-base-content"
                                onclick="togglePassword('password_confirmation')">
                                <i class="fas fa-eye" id="confirmPasswordToggle"></i>
                            </button>
                        </div>
                        @error('password_confirmation')
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password Strength Indicator (opsional - frontend only) -->
                    <div class="form-control">
                        <div class="flex items-center space-x-2 text-sm">
                            <span class="text-base-content/70">Password strength:</span>
                            <div class="flex space-x-1">
                                <div class="w-6 h-2 bg-base-300 rounded" id="strength1"></div>
                                <div class="w-6 h-2 bg-base-300 rounded" id="strength2"></div>
                                <div class="w-6 h-2 bg-base-300 rounded" id="strength3"></div>
                                <div class="w-6 h-2 bg-base-300 rounded" id="strength4"></div>
                            </div>
                            <span class="text-base-content/70" id="strengthText">Weak</span>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="form-control mt-6">
                        <button type="submit" class="btn btn-primary w-full">
                            <i class="fas fa-key mr-2"></i>
                            Reset Password
                        </button>
                    </div>

                    <!-- Back to Login -->
                    <div class="text-center mt-4">
                        <a href="{{ route('login') }}" class="text-sm">
                            <i class="fas fa-arrow-left mr-1"></i>
                            Back to Login
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        // Toggle password visibility
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const toggle = document.getElementById(fieldId + 'Toggle');

            if (field.type === 'password') {
                field.type = 'text';
                toggle.classList.remove('fa-eye');
                toggle.classList.add('fa-eye-slash');
            } else {
                field.type = 'password';
                toggle.classList.remove('fa-eye-slash');
                toggle.classList.add('fa-eye');
            }
        }

        // Password strength checker
        function checkPasswordStrength(password) {
            let strength = 0;
            const indicators = ['strength1', 'strength2', 'strength3', 'strength4'];
            const strengthText = document.getElementById('strengthText');

            // Reset indicators
            indicators.forEach(id => {
                document.getElementById(id).className = 'w-6 h-2 bg-base-300 rounded';
            });

            if (password.length >= 8) strength++;
            if (password.match(/[a-z]/)) strength++;
            if (password.match(/[A-Z]/)) strength++;
            if (password.match(/[0-9]/) || password.match(/[^a-zA-Z0-9]/)) strength++;

            const colors = ['bg-error', 'bg-warning', 'bg-info', 'bg-success'];
            const texts = ['Weak', 'Fair', 'Good', 'Strong'];

            for (let i = 0; i < strength; i++) {
                document.getElementById(indicators[i]).className = `w-6 h-2 ${colors[strength - 1]} rounded`;
            }

            strengthText.textContent = texts[strength - 1] || 'Weak';
            strengthText.className = `text-${colors[strength - 1]?.replace('bg-', '') || 'error'}`;
        }

        // Event listeners
        document.getElementById('password').addEventListener('input', function() {
            checkPasswordStrength(this.value);
        });

        // Theme toggle (optional)
        function toggleTheme() {
            const html = document.documentElement;
            const currentTheme = html.getAttribute('data-theme');
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
            html.setAttribute('data-theme', newTheme);
        }
    </script>
</body>

</html>
