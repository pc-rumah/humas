<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modernize Free</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('dash/assets/images/logos/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('dash/assets/css/styles.min.css') }}" />
</head>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">

        @include('partdash.sidebar')

        <div class="body-wrapper">
            @include('partdash.header')
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>
    <script src="{{ asset('dash/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('dash/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dash/assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('dash/assets/js/app.min.js') }}"></script>
    <script src="{{ asset('dash/assets/libs/simplebar/dist/simplebar.js') }}"></script>
    <script src="{{ asset('dash/assets/js/dashboard.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll(
                'button[data-bs-toggle="modal"][data-bs-target="#alert-hapus"]');
            const deleteForm = document.getElementById('form-delete');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const url = button.getAttribute('data-url');
                    deleteForm.setAttribute('action', url);
                });
            });
        });

        $(document).ready(function() {
            $('#alert-sukses, #alert-error, #alert-error-list').hide().fadeIn(500);

            setTimeout(function() {
                $('#alert-sukses, #alert-error, #alert-error-list').fadeOut(500);
            }, 5000); // 5 detik
        });
    </script>

</body>

</html>
