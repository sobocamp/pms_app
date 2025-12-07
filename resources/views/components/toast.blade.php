@php
    $toast = session('toast');
@endphp

@if($toast)
<div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1080;">
    <div id="globalToast" class="toast align-items-center text-bg-{{ $toast['type'] === 'error' ? 'danger' : ($toast['type'] === 'info' ? 'info' : 'success') }} border-0 shadow"
         role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body d-flex align-items-center">
                @if($toast['type'] === 'success')
                    <i data-feather="check-circle" class="me-2"></i>
                @elseif($toast['type'] === 'error')
                    <i data-feather="x-circle" class="me-2"></i>
                @else
                    <i data-feather="info" class="me-2"></i>
                @endif

                <div class="me-2">{!! $toast['message'] !!}</div>
            </div>
            <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function() {
    // pastikan feather ter-replace
    if (window.feather) { feather.replace(); }

    var el = document.getElementById('globalToast');
    if (el) {
        var toast = new bootstrap.Toast(el, { delay: 2000 });
        toast.show();
    }
});
</script>
@endpush
@endif
