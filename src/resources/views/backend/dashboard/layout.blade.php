<!DOCTYPE html>
<html lang="en">

<head>
    @include('backend.dashboard.component.head')
</head>

<body>
    @if (isset($main) && $main == 'home')
        @include('backend.dashboard.home.index')
    @else
        @include('backend.dashboard.component.nav')
        @include('backend.dashboard.component.sidebar')

        <main id="main" class="main">
            @include($template)
        </main><!-- End #main -->

        @include('backend.dashboard.component.footer')
        @include('backend.dashboard.component.script')
    @endif
</body>

</html>
