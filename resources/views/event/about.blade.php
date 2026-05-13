<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - Combat Arena</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;700&family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-red: #e60000;
            --dark-bg: #0a0a0a;
            --text-main: #ffffff;
        }

        body {
            background-color: var(--dark-bg);
            color: var(--text-main);
            font-family: 'Poppins', sans-serif;
            background-image: radial-gradient(circle at top, #220000 0%, #0a0a0a 50%);
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        h1, h2, h3 { font-family: 'Oswald', sans-serif; text-transform: uppercase; letter-spacing: 1px; }

        .main-header {
            text-align: center;
            padding: 60px 0 40px;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            background: linear-gradient(180deg, rgba(0,0,0,0.8) 0%, rgba(10,10,10,0) 100%);
        }
        .main-header h1 { font-size: 4rem; font-weight: 700; margin: 0; text-shadow: 2px 2px 10px rgba(230,0,0,0.5); }
        .main-header span.red-text { color: var(--primary-red); }
        
        .about-container {
            background: #111;
            border: 1px solid #333;
            border-radius: 12px;
            padding: 60px 50px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.8);
            margin-top: 20px;
            margin-bottom: 50px;
        }
        
        .about-text { font-size: 1.15rem; line-height: 1.8; color: #ccc; margin-bottom: 25px; }
        
        .btn-more {
            background-color: var(--primary-red);
            color: #fff;
            font-family: 'Oswald', sans-serif;
            font-size: 1.3rem;
            padding: 15px 40px;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(230,0,0,0.4);
            letter-spacing: 1px;
            margin-top: 20px;
        }
        .btn-more:hover {
            background-color: #cc0000;
            transform: translateY(-3px);
            color: #fff;
            box-shadow: 0 8px 25px rgba(230,0,0,0.6);
        }

        @media (max-width: 768px) {
            .about-container { padding: 40px 20px; }
            .main-header h1 { font-size: 3rem; }
            .btn-more { width: 100%; text-align: center; }
        }

        /* ==================== COMBAT ARENA PREMIUM FOOTER ==================== */
        .combat-footer {
            background-color: #050505;
            border-top: 1px solid #222;
            padding: 70px 0 30px;
            font-family: 'Oswald', sans-serif;
            color: #fff;
            margin-top: 50px;
        }
        .footer-brand {
            font-size: 2.8rem;
            font-weight: 800;
            font-style: italic;
            margin-bottom: 20px;
            letter-spacing: 2px;
            text-transform: uppercase;
        }
        .footer-bio {
            font-family: 'Poppins', sans-serif;
            font-size: 0.95rem;
            color: #999;
            line-height: 1.7;
            text-transform: none;
            letter-spacing: normal;
        }
        .footer-heading {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 25px;
            letter-spacing: 1px;
            color: #fff;
        }
        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .footer-links li {
            margin-bottom: 15px;
        }
        .footer-links a {
            color: #aaa;
            text-decoration: none;
            font-family: 'Oswald', sans-serif;
            font-size: 1.1rem;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            display: inline-block;
        }
        .footer-links a:hover {
            color: var(--primary-red);
            transform: translateX(8px);
        }
        .footer-bottom {
            border-top: 1px solid #222;
            padding-top: 25px;
            margin-top: 40px;
            font-family: 'Poppins', sans-serif;
            font-size: 0.85rem;
            color: #666;
            text-transform: none;
            letter-spacing: normal;
        }
        .footer-bottom-link {
            color: #666;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .footer-bottom-link:hover {
            color: #fff;
        }
    </style>
</head>
<body>

    @include('partials.nav')
    
    <header class="main-header">
        <h1>ABOUT <span class="red-text">US</span></h1>
        <p class="text mt-2" style="letter-spacing: 2px;">THE STORY OF COMBAT ARENA</p>
    </header>

    <div class="container flex-grow-1">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="about-container text-center">
                    
                    <i class="fas fa-fist-raised fa-4x mb-4 text-danger"></i>
                    <h2 class="mb-4">WHAT IS COMBAT ARENA?</h2>
                    
                    <p class="about-text">
                        <strong>COMBAT ARENA</strong> is the ultimate stage for the best fighters to prove their toughness, courage, and unwavering dedication. We host professional combat sports events that bring together various martial arts disciplines into one epic arena. 
                    </p>
                    <p class="about-text">
                        With international-standard live broadcast production, highly accurate <em>Tale of the Tape</em> statistics, and a thrilling viewing experience, Combat Arena is committed to elevating the combat sports industry and entertaining millions of fans worldwide.
                    </p>
                    <p class="about-text mb-5">
                        Prepare yourself to witness the ultimate clash of raw power, masterful technique, and a mentality of steel. In this arena, there can only be one winner.
                    </p>

                    <a href="https://www.instagram.com/kkhayree/" target="_blank" class="btn-more">
                        <i class="fas fa-external-link-alt me-2"></i> FOR MORE INFORMATION
                    </a>
                    
                </div>
            </div>
        </div>
    </div>

    <footer class="combat-footer">
        <div class="container">
            <div class="row gx-lg-5">
                
                <div class="col-lg-5 col-md-12 mb-5 mb-lg-0">
                    <h2 class="footer-brand">COMBAT ARENA.</h2>
                    <p class="footer-bio">
                        Combat Arena is committed to fostering growth within the combat sports community, offering fans exhilarating experiences and unparalleled access to the thrill of live competition. As we continue to evolve, our goal remains steadfast.
                    </p>
                </div>
                
                <div class="col-lg-2 col-md-4 mb-5 mb-md-0">
                    <h5 class="footer-heading">SOCIAL MEDIA</h5>
                    <ul class="footer-links">
                        <li><a href="https://instagram.com/MAsukkan_Username" target="_blank">INSTAGRAM</a></li>
                        <li><a href="https://youtube.com/MAsukkan_Channel" target="_blank">YOUTUBE</a></li>
                        <li><a href="https://tiktok.com/@MAsukkan_Username" target="_blank">TIKTOK</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-2 col-md-4 mb-5 mb-md-0">
                    <h5 class="footer-heading">PAGES</h5>
                    <ul class="footer-links">
                        <li><a href="{{ route('home') }}">HOME</a></li>
                        <li><a href="{{ route('events') }}">EVENTS</a></li>
                        <li><a href="{{ route('about') }}">ABOUT</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-3 col-md-4">
                    <h5 class="footer-heading">CONTACT</h5>
                    <ul class="footer-links">
                        <li><a href="mailto:official@combatarena.com">OFFICIAL@COMBATARENA.COM</a></li>
                        <li class="text mt-3" style="font-family: 'Poppins', sans-serif; font-size: 0.9rem; text-transform: uppercase;">
                            <i class="fas fa-map-marker-alt text-danger me-2"></i> JAKARTA, INDONESIA
                        </li>
                    </ul>
                </div>
                
            </div>
            
            <div class="footer-bottom">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        © 2026 Combat Arena Management all rights reserved
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <a href="#" class="footer-bottom-link me-4">Privacy & Policy</a>
                        <a href="#" class="footer-bottom-link">Term & Condition</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>