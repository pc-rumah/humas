@if (Session::has('success'))
    <div id="alert-sukses" class="alert alert-success">{{ Session::get('success') }}</div>
@endif
@if ($errors->any())
    <div id="alert-error" class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (session('error'))
    <div id="alert-error" class="alert alert-danger">{{ session('error') }}</div>
@endif
