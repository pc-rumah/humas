{{-- <dialog id="modal-delete-global" class="modal modal-bottom sm:modal-middle">
    <div class="modal-box bg-white dark:bg-gray-800 p-6 rounded-lg shadow-xl">
        <h3 class="font-bold text-lg text-gray-800 dark:text-gray-100 mb-4">Konfirmasi Hapus</h3>
        <p id="modal-delete-message" class="py-4 text-gray-600 dark:text-gray-300">Apakah Anda yakin ingin menghapus data
            ini?</p>
        <div class="modal-action flex justify-end gap-4 mt-6">
            <form id="modal-delete-form" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="btn btn-danger bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-md transition duration-200">Ya,
                    Hapus</button>
            </form>
            <button type="button"
                class="btn bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium py-2 px-4 rounded-md transition duration-200"
                onclick="document.getElementById('modal-delete-global').close()">Batal</button>
        </div>
    </div>
</dialog> --}}

<div class="modal fade" id="alert-hapus" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteLabel">
                    Konfirmasi Hapus
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus data ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="form-delete" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
