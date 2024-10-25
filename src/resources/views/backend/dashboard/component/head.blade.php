<base href="{{ env('APP_URL') }}">
<title>{{ env('APP_NAME') }}</title>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">

<meta content="" name="description">
<meta content="" name="keywords">

<!-- Favicons -->
<link href="{{ asset('backend/img/logo.png') }}" rel="icon">

<!-- Google Fonts -->
<link href="https://fonts.gstatic.com" rel="preconnect">
<link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">

<!-- Vendor CSS Files -->
@if (isset($config['css']) && is_array($config['css']))
    @foreach ($config['css'] as $key => $val)
        {!! '<link href="' . asset($val) . '?v=' . time() . '" rel="stylesheet"></link>' !!}
    @endforeach
@endif
<link href="{{ asset('backend/vendor/bootstrap/css/bootstrap.min.css') }}?v={{ time() }}" rel="stylesheet">
<link href="{{ asset('backend/vendor/bootstrap-icons/bootstrap-icons.css') }}?v={{ time() }}" rel="stylesheet">
<link href="{{ asset('backend/vendor/select2/css/select2.min.css') }}?v={{ time() }}" rel="stylesheet">
<link href="{{ asset('backend/vendor/select2/css/select2-bootstrap-5-theme.min.css') }}?v={{ time() }}"
    rel="stylesheet">

<!-- Template Main CSS File -->
<link href="{{ asset('backend/css/style.css') }}?v={{ time() }}" rel="stylesheet">
<link href="{{ asset('backend/css/custom.css') }}?v={{ time() }}" rel="stylesheet">
