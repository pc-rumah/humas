<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .glass-effect {
            backdrop-filter: blur(16px) saturate(180%);
            -webkit-backdrop-filter: blur(16px) saturate(180%);
            background-color: rgba(255, 255, 255, 0.75);
            border: 1px solid rgba(209, 213, 219, 0.3);
        }

        .form-container {
            animation: fadeInUp 0.6s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .input:focus {
            transform: scale(1.02);
            transition: transform 0.2s ease;
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen p-4">
    <div class="form-container w-full max-w-md">
        <div class="card glass-effect shadow-2xl">
            <div class="card-body">
                <!-- Header -->
                <div class="text-center mb-6">
                    <div class="avatar placeholder mb-4">
                        <div class="bg-primary text-primary-content rounded-full w-16">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 7a2 2 0 012 2m0 0a2 2 0 012 2v6a2 2 0 01-2 2H7a2 2 0 01-2-2V9a2 2 0 012-2m0 0V7a2 2 0 012-2h4a2 2 0 012 2v2M9 12h6" />
                            </svg>
                        </div>
                    </div>
                    <h1 class="text-3xl font-bold text-gray-800">Forgot Password?</h1>
                    <p class="text-gray-600 mt-2">No worries! Enter your email address and we'll send you a reset link.
                    </p>
                </div>

                <!-- Form -->
                <form id="forgotPasswordForm" method="POST" action="{{ route('password.email') }}" class="space-y-6">
                    @csrf

                    <!-- Email Input -->
                    <div class="form-control">
                        <label class="label" for="email">
                            <span class="label-text font-semibold text-gray-700">Email Address</span>
                        </label>
                        <div class="relative">
                            <input type="email" id="email" name="email" placeholder="Enter your email address"
                                class="input input-bordered w-full pl-12 transition-all duration-200 @error('email') border-red-500 @enderror"
                                required autocomplete="email" value="{{ old('email') }}" />
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg>
                        </div>
                        <label class="label">
                            <span class="label-text-alt text-gray-500">We'll send a reset link to this email</span>
                        </label>
                        @error('email')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="form-control">
                        <button type="submit"
                            class="btn btn-primary w-full transition-all duration-200 text-white font-semibold">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                            Send Reset Link
                        </button>
                    </div>

                    <!-- Success Message -->
                    @if (session('status'))
                        <div class="text-sm text-green-600 text-center">
                            {{ session('status') }}
                        </div>
                    @endif
                </form>


                <!-- Back to Login Link -->
                <div class="divider">OR</div>
                <div class="text-center">
                    <a href="/login" class="link link-primary font-semibold hover:link-hover">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to Login
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('email').addEventListener('focus', function() {
            this.parentElement.classList.add('scale-102');
        });

        document.getElementById('email').addEventListener('blur', function() {
            this.parentElement.classList.remove('scale-102');
        });
    </script>
</body>

</html>
