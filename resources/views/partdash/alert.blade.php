@if (session('success'))
    <div id="success-alert"
        class="alert alert-success bg-blue-400 shadow-sm flex items-center p-2 rounded-lg opacity-0 transition-opacity duration-500 ease-in-out animate-fade-in">
        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-5 w-5 text-green-500" fill="none"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        <h5 class="text-green-500 ml-2">{{ session('success') }}</h5>
    </div>
@endif

@if ($errors->any())
    <div id="error-alert"
        class="alert alert-error bg-red-100 shadow-sm flex items-center p-2 rounded-lg opacity-0 transition-opacity duration-500 ease-in-out animate-fade-in">
        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-5 w-5 text-red-500" fill="none"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M18.364 5.636l-1.414 1.414M12 8v4m0 4h.01" />
        </svg>
        <h5 class="text-red-500 ml-2">Terjadi kesalahan pada input. Silakan periksa kembali.</h5>
    </div>
@endif
