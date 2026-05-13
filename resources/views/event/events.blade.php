<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events & Tickets - Combat Arena</title>
    
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
            --text-muted: #888888;
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
            padding: 50px 0 30px;
            margin-bottom: 40px;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            background: linear-gradient(180deg, rgba(0,0,0,0.8) 0%, rgba(10,10,10,0) 100%);
        }
        .main-header h1 { font-size: 3.5rem; font-weight: 700; margin: 0; text-shadow: 2px 2px 10px rgba(230,0,0,0.5); }
        .main-header span.red-text { color: var(--primary-red); }

        /* KARTU EVENT RAKSASA */
        .event-card {
            background: #111;
            border: 1px solid #333;
            border-radius: 12px;
            overflow: hidden;
            display: flex;
            box-shadow: 0 15px 40px rgba(0,0,0,0.8);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 50px rgba(230,0,0,0.2);
            border-color: #555;
        }
        
        .event-poster {
            flex: 0 0 450px;
            background-color: #000;
            position: relative;
        }
        .event-poster img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .event-details {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: linear-gradient(90deg, #111 0%, #1a1a1a 100%);
        }
        
        .event-title { font-size: 2.8rem; font-weight: 800; color: #fff; line-height: 1.1; margin-bottom: 20px; }
        
        .event-meta { font-size: 1.1rem; color: #ccc; margin-bottom: 15px; display: flex; align-items: center; gap: 15px; }
        .meta-icon { width: 35px; height: 35px; background: rgba(230,0,0,0.1); color: var(--primary-red); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1rem; }
        
        .location-link { color: #fff; text-decoration: none; transition: color 0.2s ease; }
        .location-link:hover { color: var(--primary-red); text-decoration: underline; }

        .btn-ticket {
            background-color: var(--primary-red);
            color: #fff;
            border: none;
            padding: 15px 30px;
            font-size: 1.2rem;
            font-family: 'Oswald', sans-serif;
            font-weight: 700;
            letter-spacing: 2px;
            border-radius: 6px;
            text-decoration: none;
            display: inline-block;
            margin-top: 30px;
            box-shadow: 0 5px 15px rgba(230,0,0,0.4);
            transition: all 0.3s ease;
            text-align: center;
        }
        .btn-ticket:hover { background-color: #cc0000; transform: scale(1.05); color: #fff; }

        .no-event { text-align: center; padding: 80px 20px; background: #111; border-radius: 12px; border: 1px dashed #333; }

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

        @media (max-width: 992px) {
            .event-card { flex-direction: column; }
            .event-poster { flex: auto; height: 250px; }
            .event-details { padding: 30px 20px; text-align: center; }
            .event-meta { justify-content: center; flex-direction: column; gap: 10px; }
            .event-title { font-size: 2rem; }
        }
    </style>
</head>
<body>

    @include('partials.nav')

    <header class="main-header">
        <h1>EVENTS & <span class="red-text">TICKETS</span></h1>
        <p class="text mt-2" style="letter-spacing: 2px;">SECURE YOUR SEAT NOW</p>
    </header>

    <div class="container pb-5 flex-grow-1">
        
        <h3 class="mb-4" style="border-left: 5px solid var(--primary-red); padding-left: 15px;">FEATURED EVENT</h3>

        @if($eventLocation || $eventTicket || $eventPoster)
            <div class="event-card">
                <div class="event-poster">
                    @if($eventPoster)
                        <img src="{{ asset('storage/' . $eventPoster) }}" alt="Poster {{ $eventName }}">
                    @else
                        <div class="w-100 h-100 d-flex align-items-center justify-content-center flex-column text-muted" style="min-height: 250px;">
                            <i class="fas fa-image fa-4x mb-3"></i>
                            <span>No Poster Available</span>
                        </div>
                    @endif
                </div>
                
                <div class="event-details">
                    <span class="badge bg-danger mb-3 align-self-start align-self-md-center align-self-lg-start px-3 py-2" style="font-family: 'Oswald', sans-serif; letter-spacing: 1px;">OFFICIAL EVENT</span>
                    
                    <h2 class="event-title">{{ $eventName }}</h2>
                    
                    <div class="event-meta">
                        <div class="meta-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <div>
                            @if($eventGmaps)
                                <a href="{{ $eventGmaps }}" target="_blank" class="location-link fw-bold">
                                    {{ $eventLocation ?? 'Lokasi Belum Ditentukan' }} <i class="fas fa-external-link-alt ms-1 small text-muted"></i>
                                </a>
                            @else
                                <span class="fw-bold">{{ $eventLocation ?? 'Lokasi Belum Ditentukan' }}</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="event-meta">
                        <div class="meta-icon"><i class="fas fa-info-circle"></i></div>
                        <div>Dapatkan tiket fisik atau digital Anda sekarang sebelum kehabisan.</div>
                    </div>

                    <div>
                        @if($eventTicket)
                            <a href="{{ $eventTicket }}" target="_blank" class="btn-ticket w-100 w-md-auto">
                                <i class="fas fa-ticket-alt me-2"></i> GET TICKETS
                            </a>
                        @else
                            <button class="btn-ticket w-100 w-md-auto" style="background: #333; color: #888; box-shadow: none; cursor: not-allowed;" disabled>
                                TIKET BELUM TERSEDIA
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        @else
            <div class="no-event shadow-sm">
                <i class="fas fa-calendar-times fa-5x text-muted mb-4"></i>
                <h2 class="text-white">NO UPCOMING EVENTS</h2>
                <p class="text-muted">Saat ini belum ada event besar yang dijadwalkan. Silakan pantau terus halaman ini.</p>
                <a href="{{ route('home') }}" class="btn btn-outline-danger mt-3 px-4 py-2 fw-bold">Kembali ke Halaman Utama</a>
            </div>
        @endif

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