<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Event Planner')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #6c63ff;
            --primary-dark: #5a52d5;
            --secondary-color: #f0f0f0;
            --text-dark: #333;
            --text-muted: #666;
            --border-color: #e0e0e0;
        }

        body {
            background-color: #fafafa;
            color: var(--text-dark);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Navigation Bar */
        .navbar {
            background: white !important;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            padding: 1rem 0;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary-color) !important;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .navbar-brand i {
            font-size: 1.8rem;
        }

        .nav-link {
            color: var(--text-dark) !important;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            transition: all 0.3s ease;
            margin: 0 0.25rem;
        }

        .nav-link:hover {
            color: var(--primary-color) !important;
            background-color: var(--secondary-color);
            border-radius: 6px;
        }

        .nav-link.active {
            color: var(--primary-color) !important;
            border-bottom: 3px solid var(--primary-color);
        }

        /* Dropdown */
        .dropdown-menu {
            border: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .dropdown-item:hover {
            background-color: var(--secondary-color);
            color: var(--primary-color);
        }

        /* Logout Button */
        .logout-btn {
            background-color: var(--primary-color);
            color: white !important;
            border: none;
            padding: 0.5rem 1.5rem !important;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .logout-btn:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(108, 99, 255, 0.3);
        }

        /* Main Content */
        main {
            min-height: calc(100vh - 200px);
            padding-top: 2rem;
            padding-bottom: 2rem;
        }

        /* Footer */
        footer {
            background-color: var(--text-dark);
            color: white;
            margin-top: 3rem;
            padding: 2rem 0;
        }

        footer a {
            color: var(--primary-color);
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        /* Alerts & Messages */
        .alert {
            border: none;
            border-radius: 8px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }

        .alert-warning {
            background-color: #fff3cd;
            color: #856404;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1.3rem;
            }

            .nav-link {
                padding: 0.75rem 0 !important;
            }
        }
    </style>
</head>
<body>

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <!-- Brand -->
        <a class="navbar-brand" href="{{ route('user.home') ?? '/' }}">
            <i class="bi bi-calendar-event"></i>
            Event Planner
        </a>

        <!-- Toggle Button (Mobile) -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <!-- Home Link -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.home') ?? '/' }}">
                        <i class="bi bi-house"></i> Accueil
                    </a>
                </li>

                @auth
                    <!-- Categories Link -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.categories.index') }}">
                            <i class="bi bi-tag"></i> Catégories
                        </a>
                    </li>

                    <!-- Events Link -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.events.index') }}">
                            <i class="bi bi-calendar-check"></i> Événements
                        </a>
                    </li>

                    <!-- User Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="bi bi-person"></i> Mon Profil
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="bi bi-ticket"></i> Mes Inscriptions
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right"></i> Déconnexion
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth

                @guest
                    <!-- Guest Links -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="bi bi-box-arrow-in-right"></i> Connexion
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.register') }}">
                            <i class="bi bi-person-plus"></i> Inscription
                        </a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<!-- Messages/Alerts -->
<div class="container mt-4">
    @if($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle"></i> {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-circle"></i> Une erreur s'est produite
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
</div>

<!-- Main Content -->
<main class="container">
    @yield('content')
</main>

<!-- Footer -->
<footer class="mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mb-3">
                <h5 class="mb-3">
                    <i class="bi bi-calendar-event"></i> Event Planner
                </h5>
                <p class="text-muted">Découvrez et participez aux meilleurs événements de votre région.</p>
            </div>
            <div class="col-md-3 mb-3">
                <h6 class="mb-3">Navigation</h6>
                <ul class="list-unstyled">
                    <li><a href="{{ route('user.home') ?? '/' }}">Accueil</a></li>
                    @auth
                        <li><a href="{{ route('user.events.index') }}">Événements</a></li>
                        <li><a href="{{ route('user.categories.index') }}">Catégories</a></li>
                    @endauth
                </ul>
            </div>
            <div class="col-md-3 mb-3">
                <h6 class="mb-3">Informations</h6>
                <ul class="list-unstyled">
                    <li><a href="#">À propos</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="#">Conditions</a></li>
                </ul>
            </div>
        </div>
        <hr class="my-3" style="border-color: rgba(255, 255, 255, 0.1);">
        <div class="text-center text-muted">
            <p>&copy; 2026 Event Planner. Tous droits réservés.</p>
        </div>
    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
