<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('Public.layouts.head')
</head>
<body>
<div class="page">
    @include('public.layouts.head')
    <main>
        @yield('content')
    </main>
    @include('Public.layouts.footer')
    @include('Public.layouts.scripts')
    <x-alert />
</div>
</body>
</html>
