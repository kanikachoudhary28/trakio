<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
   @vite(['resources/css/style.css','resources/js/script.js'])

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>

@include('partials.teacher-sidebar')

<div class="main-wrapper">

    @include('partials.navbar')

    <div class="content-wrapper">

        @yield('content')

    </div>

    @include('partials.footer')

</div>

</body>
</html>