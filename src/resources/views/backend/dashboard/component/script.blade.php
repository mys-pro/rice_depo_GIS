<!-- Vendor JS Files -->
<script src="{{ asset('backend/vendor/jquery/jquery.min.js') }}?v={{ time() }}"></script>
@if (isset($config['js']) && is_array($config['js']))
    @foreach ($config['js'] as $key => $val)
        {!! '<script src="' . asset($val) . '?v=' . time() . '"></script>' !!}
    @endforeach
@endif
<script src="{{ asset('backend/vendor/chart.js/chart.umd.js') }}?v={{ time() }}"></script>
<script src="{{ asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}?v={{ time() }}"></script>
<script src="{{ asset('backend/vendor/select2/js/select2.min.js') }}?v={{ time() }}"></script>
<script src="{{ asset('backend/vendor/tinymce/tinymce.min.js') }}?v={{ time() }}"></script>

<!-- Template Main JS File -->
<script src="{{ asset('backend/js/main.js') }}?v={{ time() }}"></script>
<script src="{{ asset('backend/library/library.js') }}?v={{ time() }}"></script>
<script src="{{ asset('backend/library/custom.js') }}?v={{ time() }}"></script>
