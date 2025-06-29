<!-- Required Js -->
<script src="{{ asset('dash/assets/js/plugins/simplebar.min.js') }}"></script>
<script src="{{ asset('dash/assets/js/plugins/popper.min.js') }}"></script>
<script src="{{ asset('dash/assets/js/icon/custom-icon.js') }}"></script>
<script src="{{ asset('dash/assets/js/plugins/feather.min.js') }}"></script>
<script src="{{ asset('dash/assets/js/component.js') }}"></script>
<script src="{{ asset('dash/assets/js/theme.js') }}"></script>
<script src="{{ asset('dash/assets/js/script.js') }}"></script>

<script>
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function() {
            const url = this.dataset.url;
            const message = this.dataset.message || 'Apakah Anda yakin ingin menghapus data ini?';

            document.getElementById('modal-delete-form').setAttribute('action', url);
            document.getElementById('modal-delete-message').textContent = message;

            document.getElementById('modal-delete-global').showModal();
        });
    });

    function hideAlert(alertId) {
        const alert = document.getElementById(alertId);
        if (alert) {
            alert.classList.remove('animate-fade-in');
            alert.classList.add('animate-fade-out');
            setTimeout(() => {
                alert.remove();
            }, 500);
        }
    }

    if (document.getElementById('success-alert')) {
        setTimeout(() => hideAlert('success-alert'), 5000);
    }

    if (document.getElementById('error-alert')) {
        setTimeout(() => hideAlert('error-alert'), 5000);
    }
</script>

<div class="floting-button fixed bottom-[50px] right-[30px] z-[1030]">
</div>

<script>
    layout_change('false');
</script>

<script>
    layout_theme_sidebar_change('dark');
</script>

<script>
    change_box_container('false');
</script>

<script>
    layout_caption_change('true');
</script>

<script>
    layout_rtl_change('false');
</script>

<script>
    preset_change('preset-1');
</script>

<script>
    main_layout_change('vertical');
</script>
