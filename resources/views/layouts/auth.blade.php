<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>@yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    @vite([
        'resources/css/style.css',
        'resources/js/app.js'
    ])

</head>

<body>

   <nav class="auth-navbar">
    <div class="container d-flex justify-content-between align-items-center w-100">
        
        <a href="/" class="auth-logo text-decoration-none">
            TRAKIO
        </a>

        <a href="{{ $back_url ?? url('/') }}" class="btn btn-outline-primary">
            {{ $back_text ?? 'Back To Home' }}
        </a>

    </div>
</nav>

    @yield('content')

</body>

</html>