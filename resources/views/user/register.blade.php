<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Planner - Inscription</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        html, body {
            height: 100%;
            overflow: hidden; /* Désactive tout défilement */
        }
        
        body {
            display: flex;
            background-color: #f5f5f5;
        }
        
        .container {
            display: flex;
            width: 100%;
            height: 100vh; /* Prend toute la hauteur de la vue */
        }
        
        .left-panel {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 40px;
            background-color: #f8f9fa;
            background-image: url('https://images.unsplash.com/photo-1545235617-9465d2a55698?ixlib=rb-4.0.3&auto=format&fit=crop&w=2080&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed; /* Fixe l'image de fond */
            position: relative;
            overflow: hidden; /* Empêche l'overflow dans ce panneau */
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
            overflow-y: auto; /* Permet le défilement seulement dans le contenu si nécessaire */
            max-height: 90vh; /* Limite la hauteur du contenu */
            padding-right: 10px; /* Espace pour la barre de défilement */
        }
        
        /* Cache la barre de défilement pour un look plus propre */
        .left-content::-webkit-scrollbar {
            width: 5px;
        }
        
        .left-content::-webkit-scrollbar-track {
            background: transparent;
        }
        
        .left-content::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 10px;
        }
        
        .right-panel {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 40px;
            background-color: white;
            overflow-y: auto; /* Permet le défilement seulement dans ce panneau si nécessaire */
            max-height: 100vh; /* Limite la hauteur */
        }
        
        /* Cache la barre de défilement pour un look plus propre */
        .right-panel::-webkit-scrollbar {
            width: 5px;
        }
        
        .right-panel::-webkit-scrollbar-track {
            background: transparent;
        }
        
        .right-panel::-webkit-scrollbar-thumb {
            background: rgba(108, 99, 255, 0.3);
            border-radius: 10px;
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
            margin-bottom: 30px;
            font-size: 16px;
        }
        
        .welcome-text {
            margin-bottom: 30px;
        }
        
        .welcome-text h1 {
            font-size: 36px;
            font-weight: 700;
            color: white;
            margin-bottom: 15px;
            line-height: 1.2;
        }
        
        .welcome-text p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 16px;
            line-height: 1.6;
        }
        
        .event-icon {
            font-size: 40px;
            margin-bottom: 15px;
            color: white;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-label {
            display: block;
            margin-bottom: 6px;
            font-weight: 500;
            color: #444;
            font-size: 14px;
        }
        
        .form-input {
            width: 100%;
            padding: 12px;
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
            padding: 14px;
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
            font-size: 12px;
            margin-top: 4px;
        }
        
        .login-link {
            text-align: center;
            margin-top: 25px;
            color: #666;
            font-size: 14px;
        }
        
        .login-link a {
            color: #6c63ff;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }
        
        .login-link a:hover {
            text-decoration: underline;
            color: #5a52d5;
        }
        
        .features-list {
            margin-top: 25px;
            padding-left: 15px;
        }
        
        .features-list li {
            color: white;
            margin-bottom: 10px;
            font-size: 14px;
            list-style-type: none;
            position: relative;
            padding-left: 25px;
        }
        
        .features-list li:before {
            content: "✓";
            position: absolute;
            left: 0;
            color: #4cd964;
            font-weight: bold;
            font-size: 16px;
        }
        
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                height: auto;
                min-height: 100vh;
                overflow-y: auto; /* Permet le défilement vertical sur mobile */
            }
            
            .left-panel, .right-panel {
                padding: 30px 20px;
                min-height: auto;
                overflow: visible;
            }
            
            .left-panel {
                min-height: 40vh;
            }
            
            .right-panel {
                min-height: 60vh;
            }
            
            .welcome-text h1 {
                font-size: 28px;
            }
            
            .left-content, .right-panel {
                overflow: visible;
                max-height: none;
            }
            
            html, body {
                overflow: auto; /* Réactive le défilement sur mobile */
                height: auto;
            }
        }
        
        @media (max-height: 700px) {
            .left-panel, .right-panel {
                padding: 20px;
            }
            
            .welcome-text h1 {
                font-size: 28px;
            }
            
            .title {
                font-size: 20px;
            }
            
            .form-group {
                margin-bottom: 15px;
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
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div class="welcome-text">
                    <h1>Bienvenue</h1>
                    <p>Pour rester connecté avec nous, vous avez choisi de saisir vos informations.</p>
                </div>
                
                <ul class="features-list">
                    <li>Créez des événements personnalisés</li>
                    <li>Gérez les invitations et RSVP</li>
                    <li>Suivez les budgets en temps réel</li>
                    <li>Partagez des photos et souvenirs</li>
                </ul>
            </div>
        </div>
        
        <div class="right-panel">
            <div class="logo">Event Planner</div>
            <div class="title">S'inscrire sur Event Planner</div>
            <div class="subtitle">Créez votre compte pour commencer à planifier vos événements</div>
            
            <form method="POST" action="{{ route('user.store') }}">
                @csrf
                
                <div class="form-group">
                    <label class="form-label" for="name">VOTRE NOM</label>
                    <input type="text" name="name" id="name" class="form-input" placeholder="Entrez votre nom" value="{{ old('name') }}" required>
                    @error('name') <p class="error-message">{{ $message }}</p> @enderror
                </div>
                
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
                
                <div class="form-group">
                    <label class="form-label" for="password_confirmation">CONFIRMER LE MOT DE PASSE</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-input" placeholder="Entrez votre mot de passe" required>
                </div>
                
                <button type="submit" class="btn btn-primary">S'inscrire</button>
                
                <div class="login-link">
                    Vous avez déjà un compte ? <a href="{{ route('login') }}">Se connecter</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>