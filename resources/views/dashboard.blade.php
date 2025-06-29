<!doctype html>
<html lang="en" data-pc-preset="preset-1" data-pc-sidebar-caption="true" data-pc-direction="ltr" dir="ltr"
    data-pc-theme="light">

<head>
    <title>Home</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="icon" href="{{ asset('dash/assets/images/favicon.svg') }}" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('dash/assets/fonts/phosphor/duotone/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('dash/assets/fonts/tabler-icons.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('dash/assets/fonts/feather.css') }}" />
    <link rel="stylesheet" href="{{ asset('dash/assets/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('dash/assets/fonts/material.css') }}" />
    <link rel="stylesheet" href="{{ asset('dash/assets/css/style.css') }}" id="main-style-link" />
    <style>
        .animate-fade-in {
            opacity: 1;
        }

        .animate-fade-out {
            opacity: 0;
        }
    </style>
</head>

<body>
    <div class="loader-bg fixed inset-0 bg-white dark:bg-themedark-cardbg z-[1034]">
        <div class="loader-track h-[5px] w-full inline-block absolute overflow-hidden top-0">
            <div
                class="loader-fill w-[300px] h-[5px] bg-primary-500 absolute top-0 left-0 animate-[hitZak_0.6s_ease-in-out_infinite_alternate]">
            </div>
        </div>
    </div>

    {{-- navbar --}}
    @include('partdash.navbar')

    {{-- header --}}
    @include('partdash.header')

    {{-- konten --}}
    <div class="pc-container">
        <div class="pc-content">

            @yield('content')

        </div>
    </div>

    {{-- asset js --}}
    @include('partdash.js')
</body>

</html>
