<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'EventPlaner')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="/">EventPlaner</a>
            <div class="navbar-nav ms-auto">
                @auth
                    Bienvenue {{ Auth::user()->name }}
                    <form class="d-flex" method="POST" action="{{ route('logout') }}">
                        @csrf
                        @method('DELETE')
                        <button class="nav-link btn" type="submit">Logout</button>
                    </form>
                @else
                    <a class="btn btn-outline-secondary" href="{{ route('login') }}">Login</a>
                @endauth
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>