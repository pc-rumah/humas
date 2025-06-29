@if ($errors->any())
    <div class="alert alert-error mb-4">
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M18.364 5.636l-1.414 1.414m0 0a9 9 0 11-12.728 0 9 9 0 0112.728 0zM12 8v4m0 4h.01" />
            </svg>
            <span>Terjadi kesalahan pada input:</span>
        </div>
        <ul class="mt-2 list-disc list-inside text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
