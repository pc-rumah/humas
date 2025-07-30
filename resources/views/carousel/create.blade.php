@extends('dashboard')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Manage Carousel</h5>
            @include('partdash.error')
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('carousel.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="gambar_1" class="form-label">Gambar 1</label>
                            <input type="file" name="gambar_1" class="form-control" id="gambar_1"
                                aria-describedby="gambar_1">
                            <br>
                            @isset($carousel->gambar_1)
                                <img style="max-width: 20%" src="{{ asset('storage/' . $carousel->gambar_1) }}">
                            @endisset
                        </div>

                        <div class="mb-3">
                            <label for="gambar_2" class="form-label">Gambar 2</label>
                            <input type="file" name="gambar_2" class="form-control" id="gambar_2"
                                aria-describedby="gambar_2">
                            <br>
                            @isset($carousel->gambar_2)
                                <img style="max-width: 20%" src="{{ asset('storage/' . $carousel->gambar_2) }}">
                            @endisset
                        </div>

                        <div class="mb-3">
                            <label for="gambar_3" class="form-label">Gambar 3</label>
                            <input type="file" name="gambar_3" class="form-control" id="gambar_3"
                                aria-describedby="gambar_3">
                            <br>
                            @isset($carousel->gambar_3)
                                <img style="max-width: 20%" src="{{ asset('storage/' . $carousel->gambar_3) }}">
                            @endisset
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
