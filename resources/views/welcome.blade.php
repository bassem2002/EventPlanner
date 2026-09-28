<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Planner - Gestion complète d'événements</title>
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
            line-height: 1.6;
        }
        
        /* Header */
        header {
            background-color: white;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }
        
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 5%;
            max-width: 1400px;
            margin: 0 auto;
        }
        
        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 28px;
            font-weight: 700;
            color: #6c63ff;
            text-decoration: none;
        }
        
        .logo i {
            font-size: 32px;
        }
        
        .nav-links {
            display: flex;
            gap: 30px;
            align-items: center;
        }
        
        .nav-links a {
            text-decoration: none;
            color: #555;
            font-weight: 500;
            transition: color 0.3s;
        }
        
        .nav-links a:hover {
            color: #6c63ff;
        }
        
        .btn {
            padding: 12px 28px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
            font-size: 16px;
        }
        
        .btn-outline {
            background-color: transparent;
            color: #6c63ff;
            border: 2px solid #6c63ff;
        }
        
        .btn-outline:hover {
            background-color: #6c63ff;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(108, 99, 255, 0.2);
        }
        
        .btn-primary {
            background-color: #6c63ff;
            color: white;
            border: 2px solid #6c63ff;
        }
        
        .btn-primary:hover {
            background-color: #5a52d5;
            border-color: #5a52d5;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(108, 99, 255, 0.3);
        }
        
        /* Hero Section */
        .hero {
            padding: 150px 5% 100px;
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            gap: 60px;
            margin-top: 80px;
        }
        
        .hero-content {
            flex: 1;
        }
        
        .hero h1 {
            font-size: 48px;
            font-weight: 800;
            color: #333;
            line-height: 1.2;
            margin-bottom: 20px;
        }
        
        .hero h1 span {
            color: #6c63ff;
        }
        
        .hero p {
            font-size: 18px;
            color: #666;
            margin-bottom: 30px;
            max-width: 600px;
        }
        
        .hero-buttons {
            display: flex;
            gap: 20px;
            margin-top: 40px;
        }
        
        .hero-image {
            flex: 1;
            display: flex;
            justify-content: center;
        }
        
        .hero-img {
            width: 100%;
            max-width: 600px;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
        
        /* Features Section */
        .features {
            padding: 100px 5%;
            background-color: white;
        }
        
        .section-title {
            text-align: center;
            font-size: 36px;
            font-weight: 700;
            color: #333;
            margin-bottom: 15px;
        }
        
        .section-subtitle {
            text-align: center;
            color: #666;
            font-size: 18px;
            max-width: 700px;
            margin: 0 auto 60px;
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 40px;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .feature-card {
            background-color: #f8f9fa;
            padding: 40px 30px;
            border-radius: 15px;
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08);
        }
        
        .feature-icon {
            font-size: 50px;
            color: #6c63ff;
            margin-bottom: 25px;
        }
        
        .feature-card h3 {
            font-size: 24px;
            margin-bottom: 15px;
            color: #333;
        }
        
        .feature-card p {
            color: #666;
            font-size: 16px;
        }
        
        /* How It Works */
        .how-it-works {
            padding: 100px 5%;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .steps {
            display: flex;
            justify-content: center;
            gap: 40px;
            margin-top: 60px;
            flex-wrap: wrap;
        }
        
        .step {
            flex: 1;
            min-width: 250px;
            text-align: center;
            padding: 30px;
            position: relative;
        }
        
        .step-number {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
            background-color: #6c63ff;
            color: white;
            font-size: 24px;
            font-weight: 700;
            border-radius: 50%;
            margin-bottom: 25px;
        }
        
        .step h3 {
            font-size: 22px;
            margin-bottom: 15px;
            color: #333;
        }
        
        /* Testimonials */
        .testimonials {
            padding: 100px 5%;
            background-color: #f8f9fa;
        }
        
        .testimonial-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            max-width: 1200px;
            margin: 60px auto 0;
        }
        
        .testimonial-card {
            background-color: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        }
        
        .testimonial-text {
            font-style: italic;
            color: #555;
            margin-bottom: 20px;
            font-size: 16px;
        }
        
        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .author-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #6c63ff;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }
        
        .author-info h4 {
            color: #333;
            margin-bottom: 5px;
        }
        
        .author-info p {
            color: #777;
            font-size: 14px;
        }
        
        /* CTA Section */
        .cta {
            padding: 100px 5%;
            text-align: center;
            background: linear-gradient(135deg, #6c63ff 0%, #8a84ff 100%);
            color: white;
        }
        
        .cta h2 {
            font-size: 42px;
            margin-bottom: 20px;
        }
        
        .cta p {
            font-size: 18px;
            max-width: 700px;
            margin: 0 auto 40px;
            opacity: 0.9;
        }
        
        .cta-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }
        
        .cta .btn-primary {
            background-color: white;
            color: #6c63ff;
        }
        
        .cta .btn-primary:hover {
            background-color: #f8f9fa;
        }
        
        .cta .btn-outline {
            background-color: transparent;
            color: white;
            border: 2px solid white;
        }
        
        .cta .btn-outline:hover {
            background-color: white;
            color: #6c63ff;
        }
        
        /* Footer */
        footer {
            background-color: #333;
            color: white;
            padding: 70px 5% 30px;
        }
        
        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .footer-section h3 {
            font-size: 20px;
            margin-bottom: 25px;
            color: #fff;
        }
        
        .footer-section p, .footer-section a {
            color: #bbb;
            margin-bottom: 12px;
            display: block;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .footer-section a:hover {
            color: #6c63ff;
        }
        
        .social-icons {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }
        
        .social-icons a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            transition: background-color 0.3s;
        }
        
        .social-icons a:hover {
            background-color: #6c63ff;
        }
        
        .copyright {
            text-align: center;
            padding-top: 40px;
            margin-top: 40px;
            border-top: 1px solid #444;
            color: #aaa;
            font-size: 14px;
        }
        
        /* Responsive */
        @media (max-width: 992px) {
            .hero {
                flex-direction: column;
                text-align: center;
                padding-top: 120px;
            }
            
            .hero h1 {
                font-size: 40px;
            }
            
            .hero-buttons {
                justify-content: center;
            }
        }
        
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                gap: 20px;
            }
            
            .nav-links {
                flex-direction: column;
                gap: 15px;
            }
            
            .hero h1 {
                font-size: 32px;
            }
            
            .hero-buttons {
                flex-direction: column;
                align-items: center;
            }
            
            .btn {
                width: 100%;
                max-width: 300px;
            }
            
            .section-title {
                font-size: 30px;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <header>
        <nav class="navbar">
            <a href="#" class="logo">
                <i class="fas fa-calendar-alt"></i>
                Event Planner
            </a>
            <div class="nav-links">
                <a href="#features">Fonctionnalités</a>
                <a href="#how-it-works">Comment ça marche</a>
                <a href="#testimonials">Témoignages</a>
                <a href="{{ route('login') }}" class="btn btn-outline">Connexion</a>
                <a href="{{ route('user.register') }}" class="btn btn-primary">Inscription</a>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Gérez vos <span>événements</span> avec simplicité et efficacité</h1>
            <p>Event Planner est une application web complète qui vous permet de planifier, organiser et suivre tous vos événements en un seul endroit. Créez des événements mémorables sans stress.</p>
            <div class="hero-buttons">
                <a href="{{ route('user.register') }}" class="btn btn-primary">Commencer gratuitement</a>
                <a href="#features" class="btn btn-outline">Découvrir les fonctionnalités</a>
            </div>
        </div>
        <div class="hero-image">
            <img src="https://images.unsplash.com/photo-1559136555-9303baea8ebd?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" alt="Gestion d'événements" class="hero-img">
        </div>
    </section>

    <!-- Features Section -->
    <section class="features" id="features">
        <h2 class="section-title">Fonctionnalités principales</h2>
        <p class="section-subtitle">Découvrez tous les outils dont vous avez besoin pour créer des événements exceptionnels</p>
        
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-calendar-plus"></i>
                </div>
                <h3>Création d'événements</h3>
                <p>Créez des événements personnalisés en quelques minutes avec notre interface intuitive. Ajoutez tous les détails importants.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-users"></i>
                </div>
                <h3>Gestion des invités</h3>
                <p>Invitez vos participants, gérez les RSVP et communiquez facilement avec tous vos invités.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-tasks"></i>
                </div>
                <h3>Checklist et planning</h3>
                <p>Suivez toutes vos tâches avec des checklists interactives et des plannings détaillés.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-chart-bar"></i>
                </div>
                <h3>Analyses et rapports</h3>
                <p>Obtenez des insights détaillés sur vos événements avec des rapports et analyses avancés.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <h3>Gestion budgétaire</h3>
                <p>Contrôlez vos dépenses avec notre outil de gestion budgétaire intégré.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-mobile-alt"></i>
                </div>
                <h3>Application mobile</h3>
                <p>Accédez à vos événements depuis n'importe où avec notre application mobile disponible sur iOS et Android.</p>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="how-it-works" id="how-it-works">
        <h2 class="section-title">Comment ça marche</h2>
        <p class="section-subtitle">Découvrez en 3 étapes simples comment Event Planner peut transformer votre gestion d'événements</p>
        
        <div class="steps">
            <div class="step">
                <div class="step-number">1</div>
                <h3>Créez votre compte</h3>
                <p>Inscrivez-vous gratuitement en moins de 2 minutes. Aucune information de carte bancaire requise.</p>
            </div>
            
            <div class="step">
                <div class="step-number">2</div>
                <h3>Planifiez votre événement</h3>
                <p>Utilisez nos modèles prédéfinis ou créez un événement personnalisé avec tous les détails nécessaires.</p>
            </div>
            
            <div class="step">
                <div class="step-number">3</div>
                <h3>Gérez et partagez</h3>
                <p>Invitez vos participants, suivez les inscriptions et partagez les informations importantes facilement.</p>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials" id="testimonials">
        <h2 class="section-title">Ce que nos utilisateurs disent</h2>
        <p class="section-subtitle">Découvrez les témoignages de nos utilisateurs satisfaits</p>
        
        <div class="testimonial-grid">
            <div class="testimonial-card">
                <div class="testimonial-text">
                    "Event Planner a révolutionné la façon dont nous organisons nos conférences annuelles. Tout est tellement plus simple et efficace maintenant !"
                </div>
                <div class="testimonial-author">
                    <div class="author-avatar">MS</div>
                    <div class="author-info">
                        <h4>Marie Sanchez</h4>
                        <p>Responsable événementiel, TechCon Paris</p>
                    </div>
                </div>
            </div>
            
            <div class="testimonial-card">
                <div class="testimonial-text">
                    "En tant que wedding planner, cet outil est indispensable pour moi. Je peux gérer plusieurs mariages en même temps sans perdre le fil."
                </div>
                <div class="testimonial-author">
                    <div class="author-avatar">JD</div>
                    <div class="author-info">
                        <h4>Julien Dubois</h4>
                        <p>Wedding Planner, Événements d'exception</p>
                    </div>
                </div>
            </div>
            
            <div class="testimonial-card">
                <div class="testimonial-text">
                    "La fonction de gestion budgétaire m'a permis de réduire mes coûts de 15% tout en améliorant la qualité de mes événements. Je recommande !"
                </div>
                <div class="testimonial-author">
                    <div class="author-avatar">AB</div>
                    <div class="author-info">
                        <h4>Anna Bertrand</h4>
                        <p>Organisatrice d'événements d'entreprise</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <h2>Prêt à révolutionner votre gestion d'événements ?</h2>
        <p>Rejoignez plus de 10 000 organisateurs d'événements qui utilisent déjà Event Planner pour créer des expériences mémorables.</p>
        <div class="cta-buttons">
            <a href="{{ route('user.register') }}" class="btn btn-primary">Commencer gratuitement</a>
            <a href="{{ route('login') }}" class="btn btn-outline">Se connecter</a>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h3>Event Planner</h3>
                <p>L'application web complète pour la gestion d'événements. Simplifiez votre organisation et créez des moments inoubliables.</p>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            
            <div class="footer-section">
                <h3>Liens rapides</h3>
                <a href="#features">Fonctionnalités</a>
                <a href="#how-it-works">Comment ça marche</a>
                <a href="#testimonials">Témoignages</a>
                <a href="{{ route('login') }}">Connexion</a>
                <a href="{{ route('user.register') }}">Inscription</a>
            </div>
            
            <div class="footer-section">
                <h3>Contact</h3>
                <p><i class="fas fa-envelope"></i> contact@eventplanner.com</p>
                <p><i class="fas fa-phone"></i> +33 1 23 45 67 89</p>
                <p><i class="fas fa-map-marker-alt"></i> 123 Rue de l'Événement, 75000 Paris</p>
            </div>
        </div>
        
        <div class="copyright">
            <p>&copy; 2023 Event Planner. Tous droits réservés.</p>
        </div>
    </footer>

    <script>
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('href');
                if(targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                if(targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            });
        });
        
        // Header background on scroll
        window.addEventListener('scroll', function() {
            const header = document.querySelector('header');
            if (window.scrollY > 50) {
                header.style.boxShadow = '0 5px 20px rgba(0, 0, 0, 0.1)';
            } else {
                header.style.boxShadow = '0 2px 15px rgba(0, 0, 0, 0.1)';
            }
        });
    </script>
</body>
</html>