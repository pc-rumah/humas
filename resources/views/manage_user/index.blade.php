@extends('dashboard')

@section('content')
    <div class="card w-100">
        <div class="card-body p-4">
            <a class="btn btn-primary m-1" href="{{ route('muser.create') }}">Tambah User</a>
            @include('partdash.alert')
            <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">#</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Nama</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Email</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Aksi</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($user->isEmpty())
                            <td class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Kategori Belum Ada</h6>
                            </td>
                        @else
                            @foreach ($user as $item)
                                <tr>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">{{ $user->firstItem() + $loop->index }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-1">{{ $item->name }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-1">{{ $item->email }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-url="{{ route('muser.destroy', $item->id) }}"
                                            data-bs-target="#alert-hapus">Hapus</button>
                                        @include('partdash.modal')
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                    {{ $user->links() }}
                </table>
            </div>
        </div>
    </div>
@endsection
