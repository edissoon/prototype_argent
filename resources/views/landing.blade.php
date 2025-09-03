<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Argent - Giving to Glory</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #22577A;
            --accent: #38A3A5;
            --mint: #57CC99;
            --light-green: #80ED99;
            --pale-green: #C7F9CC;
            --error: #b00020;
            --light-red: #ffe0e0;
            --pink: #ffb3b3;
            --success-bg: #c7f9cc;
            --success-text: #2f855a;
            --info-bg: #e6fffa;
            --info-border: #81e6d9;
            --info-text: #2c7a7b;
            --info-icon: #4fd1c7;
            --input-bg: #f8fafc;
            --white: #ffffff;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: var(--primary);
            scroll-behavior: smooth;
        }

        /* Navigation */
        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 1rem 0;
            z-index: 1000;
            transition: all 0.3s ease;
            box-shadow: 0 2px 20px rgba(34, 87, 122, 0.1);
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 2rem;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: bold;
            color: var(--primary);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .logo:hover {
            color: var(--accent);
        }

        .nav-links {
            display: flex;
            list-style: none;
            gap: 2rem;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--primary);
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-links a:hover {
            color: var(--accent);
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--mint);
            transition: width 0.3s ease;
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        .login-btn {
            background: var(--accent) !important;
            color: white !important;
            padding: 0.75rem 2rem !important;
            border-radius: 25px !important;
            border: none !important;
            font-weight: 600 !important;
            font-size: 1rem !important;
            letter-spacing: 0.5px !important;
            cursor: pointer !important;
            box-shadow: 0 4px 15px rgba(56, 163, 165, 0.25), 
                        0 2px 8px rgba(56, 163, 165, 0.15) !important;
            transition: all 0.3s ease !important;
            transform: translateY(0) !important;
        }

        .login-btn:hover {
            background: var(--primary) !important;
            transform: translateY(-2px) !important;
            box-shadow: 0 8px 25px rgba(34, 87, 122, 0.3), 
                        0 4px 12px rgba(34, 87, 122, 0.2) !important;
        }

        .login-btn:active {
            transform: translateY(-1px) !important;
            box-shadow: 0 4px 12px rgba(34, 87, 122, 0.2) !important;
        }

        .login-btn:focus {
            outline: none !important;
            box-shadow: 0 4px 15px rgba(56, 163, 165, 0.25), 
                        0 2px 8px rgba(56, 163, 165, 0.15),
                        0 0 0 3px rgba(56, 163, 165, 0.3) !important;
        }

        .login-btn::after {
            display: none !important;
        }

        /* Hero Section */
              .hero {
            height: 100vh;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        /* Background slideshow container */
        .hero-bg-slideshow {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 1;
        }

        /* Individual background slides */
        .hero-bg-slide {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            opacity: 0;
            transition: opacity 1s ease-in-out;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .hero-bg-slide.active {
            opacity: 0.3;
        }

        /* Simulated giving-related backgrounds using CSS */
        .hero-bg-slide:nth-child(1) {
            background-image: url('img/giving1.jpg');
            filter: grayscale(70%) contrast(1.2);
       }

        .hero-bg-slide:nth-child(2) {
            background-image: url('img/giving2.jpg');
            filter: grayscale(70%) contrast(1.2);
        }

        .hero-bg-slide:nth-child(3) {
            background-image: url('img/giving3.jpg');
            filter: grayscale(70%) contrast(1.2);
        }

        .hero-bg-slide:nth-child(4) {
            background-image: url('img/giving5.jpg');
            filter: grayscale(70%) contrast(1.2);
        }

        .hero-bg-slide:nth-child(5) {
            background-image: url('img/giving4.jpg');
            filter: grayscale(70%) contrast(1.2);
        }

        /* Overlay to ensure readability */
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.4);
            z-index: 2;
        }

        .hero-content {
            text-align: center;
            color: white;
            z-index: 3;
            max-width: 800px;
            padding: 0 2rem;
            animation: fadeInUp 1s ease-out;
            position: relative;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero h1 {
            font-size: 3.5rem;
            margin-bottom: 1rem;
            font-weight: 700;
            line-height: 1.2;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .hero .bible-verse {
            font-size: 1.3rem;
            font-style: italic;
            margin-bottom: 0.5rem;
            opacity: 0.95;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }

        .hero .verse-reference {
            font-size: 1rem;
            opacity: 0.9;
            margin-bottom: 2rem;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }

        .cta-button {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: white;
            padding: 1rem 2rem;
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            text-shadow: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .cta-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }
            
            .hero .bible-verse {
                font-size: 1.1rem;
            }
            
            .hero-content {
                padding: 0 1rem;
            }
        }

        .cta-button {
            display: inline-block;
            background: var(--mint);
            color: var(--primary);
            padding: 1rem 2.5rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(87, 204, 153, 0.3);
        }

        .cta-button:hover {
            background: var(--light-green);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(87, 204, 153, 0.4);
        }

        /* About Section */
        .about {
            padding: 5rem 0;
            background: var(--white);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 3rem;
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            border-radius: 2px;
        }

        .about-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: start;
        }

        .about-card {
            background: var(--input-bg);
            padding: 2.5rem;    
            border-radius: 15px;
            border: 2px solid var(--pale-green);
            transition: all 0.3s ease;
            height: 100%;
        }

        .about-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(34, 87, 122, 0.1);
            border-color: var(--mint);
        }

        .about-card h3 {
            color: var(--primary);
            font-size: 1.5rem;
            margin-bottom: 1rem;
            border-bottom: 2px solid var(--mint);
            padding-bottom: 0.5rem;
        }

        .about-card p {
            color: var(--info-text);
            margin-bottom: 1.5rem;
            line-height: 1.7;
        }

        .mission-vision {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .mv-item {
            background: var(--white);
            padding: 1.5rem;
            border-radius: 10px;
            border-left: 4px solid var(--accent);
        }

        .mv-item h4 {
            color: var(--primary);
            margin-bottom: 0.5rem;
            font-size: 1.1rem;
        }

        /* Current Project Part */
        .projects-section {
            background: linear-gradient(135deg, var(--pale-green) 0%, var(--info-bg) 100%);
            padding: 60px 20px;
            text-align: center;
        }

        .projects-section .section-title {
            font-size: 2.5rem;
            color: var(--primary); /* deep blue text */
            margin-bottom: 40px;
        }

        .projects-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .project-card {
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.07);
            padding: 25px;
            text-align: left;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-left: 6px solid var(--mint); /* Accent for visual cue */
        }

        .project-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
        }

        .project-card h3 {
            font-size: 1.4rem;
            color: var(--accent); /* Soft turquoise title */
            margin-bottom: 10px;
        }

        .project-card p {
            color: #444;
            font-size: 0.95rem;
            line-height: 1.5;
        }

        /* Optional fade-in animation */
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 1s ease-out, transform 1s ease-out;
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Give Section */
        .give {
            padding: 5rem 0;
        }

        .give-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: start;
        }

        .payment-info {
            background: var(--white);
            padding: 2.5rem;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(34, 87, 122, 0.1);
        }

        .payment-methods {
            display: flex;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .payment-method {
            background: var(--input-bg);
            padding: 1.5rem;
            border-radius: 10px;
            border: 2px solid var(--pale-green);
            flex: 1;
            text-align: center;
            transition: all 0.3s ease;
        }

        .payment-method:hover {
            border-color: var(--mint);
            transform: translateY(-2px);
        }

        .payment-method h4 {
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        .payment-method .number {
            font-family: monospace;
            font-size: 1.1rem;
            color: var(--accent);
            font-weight: bold;
        }

        .donation-form {
            background: linear-gradient(135deg, #E6FFF0 0%, #E0FFF7 100%);
            padding: 2.5rem;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(34, 87, 122, 0.1);
        }

        .form-section {
            background: var(--surface);
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--text-primary);
            text-align: left;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid var(--border);
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--primary);
        }

        .submit-btn {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: white;
            padding: 1rem 2rem;
            border: none;
            border-radius: 25px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.3s ease;
            width: 100%;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
        }

        /* Contact Section */
        .contact {
            padding: 5rem 0;
            background: #38A3A5;
            color: white;
        }

        .contact .section-title {
            color: white;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }

        .contact-item {
            background: rgba(255, 255, 255, 0.1);
            padding: 2rem;
            border-radius: 10px;
            text-align: center;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .contact-item:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateY(-5px);
        }

        .contact-icon {
            width: 60px;
            height: 60px;
            background: var(--mint);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 1.5rem;
            color: var(--primary);
        }

        .contact-item h3 {
            margin-bottom: 0.5rem;
            color: var(--light-green);
        }

        .member-actions {
            background: linear-gradient(135deg, var(--mint), var(--light-green));
            padding: 2rem;
            border-radius: 10px;
            text-align: center;
            border: none;
            transition: all 0.3s ease;
        }

        .member-actions:hover {
            transform: translateY(-5px);
        }

        .member-actions .contact-icon {
            background: var(--white);
            color: var(--primary);
        }

        .member-actions h3 {
            color: var(--primary);
            margin-bottom: 1rem;
        }

        .member-actions p {
            color: var(--primary);
            margin-bottom: 1.5rem;
            opacity: 0.8;
        }

        .member-btn {
            display: inline-block;
            background: var(--primary);
            color: white;
            padding: 0.8rem 1.5rem;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            margin: 0 0.5rem;
            transition: all 0.3s ease;
            border: 2px solid var(--primary);
        }

        .member-btn:hover {
            background: transparent;
            color: var(--primary);
            transform: translateY(-2px);
        }

        .member-btn.register {
            background: transparent;
            color: var(--primary);
            border: 2px solid var(--primary);
        }

        .member-btn.register:hover {
            background: var(--primary);
            color: white;
        }

        /* Footer */
        .footer {
            background: var(--primary);
            color: white;
            text-align: center;
            padding: 2rem 0;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .hero h1 {
                font-size: 2.5rem;
            }

            .about-grid,
            .give-content {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .payment-methods {
                flex-direction: column;
            }

            .hero .bible-verse {
                font-size: 1.1rem;
            }

            .section-title {
                font-size: 2rem;
            }
        }

        /* Scroll animations */
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease;
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Payment Methods Section */
        .payment-methods-section {
            padding: 5rem 0;
            text-align: center;
        }

        .payment-methods-section .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        .section-subtitle {
            font-size: 1.2rem;
            color: var(--accent);
            font-weight: 500;
            margin-bottom: 3rem;
            letter-spacing: 1px;
        }

        .payment-options {
            display: flex;
            justify-content: center;
            gap: 3rem;
            max-width: 900px;
            margin: 0 auto;
        }

        .payment-option {
            background: var(--primary);
            color: white;
            padding: 2.5rem 2rem;
            border-radius: 15px;
            min-width: 200px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(34, 87, 122, 0.2);
            position: relative;
            overflow: hidden;
        }

        .payment-option::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
            transition: left 0.5s ease;
        }

        .payment-option:hover::before {
            left: 100%;
        }

        .payment-option:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 35px rgba(34, 87, 122, 0.3);
        }

        .payment-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 1.5rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .gcash-icon {
            background: linear-gradient(135deg,rgb(0, 0, 0),rgb(0, 0, 0));
            box-shadow: 0 4px 15px rgba(0, 212, 255, 0.3);
        }

        .maya-icon {
            background: linear-gradient(135deg, #007DFF, #007DFF);
            box-shadow: 0 4px 15px rgba(0, 125, 255, 0.3);
        }

        .cash-icon {
            background: linear-gradient(135deg,rgb(255, 173, 97),rgb(255, 173, 97));
            box-shadow: 0 4px 15px rgba(0, 125, 255, 0.3);
            color: var(--primary);
        }

        .payment-option h3 {
            font-size: 1.3rem;
            font-weight: 600;
            margin: 0;
            letter-spacing: 1px;
        }

        .payment-option:hover .payment-icon {
            transform: scale(1.1) rotateY(180deg);
        }

        .qr-section {
            padding: 2rem;
            border-radius: 16px;
            background:rgba(0, 0, 0, 0.43);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            max-width: 600px;
            margin: auto;
            margin-top: 2rem;
        }

        .section-title {
            font-size: 1.5rem;
            color: #22577A;
            margin-bottom: 1rem;
        }

        .qr-tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
        }

        .qr-tab {
            padding: 0.75rem 1.5rem;
            border: 2px solid var(--border);
            background: var(--background);
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .qr-tab.active {
            background-color: #22577A;
            color: white;
        }

        .qr-code {
            display: block;
            background:rgb(235, 235, 235);
            text-align: center;
            padding: 2rem;
            border-radius: 12px;
            margin-top: 10px;
            margin-bottom: 1.5rem;
            font-size: 1.1rem;
            color: #22577A;
        }

        .info-box {
            background: #e0f7f7;
            padding: 1.5rem;
            border-left: 4px solid #38A3A5;
            border-radius: 10px;
        }

        .info-box h4 {
            color: #22577A;
            margin-bottom: 0.75rem;
        }

        .info-box ol {
            color: #22577A;
            padding-left: 1.5rem;
            line-height: 1.6;
        }
        
        /* Responsive Design for Payment Methods */
        @media (max-width: 768px) {
            .payment-options {
                flex-direction: column;
                gap: 2rem;
                align-items: center;
            }
            
            .payment-option {
                min-width: 250px;
                max-width: 300px;
            }
            
            .payment-methods-section .section-title {
                font-size: 2rem;
            }
            
            .section-subtitle {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="#home" class="logo">Argent</a>
            <ul class="nav-links">
                <li><a href="#home">Home</a></li>
                <li><a href="#about">About Us</a></li>
                <li><a href="#give">Give</a></li>
                <li><a href="#contact">Contact</a></li>
                <li><a href="{{ route('register') }}" class="login-btn">Get Started</a></li>
                <li><a href="{{ route('login') }}" class="login-btn">Login</a></li>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
 <section class="hero">
        <!-- Background slideshow -->
        <div class="hero-bg-slideshow">
            <div class="hero-bg-slide active"></div>
            <div class="hero-bg-slide"></div>
            <div class="hero-bg-slide"></div>
            <div class="hero-bg-slide"></div>
            <div class="hero-bg-slide"></div>
        </div>
        
        <div class="hero-content">
            <h1>Giving to Glory</h1>
            <p class="bible-verse">"Each of you should give what you have decided in your heart to give, not reluctantly or under compulsion, for God loves a cheerful giver."</p>
            <p class="verse-reference">- 2 Corinthians 9:7</p>
            <a href="#" class="cta-button">Start Giving Today</a>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about">
        <div class="container">
            <h2 class="section-title fade-in" style="margin-bottom: 70px;">About Us</h2>
            <div class="about-grid">
                <div class="about-card fade-in">
                    <h3>Our Church</h3>
                    <p>Philippine Good News International Church was established in 1991 by Pastor Levi Ramboyong. 
                        Its main church is in Lucena, Quezon Province, and it has subsequently expanded to branches around the country and even abroad.
                        A vibrant community of believers dedicated to spreading God's love and transforming lives through the power of the Gospel.
                        Committed to create an environment where everyone can encounter God's presence and discover their purpose.</p>
                    
                    <div class="mission-vision">
                        <div class="mv-item">
                            <h4>Our Mission</h4>
                            <p>Come and Learn.</p>
                        </div>
                        <div class="mv-item">
                            <h4>Our Vision</h4>
                            <p>Go and Preach.</p>
                        </div>
                    </div>
                </div>

                <div class="about-card fade-in">
                    <h3>Argent Our Financial System</h3>
                    <p>We believe in transparent and responsible stewardship of God's resources. Our financial system is designed to make giving convenient, secure, and purposeful for every member of our church family.</p>
                    <p>Your generous contributions support our ministries, outreach programs, and church maintenance that help us fulfill our mission to serve God and others.</p>
                    <p>We utilize modern digital payment methods to ensure your donations are processed safely and efficiently. Every contribution, no matter the size, makes a significant impact in advancing God's kingdom through our church's work.</p>
                </div>
            </div>
        </div>
    </section>
            
    <!-- Current Project -->
    <section class="projects-section" id="projects">
        <h2 class="section-title">Current Church Projects</h2>
        <div class="projects-grid">
            @if(isset($projects) && count($projects))
                @foreach ($projects as $project)
                    <div class="project-card fade-in">
                        <h3>{{ $project->name }}</h3>
                        <p>{{ $project->description }}</p>
                        <div class="progress-bar-container">
                            @php
                                $progress = $project->target_amount > 0
                                    ? min(100, ($project->current_amount / $project->target_amount) * 100)
                                    : 0;
                            @endphp
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: {{ $progress }}%"></div>
                            </div>
                            <p>
                                <strong>₱{{ number_format($project->current_amount, 2) }}</strong>
                                of ₱{{ number_format($project->target_amount, 2) }}
                            </p>
                        </div>
                    </div>
                @endforeach
            @else
                <p>No current projects available.</p>
            @endif
        </div>
    </section>

    <!-- Payment Methods Section -->
    <section id="payment-methods" class="payment-methods-section">
        <div class="container">
            <h2 class="section-title fade-in">3 WAYS TO GIVE YOUR</h2>
            <p class="section-subtitle fade-in">CHURCH PROJECT OR PLEDGE</p>
            <div class="payment-options">
                <div class="payment-option fade-in" data-target="give" onclick="selectPayment(this)">
                    <div class="payment-icon maya-icon">
                        <img src="img/Gcash.png" alt="Gcash Payment" style="height: 45px;">
                    </div>
                    <h3>GCASH</h3>
                </div>
                <div class="payment-option fade-in" data-target="give">
                    <div class="payment-icon gcash-icon">
                        <img src="img/MAYAa.png" alt="Maya Payment" style="height: 45px;">
                    </div>
                    <h3>MAYA</h3>
                </div>
                <div class="payment-option fade-in" data-target="contact">
                    <div class="payment-icon cash-icon">
                        <span>₱</span>
                    </div>
                    <h3>CASH / CHECK</h3>
                </div>
            </div>
        </div>
    </section>

    <!-- Donation Section -->
    <section id="give" style="padding: 40px;">
        <div class="container">
            <div class="donation-panel-container" style="display: flex; gap: 40px; flex-wrap: wrap;">

                <!-- Left Panel: QR + Info -->
                <div class="left-panel" style="flex: 1; min-width: 300px;">
                    <div class="donation-section" style="background-color: #f9f9f9; padding: 20px; border-radius: 10px;">
                        <h3 class="section-title">Make a Donation</h3>

                        <div class="qr-tabs" style="justify-content: center;">
                            <div class="qr-tab active" onclick="switchQR('gcash')">GCash</div>
                            <div class="qr-tab" onclick="switchQR('maya')">Maya</div>
                        </div>

                        <div class="qr-code" id="gcash" style="display: block;">
                            <img src="img/Gcash.png" alt="GCash QR Code" width="330">
                            <p style="font-weight: bold;">Scan to donate with GCash</p>
                        </div>

                        <div class="qr-code" id="maya" style="display: none;">
                            <img src="img/MAYAa.png" alt="Maya QR Code" width="330">
                            <p style="font-weight: bold;">Scan to donate with Maya</p>
                        </div>

                        <div class="info-box" style="margin-top: 20px;">
                            <h4>How to Give:</h4>
                            <ol style="text-align: left;">
                                <li>Send your donation to the GCash or Maya number above</li>
                                <li>Take a screenshot of your transaction</li>
                                <li>Fill out the form to submit your donation proof</li>
                                <li>Our finance team will verify and acknowledge your contribution</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <!-- Right Panel: Donation Form -->
                <div class="form-section" style="background: linear-gradient(135deg, var(--pale-green) 0%, var(--info-bg) 100%); flex: 1; min-width: 300px;">
                    <div class="donation-form" style="padding: 20px; border-radius: 10px;">
                        <h3 style="color: var(--primary); margin-bottom: 2rem;">Donation Verification Form</h3>

                        <form id="donationForm" method="POST" action="{{ route('donation.store') }}">
                            @csrf
                            <input type="hidden" name="member_id" value="{{ auth()->check() ? auth()->user()->id : '' }}">

                            <div class="form-group">
                                <label for="name">Full Name *</label>
                                <input type="text" id="name" name="name" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Email Address *</label>
                                <input type="email" id="email" name="email" required>
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="tel" id="phone" name="phone">
                            </div>

                            <div class="form-group">
                                <label for="amount">Donation Amount *</label>
                                <input type="number" id="amount" name="amount" min="1" step="0.01" required>
                            </div>

                            <div class="form-group">
                                <label for="payment_method">Payment Method *</label>
                                <select name="payment_method" required>
                                    <option value="gcash">GCash</option>
                                    <option value="maya">Maya</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="reference">Transaction Reference Number *</label>
                                <input type="text" id="reference" name="reference" required>
                            </div>

                            <div class="form-group">
                                <label for="purpose">Donation Purpose *</label>
                                <select name="purpose" required>
                                    <option value="pledge">Pledge</option>
                                    <option value="church_project">Church Project</option>
                                    <option value="others">Others</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="notes">Additional Notes</label>
                                <textarea id="notes" name="notes" rows="3" placeholder="Any additional information about your donation..."></textarea>
                            </div>

                            <button type="submit" class="submit-btn">Submit Donation Proof</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact">
        <div class="container">
            <h2 class="section-title fade-in">Get In Touch</h2>
            <div class="contact-grid">
                <div class="contact-item fade-in">
                    <div class="contact-icon"><img src="img/gmail.webp" alt="Facebook" style="height: 35px;" ></div>
                    <h3>Email Us</h3>
                    <p>pgni@gmail.com</p>
                </div>
                
                <div class="contact-item fade-in">
                    <div class="contact-icon"><img src="img/2021_Facebook_icon.svg.webp" alt="Gmail" style="height: 35px;" ></div>
                    <h3>Message Us on Facebook</h3>
                    <p><a href="https://www.facebook.com/share/16m6sVm1ma/" target="_blank">facebook.com/pgni.nabua</a></p>
                </div>
                
                <div class="contact-item fade-in">
                    <div class="contact-icon"><img src="img/address.png" alt="Address" style="height: 35px;" ></div>
                    <h3>Visit Us</h3>
                    <p>Zone #7 San Roque Poblacion</p>
                    <p>Nabua, Camarines Sur</p>
                    <p>Philippines</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 Argent. All rights reserved. | Built with ❤️ for God's glory</p>
        </div>
    </footer>

    <script>

        // Auto-changing background slideshow
        let currentSlide = 0;
        const slides = document.querySelectorAll('.hero-bg-slide');
        const totalSlides = slides.length;

        function changeSlide() {
            // Remove active class from current slide
            slides[currentSlide].classList.remove('active');
            
            // Move to next slide
            currentSlide = (currentSlide + 1) % totalSlides;
            
            // Add active class to new slide
            slides[currentSlide].classList.add('active');
        }

        // Change slide every 3 seconds
        setInterval(changeSlide, 3000);
        
        document.getElementById('donationForm').addEventListener('submit', function (e) {
            e.preventDefault();

            const form = e.target;
            const formData = new FormData(form);

            fetch("{{ route('donate.submit') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                alert(data.message || "Donation submitted successfully!");
                form.reset();
            })
            .catch(err => {
                err.json().then(errorData => {
                    console.error(errorData);
                    alert("Submission failed. Please check your inputs or try again.");
                });
            });
        });

        function switchQR(method) {
            document.getElementById('gcash').style.display = method === 'gcash' ? 'block' : 'none';
            document.getElementById('maya').style.display = method === 'maya' ? 'block' : 'none';

            const tabs = document.querySelectorAll('.qr-tab');
            tabs.forEach(tab => tab.classList.remove('active'));
            document.querySelector(`.qr-tab[onclick="switchQR('${method}')"]`).classList.add('active');
        }

        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Scroll animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.fade-in').forEach(el => {
            observer.observe(el);
        });

        // Form submission handler
        document.querySelector('form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form data
            const formData = new FormData(this);
            const data = Object.fromEntries(formData.entries());
            
            // Simple validation
            if (!data.name || !data.email || !data.phone || !data.amount || !data.reference) {
                alert('Please fill in all required fields.');
                return;
            }
            
            // Simulate form submission
            const submitBtn = this.querySelector('.submit-btn');
            const originalText = submitBtn.textContent;
            submitBtn.textContent = 'Submitting...';
            submitBtn.disabled = true;
            
            setTimeout(() => {
                alert('Thank you for your donation! Your submission has been received and will be verified by our finance team.');
                this.reset();
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
            }, 2000);
        });

        // Navbar background on scroll
        window.addEventListener('scroll', () => {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.style.background = 'rgba(255, 255, 255, 0.98)';
                navbar.style.boxShadow = '0 2px 20px rgba(34, 87, 122, 0.15)';
            } else {
                navbar.style.background = 'rgba(255, 255, 255, 0.95)';
                navbar.style.boxShadow = '0 2px 20px rgba(34, 87, 122, 0.1)';
            }
        });

        // Payment options click handlers
        document.querySelectorAll('.payment-option').forEach(option => {
            option.addEventListener('click', function() {
                const target = this.getAttribute('data-target');
                const targetSection = document.getElementById(target);
                
                if (targetSection) {
                    targetSection.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
                
                // Add a subtle click animation
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 150);
            });
        });
    </script>
</body>
</html>