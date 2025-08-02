<!DOCTYPE html>
<html lang="id" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - My Account</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.24/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-base-200 min-h-screen">
    <!-- Header -->
    <div class="navbar bg-base-100 shadow-sm">
        <div class="flex-1">
            <a href="/dashboard" class="btn btn-ghost text-xl">
                <i class="fas fa-user-circle mr-2"></i>
                Profile Settings
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <!-- Card 1: Profile Information -->
            @include('profile.partials.update-profile-information-form')

            <!-- Card 2: Update Password -->
            @include('profile.partials.update-password-form')

            <!-- Card 3: Delete Account -->
            @include('profile.partials.delete-user-form')
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <dialog id="deleteModal" class="modal">
        <div class="modal-box w-11/12 max-w-md">
            <h3 class="font-bold text-lg text-error mb-4">
                <i class="fas fa-exclamation-triangle mr-2"></i>
                Confirm Account Deletion
            </h3>
            <div class="alert alert-error mb-4">
                <i class="fas fa-warning"></i>
                <div>
                    <div class="font-semibold">This action cannot be undone!</div>
                    <div>This will permanently delete your account and remove your data from our servers.</div>
                </div>
            </div>
            <form method="post" action="{{ route('profile.destroy') }}" class="space-y-4 mt-6">
                @csrf
                @method('delete')

                {{-- Password Input --}}
                <div class="form-control">
                    <label class="label">
                        <span class="label-text font-medium">Enter your password to confirm</span>
                    </label>
                    <div class="relative">
                        <input type="password" name="password" id="deletePassword" placeholder="Enter your password"
                            class="input input-bordered w-full pr-12" autocomplete="current-password" />
                        <button type="button"
                            class="btn btn-ghost btn-sm absolute right-1 top-1/2 transform -translate-y-1/2"
                            onclick="togglePassword('deletePassword')">
                            <i class="fas fa-eye" id="deletePasswordIcon"></i>
                        </button>
                    </div>
                    @if ($errors->userDeletion->has('password'))
                        <span class="text-red-600 text-sm mt-1">
                            {{ $errors->userDeletion->first('password') }}
                        </span>
                    @endif
                </div>

                {{-- Buttons --}}
                <div class="card-actions justify-end mt-6">
                    <button type="button" class="btn btn-outline" onclick="window.history.back();">Cancel</button>
                    <button type="submit" class="btn btn-error">
                        <i class="fas fa-trash-alt mr-2"></i>
                        Delete Account
                    </button>
                </div>
            </form>

        </div>
        <form method="dialog" class="modal-backdrop">
            <button onclick="closeDeleteModal()">close</button>
        </form>
    </dialog>

    <script>
        // Toggle password visibility
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(inputId + 'Icon');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        // Open delete modal
        function openDeleteModal() {
            document.getElementById('deleteModal').showModal();
        }

        // Close delete modal
        function closeDeleteModal() {
            document.getElementById('deleteModal').close();
            // Reset form
            document.getElementById('deletePassword').value = '';
            document.getElementById('confirmCheck').checked = false;
            updateDeleteButton();
        }

        // Event listeners
        document.getElementById('deletePassword').addEventListener('input', updateDeleteButton);
        document.getElementById('confirmCheck').addEventListener('change', updateDeleteButton);

        // Form submissions
        document.querySelector('.card:first-child form').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Profile information updated successfully!');
        });
    </script>
</body>

</html>
