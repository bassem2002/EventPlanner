<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Event Planner</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f8f9fa;
            color: #333;
        }
        
        /* Header */
        .admin-header {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 0 30px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
        }
        
        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 24px;
            font-weight: 700;
            color: #6c63ff;
            text-decoration: none;
        }
        
        .logo i {
            font-size: 28px;
        }
        
        .nav-links {
            display: flex;
            align-items: center;
            gap: 30px;
        }
        
        .nav-link {
            text-decoration: none;
            color: #555;
            font-weight: 500;
            padding: 8px 16px;
            border-radius: 6px;
            transition: all 0.3s;
        }
        
        .nav-link:hover {
            background-color: #f0f0f0;
            color: #6c63ff;
        }
        
        .nav-link.active {
            background-color: #6c63ff;
            color: white;
        }
        
        .user-profile {
            display: flex;
            align-items: center;
            gap: 15px;
            background-color: #f8f9fa;
            padding: 8px 20px;
            border-radius: 30px;
            border: 1px solid #e0e0e0;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .user-profile:hover {
            background-color: #f0f0f0;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        
        .user-avatar {
            width: 36px;
            height: 36px;
            background-color: #6c63ff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 16px;
        }
        
        .user-info {
            display: flex;
            flex-direction: column;
        }
        
        .user-name {
            font-weight: 600;
            font-size: 14px;
            color: #333;
        }
        
        .user-email {
            font-size: 12px;
            color: #777;
        }

        /* Dropdown Menu */
        .dropdown-menu {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: white;
            min-width: 200px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
            border-radius: 8px;
            top: 100%;
            margin-top: 10px;
        }

        .dropdown-content a,
        .dropdown-content button {
            color: #555;
            padding: 12px 16px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
            border: none;
            background: none;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s;
        }

        .dropdown-content a:hover,
        .dropdown-content button:hover {
            background-color: #f0f0f0;
            color: #6c63ff;
        }

        .dropdown-content a:first-child {
            border-radius: 8px 8px 0 0;
        }

        .dropdown-content a:last-child,
        .dropdown-content button:last-child {
            border-radius: 0 0 8px 8px;
        }

        .dropdown-content button.logout-btn {
            color: #dc3545;
        }

        .dropdown-content button.logout-btn:hover {
            background-color: #ffe5e5;
            color: #c82333;
        }

        .dropdown-menu:hover .dropdown-content {
            display: block;
        }
        

        .admin-main {
            margin-top: 70px;
            padding: 30px;
            min-height: calc(100vh - 70px);
        }
        
        /* Content Container */
        .content-container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .content-card {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            padding: 40px;
            margin-bottom: 30px;
        }
        
        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }
        
        .content-title {
            font-size: 28px;
            font-weight: 700;
            color: #333;
        }
        
        /* Form Styles */
        .form-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
        }
        
        .form-section {
            background-color: #f8f9fa;
            padding: 25px;
            border-radius: 10px;
            border: 1px solid #eaeaea;
        }
        
        .form-section-title {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #6c63ff;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #444;
            font-size: 14px;
        }
        
        .form-label span {
            color: #ff3860;
        }
        
        .form-input, .form-select, .form-textarea {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s, box-shadow 0.3s;
            background-color: white;
        }
        
        .form-textarea {
            min-height: 120px;
            resize: vertical;
        }
        
        .form-input:focus, .form-select:focus, .form-textarea:focus {
            outline: none;
            border-color: #6c63ff;
            box-shadow: 0 0 0 3px rgba(108, 99, 255, 0.1);
        }
        
        .form-input::placeholder {
            color: #aaa;
        }
        
        /* Date Range Container */
        .date-range-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        
        /* Checkbox Group */
        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .checkbox-label {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            font-weight: 500;
            color: #444;
        }
        
        .checkbox-custom {
            width: 20px;
            height: 20px;
            border: 2px solid #ddd;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }
        
        .checkbox-input:checked + .checkbox-custom {
            background-color: #6c63ff;
            border-color: #6c63ff;
        }
        
        .checkbox-input:checked + .checkbox-custom::after {
            content: "✓";
            color: white;
            font-weight: bold;
            font-size: 14px;
        }
        
        .checkbox-input {
            display: none;
        }
        
        /* Price Container */
        .price-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        
        /* Buttons */
        .form-buttons {
            grid-column: 1 / -1;
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 30px;
            padding-top: 30px;
            border-top: 1px solid #eee;
        }
        
        .btn {
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn-primary {
            background-color: #6c63ff;
            color: white;
        }
        
        .btn-primary:hover {
            background-color: #5a52d5;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(108, 99, 255, 0.3);
        }
        
        .btn-secondary {
            background-color: #f1f1f1;
            color: #333;
            text-decoration: none;
        }
        
        .btn-secondary:hover {
            background-color: #e1e1e1;
            transform: translateY(-2px);
        }
        
        /* Responsive */
        @media (max-width: 992px) {
            .form-container {
                grid-template-columns: 1fr;
            }
            
            .nav-links {
                gap: 15px;
            }
        }
        
        @media (max-width: 768px) {
            .admin-header {
                padding: 0 15px;
                height: 60px;
            }
            
            .admin-main {
                padding: 20px;
                margin-top: 60px;
            }
            
            .content-card {
                padding: 25px;
            }
            
            .nav-links {
                gap: 10px;
            }
            
            .nav-link {
                padding: 6px 12px;
                font-size: 14px;
            }
            
            .user-profile {
                padding: 6px 12px;
            }
            
            .user-name {
                display: none;
            }
            
            .date-range-container,
            .price-container {
                grid-template-columns: 1fr;
            }
        }
        
        @media (max-width: 576px) {
            .form-buttons {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @stack('styles')

</head>
@stack('scripts')

<body>
    <!-- Header -->
    <header class="admin-header">
        <a href="{{ route('admin.categories.index') }}" class="logo">
            <i class="fas fa-calendar-alt"></i>
            Event Planner
        </a>
        
        <div class="nav-links">
            </a>
                        <a href="{{ route('admin.users.index') }}" class="nav-link {{ Request::is('admin/users*') ? 'active' : '' }}">
                <i class="fas fa-users"></i>
                Utilisateurs
            </a>
            <a href="{{ route('admin.categories.index') }}" class="nav-link {{ Request::is('admin/categories*') ? 'active' : '' }}">
                <i class="fas fa-tags"></i>
                Catégories
            </a>
            <a href="{{ route('admin.events.index') }}" class="nav-link {{ Request::is('admin/events*') ? 'active' : '' }}">
                <i class="fas fa-calendar"></i>
                Événements
            </a>
                        <a href="{{ route('admin.users.registrations.index') }}" class="nav-link {{ Request::is('admin/users/registrations*') ? 'active' : '' }}">
                <i class="fas fa-users"></i>
                Registrations
            </a>

            
            <div class="dropdown-menu">
                <div class="user-profile">
                    <div class="user-avatar">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="user-info">
                        <span class="user-name">{{ Auth::user()->name }}</span>
                        <span class="user-email">{{ Auth::user()->email }}</span>
                    </div>
                </div>

                <div class="dropdown-content">
                    <a href="#">
                        <i class="fas fa-user"></i> Mon Profil
                    </a>
                    <a href="#">
                        <i class="fas fa-cog"></i> Paramètres
                    </a>
                    <hr style="margin: 5px 0; border: none; border-top: 1px solid #eee;">
                    <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                        @csrf
                        <button type="submit" class="logout-btn">
                            <i class="fas fa-sign-out-alt"></i> Déconnexion
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="admin-main">
        <div class="content-container">
            @yield('content')
        </div>
    </main>

 @stack('scripts')

</body>
</html>