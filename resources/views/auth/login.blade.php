<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Planner - Connexion</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            display: flex;
            min-height: 100vh;
            background-color: #f5f5f5;
        }
        
        .container {
            display: flex;
            width: 100%;
        }
        
        .left-panel {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 60px;
            background-color: #f8f9fa;
            background-image: url('https://images.unsplash.com/photo-1511795409834-ef04bbd61622?ixlib=rb-4.0.3&auto=format&fit=crop&w=2069&q=80');
            background-size: cover;
            background-position: center;
            position: relative;
        }
        
        .left-panel::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(108, 99, 255, 0.85);
        }
        
        .left-content {
            position: relative;
            z-index: 1;
            color: white;
            max-width: 500px;
        }
        
        .right-panel {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 60px;
            background-color: white;
        }
        
        .logo {
            color: #6c63ff;
            font-weight: 700;
            font-size: 28px;
            margin-bottom: 10px;
        }
        
        .title {
            font-size: 24px;
            font-weight: 600;
            color: #333;
            margin-bottom: 5px;
        }
        
        .subtitle {
            color: #666;
            margin-bottom: 40px;
            font-size: 16px;
        }
        
        .welcome-text {
            margin-bottom: 50px;
        }
        
        .welcome-text h1 {
            font-size: 42px;
            font-weight: 700;
            color: white;
            margin-bottom: 20px;
            line-height: 1.2;
        }
        
        .welcome-text p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 18px;
            line-height: 1.6;
        }
        
        .event-icon {
            font-size: 48px;
            margin-bottom: 20px;
            color: white;
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #444;
            font-size: 14px;
        }
        
        .form-input {
            width: 100%;
            padding: 14px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s;
        }
        
        .form-input:focus {
            outline: none;
            border-color: #6c63ff;
            box-shadow: 0 0 0 3px rgba(108, 99, 255, 0.1);
        }
        
        .form-input::placeholder {
            color: #aaa;
        }
        
        .btn {
            width: 100%;
            padding: 16px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 10px;
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
        
        .error-message {
            color: #ff3860;
            font-size: 14px;
            margin-top: 5px;
        }
        
        .forgot-password {
            text-align: right;
            margin-bottom: 25px;
        }
        
        .forgot-password a {
            color: #6c63ff;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s;
        }
        
        .forgot-password a:hover {
            text-decoration: underline;
            color: #5a52d5;
        }
        
        .signup-link {
            text-align: center;
            margin-top: 30px;
            color: #666;
            font-size: 15px;
        }
        
        .signup-link a {
            color: #6c63ff;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }
        
        .signup-link a:hover {
            text-decoration: underline;
            color: #5a52d5;
        }
        
        .features-list {
            margin-top: 40px;
            padding-left: 20px;
        }
        
        .features-list li {
            color: white;
            margin-bottom: 15px;
            font-size: 16px;
            list-style-type: none;
            position: relative;
            padding-left: 30px;
        }
        
        .features-list li:before {
            content: "✓";
            position: absolute;
            left: 0;
            color: #4cd964;
            font-weight: bold;
            font-size: 18px;
        }
        
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }
            
            .left-panel, .right-panel {
                padding: 40px 30px;
            }
            
            .left-panel {
                min-height: 400px;
            }
            
            .welcome-text h1 {
                font-size: 32px;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="left-panel">
            <div class="left-content">
                <div class="event-icon">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <div class="welcome-text">
                    <h1>Event Planner</h1>
                    <p>Planifiez vos événements facilement et efficacement avec notre plateforme complète.</p>
                </div>
                
                <ul class="features-list">
                    <li>Créez et gérez vos événements en quelques clics</li>
                    <li>Invitez vos participants simplement</li>
                    <li>Suivez les inscriptions en temps réel</li>
                    <li>Générez des rapports détaillés</li>
                </ul>
            </div>
        </div>
        
        <div class="right-panel">
            <div class="logo">Event Planner</div>
            <div class="title">Se connecter à Event Planner</div>
            <div class="subtitle">Accédez à votre compte pour gérer vos événements</div>
            
            <form method="POST" action="{{ route('toLogin') }}">
                @csrf
                
                <div class="form-group">
                    <label class="form-label" for="email">VOTRE EMAIL</label>
                    <input type="email" name="email" id="email" class="form-input" placeholder="Entrez votre email" value="{{ old('email') }}" required>
                    @error('email') <p class="error-message">{{ $message }}</p> @enderror
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="password">MOT DE PASSE</label>
                    <input type="password" name="password" id="password" class="form-input" placeholder="Entrez votre mot de passe" required>
                    @error('password') <p class="error-message">{{ $message }}</p> @enderror
                </div>
                
                <div class="forgot-password">
                    <a href="#">Mot de passe oublié ?</a>
                </div>
                
                <button type="submit" class="btn btn-primary">Se connecter</button>
                
                <div class="signup-link">
                    Vous n'avez pas de compte ? <a href="{{ route('user.register') }}">S'inscrire</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>