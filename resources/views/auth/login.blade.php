<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - DaisyUI Form</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="min-h-screen bg-base-200 flex items-center justify-center p-4">
    <div class="card w-full max-w-md bg-base-100 shadow-xl">
        <div class="card-body">
            <div class="text-center mb-6">
                <h1 class="text-3xl font-bold text-base-content">Welcome Back</h1>
                <p class="text-base-content/70 mt-2">Please sign in to your account</p>
            </div>

            @if (session('status'))
                <div class="alert alert-success mb-4">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <div class="form-control">
                    <label class="label">
                        <span class="label-text font-medium">Email</span>
                    </label>
                    <div class="relative">
                        <input type="email" name="email" id="email" placeholder="Enter your email"
                            class="input input-bordered w-full pl-10 @error('email') input-error @enderror"
                            value="{{ old('email') }}" required autofocus autocomplete="username" />
                        <i
                            class="fas fa-envelope absolute left-3 top-1/2 transform -translate-y-1/2 text-base-content/50"></i>
                    </div>
                    @error('email')
                        <label class="label">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </label>
                    @enderror
                </div>

                <div class="form-control">
                    <label class="label">
                        <span class="label-text font-medium">Password</span>
                    </label>
                    <div class="relative">
                        <input type="password" name="password" id="password" placeholder="Enter your password"
                            class="input input-bordered w-full pl-10 pr-10 @error('password') input-error @enderror"
                            required autocomplete="current-password" />
                        <i
                            class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-base-content/50"></i>
                        <button type="button"
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-base-content/50 hover:text-base-content"
                            onclick="togglePassword()">
                            <i class="fas fa-eye" id="toggleIcon"></i>
                        </button>
                    </div>
                    @error('password')
                        <label class="label">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </label>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <div class="form-control">
                        <label class="label cursor-pointer">
                            <input type="checkbox" name="remember" class="checkbox checkbox-primary checkbox-sm"
                                id="remember" />
                            <span class="label-text ml-2">Remember me</span>
                        </label>
                    </div>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="link link-primary text-sm hover:link-hover">
                            Forgot your password?
                        </a>
                    @endif
                </div>

                <div class="form-control mt-6">
                    <button type="submit" class="btn btn-primary w-full">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Sign In
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="fixed top-4 right-4">
        <button class="btn btn-circle btn-ghost" onclick="toggleTheme()">
            <i class="fas fa-moon" id="themeIcon"></i>
        </button>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.className = 'fas fa-eye-slash';
            } else {
                passwordInput.type = 'password';
                toggleIcon.className = 'fas fa-eye';
            }
        }

        function toggleTheme() {
            const html = document.documentElement;
            const themeIcon = document.getElementById('themeIcon');

            if (html.getAttribute('data-theme') === 'light') {
                html.setAttribute('data-theme', 'dark');
                themeIcon.className = 'fas fa-sun';
            } else {
                html.setAttribute('data-theme', 'light');
                themeIcon.className = 'fas fa-moon';
            }
        }
    </script>
</body>

</html>
