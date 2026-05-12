<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Combat Arena - Live Event</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;700&family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-red: #e60000;
            --primary-blue: #0d6efd;
            --dark-bg: #0a0a0a;
            --card-bg: #141414;
            --text-main: #ffffff;
            --text-muted: #888888;
        }

        body {
            background-color: var(--dark-bg);
            color: var(--text-main);
            font-family: 'Poppins', sans-serif;
            background-image: radial-gradient(circle at top, #3a0000 0%, #0a0a0a 50%);
            background-attachment: fixed;
        }

        h1, h2, h3, .fighter-name, .vs-text, .live-badge, .highlight-title, .h2h-header {
            font-family: 'Oswald', sans-serif;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* HEADER */
        .main-header {
            text-align: center;
            padding: 50px 0 30px;
            margin-bottom: 40px;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            background: linear-gradient(180deg, rgba(0,0,0,0.8) 0%, rgba(10,10,10,0) 100%);
        }
        .main-header h1 { font-size: 4rem; font-weight: 700; margin: 0; text-shadow: 2px 2px 10px rgba(230,0,0,0.5); }
        .main-header span.red-text { color: var(--primary-red); }

        /* YOUTUBE SECTION */
        .youtube-wrapper {
            background: #000;
            border: 2px solid #333;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.8);
            margin-bottom: 40px;
        }
        .iframe-container {
            position: relative;
            width: 100%;
            padding-top: 56.25%; /* 16:9 Aspect Ratio */
            background: #050505;
        }
        .iframe-container iframe { position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: none; }

        /* ==================== HEAD-TO-HEAD TV CARD (NEW FORMAT - MIRIP IMAGE_8.PNG) ==================== */
        .head-to-head-card {
            background-color: #ffffff;
            color: #111;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(0,0,0,0.9);
            border: 1px solid #ddd;
            margin-bottom: 50px;
            position: relative;
        }
        
        /* Red/Blue corner bars at top */
        .corner-bars {
            height: 6px;
            width: 100%;
            display: flex;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 2;
        }
        .red-bar { background-color: var(--primary-red); flex: 1; }
        .blue-bar { background-color: var(--primary-blue); flex: 1; }
        
        .h2h-body { padding: 50px 30px 0px; position: relative; }
        
        /* H2H Photo Setup */
        .h2h-photo-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
            position: relative;
        }
        .h2h-photo {
            flex: 1;
            height: 380px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        
        /* optional: Makes it look more like image_8.png */
        .h2h-photo-wrapper { 
            position: relative; 
            flex: 1; 
            display: flex; 
            justify-content: center; 
            align-items: flex-end; 
        }
        
        /* VS Text in the center */
        .h2h-vs {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-family: 'Oswald', sans-serif;
            font-size: 2rem;
            color: #888;
            font-weight: 700;
            text-transform: uppercase;
            font-style: italic;
            z-index: 5;
            background-color: rgba(255,255,255,0.7);
            padding: 10px;
            border-radius: 5px;
        }
        
        /* Fighter Details (Names, Countries) in image_8.png style */
        .h2h-details {
            display: flex;
            justify-content: center;
            align-items: flex-end;
            margin-top: -80px; /* Overlap photos */
            position: relative;
            z-index: 4;
            padding-bottom: 20px;
        }
        
        .fighter-info-box { flex: 1; text-align: center; }
        .info-red { text-align: right; margin-right: 150px; }
        .info-blue { text-align: left; margin-left: 150px; }
        
        .info-box-corner-label { 
            font-size: 0.8rem; 
            color: #666; 
            text-transform: uppercase; 
            margin-bottom: 5px; 
            font-weight: 600; 
            letter-spacing: 1px;
        }
        .info-red .info-box-corner-label { color: var(--primary-red); }
        .info-blue .info-box-corner-label { color: var(--primary-blue); }
        
        .info-box-fighter-name { 
            font-family: 'Oswald', sans-serif; 
            font-size: 2rem; 
            font-weight: 700; 
            margin: 0; 
            color: #111; 
            line-height: 1;
        }
        
        /* WIN Badge */
        .badge-win {
            background-color: var(--primary-red);
            color: #fff;
            padding: 5px 12px;
            border-radius: 4px;
            font-size: 0.9rem;
            font-weight: 700;
            text-transform: uppercase;
            position: absolute;
            top: -30px;
        }
        .info-red .badge-win { right: 0; }
        .info-blue .badge-win { left: 0; }

        /* General Header Teks (Atas-Tengah) */
        .h2h-header { 
            text-align: center; 
            padding: 15px 0; 
            margin-bottom: 10px;
            color: #111;
            font-weight: 700;
        }

        /* H2H Footer (Flags & Country Names) */
        .h2h-footer {
            background-color: #f8f9fa;
            border-top: 1px solid #eee;
            padding: 12px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .footer-group { display: flex; align-items: center; gap: 10px; font-weight: 600; font-size: 0.9rem; text-transform: uppercase; color: #111;}
        .country-flag { width: 30px; border-radius: 3px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }

        /* Banner Status di Atas Kartu */
        .highlight-status-banner {
            border-radius: 12px 12px 0 0;
            padding: 8px 15px;
            text-align: center;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            font-family: 'Oswald', sans-serif;
            color: #fff;
            margin-bottom: -5px; /* Sits on top of the bars */
            position: relative;
            z-index: 3;
        }
        .status-live { background-color: var(--primary-red); animation: pulse 1.5s infinite; }
        .status-next { background-color: var(--primary-blue); }

        @keyframes pulse { 0% { opacity: 1; } 50% { opacity: 0.7; } 100% { opacity: 1; } }

        /* ==================== END HEAD-TO-HEAD TV CARD ==================== */

        /* SECTIONS & CARDS (GLOBAL DARK THEME) */
        .section-title { font-size: 2rem; font-weight: 700; border-left: 6px solid var(--primary-red); padding-left: 15px; margin-bottom: 25px; color: #fff; }
        .match-card {
            background: var(--card-bg);
            border: 1px solid #222;
            border-radius: 8px;
            padding: 25px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .card-coming-soon { border-left: 5px solid var(--primary-red); }
        .card-finished { border-left: 5px solid #198754; opacity: 0.85; }
        
        .fighter-group { flex: 1; text-align: center; }
        .fighter-name { font-size: 1.6rem; margin: 0; color: var(--text-main); }
        .fighter-stats { font-size: 0.9rem; color: var(--text-muted); margin-top: 5px; }
        .vs-text { font-size: 1.8rem; color: var(--primary-red); font-weight: 700; font-style: italic; padding: 0 20px; }
        .card-finished .vs-text { color: #555; }
        
        .match-meta { text-align: right; min-width: 140px; }
        .match-date { color: var(--text-muted); font-size: 0.95rem; margin-bottom: 10px; }
        .badge-custom { padding: 6px 14px; border-radius: 4px; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; }
        .bg-coming { background: #222; color: #ccc; border: 1px solid #444; }
        .bg-winner { background: #198754; color: #fff; }

        @media (max-width: 768px) {
            .h2h-photo { height: 200px; }
            .h2h-details { margin-top: -50px; flex-direction: column; align-items: center; }
            .fighter-info-box { margin: 0; margin-bottom: 15px; text-align: center; }
            .info-blue { text-align: center; margin: 0;}
            .info-box-fighter-name { font-size: 1.5rem; }
            .match-card { flex-direction: column; }
            .match-meta { text-align: center; margin-top: 15px; padding-top: 15px; border-top: 1px solid #333; width: 100%; }
        }
    </style>
</head>
<body>

    @include('partials.nav')

    <header class="main-header">
        <h1>COMBAT <span class="red-text">ARENA</span></h1>
        <p class="text-muted mt-2" style="letter-spacing: 2px;">THE ULTIMATE FIGHT NIGHT</p>
    </header>

    <div class="container pb-5">
        <div class="row">
            <div class="col-12">
                
                <div class="youtube-wrapper">
                    @if($youtubeLink)
                        @php
                            $embedLink = $youtubeLink;
                            if(str_contains($youtubeLink, 'youtu.be/')) {
                                $videoId = explode('?', explode('youtu.be/', $youtubeLink)[1])[0];
                                $embedLink = 'https://www.youtube.com/embed/' . $videoId;
                            } elseif(str_contains($youtubeLink, 'watch?v=')) {
                                $videoId = explode('&', explode('watch?v=', $youtubeLink)[1])[0];
                                $embedLink = 'https://www.youtube.com/embed/' . $videoId;
                            }
                        @endphp
                        <div class="iframe-container">
                            <iframe src="{{ $embedLink }}" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    @else
                        <div class="p-5 text-center d-flex flex-column justify-content-center" style="min-height: 500px;">
                            <i class="fas fa-video-slash fa-5x mb-4" style="color: #333;"></i>
                            <h2 style="color: #666; font-family: 'Oswald', sans-serif;">SIARAN LANGSUNG BELUM DIMULAI</h2>
                            <p class="text-muted fs-5">Stay tuned. Link live stream akan segera tersedia.</p>
                        </div>
                    @endif
                </div>

                @php
                    $nextMatch = $comingSoonMatches->first();
                    $restOfFightCard = (!$onGoingMatch && $comingSoonMatches->isNotEmpty()) ? $comingSoonMatches->slice(1) : $comingSoonMatches;
                @endphp

                <div class="mb-5">
                    @if($onGoingMatch)
                        <div class="highlight-status-banner status-live mx-auto" style="max-width: 500px;">
                            <i class="fas fa-circle me-2 animation-pulse"></i> LIVE NOW
                        </div>
                        
                        <div class="head-to-head-card">
                            <div class="corner-bars">
                                <div class="red-bar"></div>
                                <div class="blue-bar"></div>
                            </div>
                            
                            <div class="h2h-header border-bottom">
                                <h3 class="m-0 fs-4">COMBAT ARENA MANAGEMENT - MAIN EVENT</h3>
                                <p class="text-muted m-0 small">LIGHTWEIGHT TITLE BOUT</p>
                            </div>
                            
                            <div class="h2h-body">
                                <div class="h2h-photo-container">
                                    <div class="h2h-photo-wrapper">
                                        @if($onGoingMatch->fighterA->photo)
                                            <img src="{{ asset('storage/' . $onGoingMatch->fighterA->photo) }}" class="h2h-photo" alt="{{ $onGoingMatch->fighterA->name }}">
                                        @else
                                            <div class="h2h-photo d-inline-flex align-items-center justify-content-center" style="background: #eee;">
                                                <i class="fas fa-user-ninja fa-7x text-muted"></i>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <div class="h2h-vs">VS</div>
                                    
                                    <div class="h2h-photo-wrapper">
                                        @if($onGoingMatch->fighterB->photo)
                                            <img src="{{ asset('storage/' . $onGoingMatch->fighterB->photo) }}" class="h2h-photo" alt="{{ $onGoingMatch->fighterB->name }}">
                                        @else
                                            <div class="h2h-photo d-inline-flex align-items-center justify-content-center" style="background: #eee;">
                                                <i class="fas fa-user-ninja fa-7x text-muted"></i>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="h2h-details px-4">
                                    <div class="fighter-info-box info-red">
                                        <div class="position-relative">
                                            <div class="info-box-corner-label">Red Corner</div>
                                            <h4 class="info-box-fighter-name">{{ $onGoingMatch->fighterA->name ?? 'TBA' }}</h4>
                                        </div>
                                    </div>
                                    
                                    <div class="fighter-info-box info-blue">
                                        <div class="position-relative">
                                            <div class="info-box-corner-label">Blue Corner</div>
                                            <h4 class="info-box-fighter-name">{{ $onGoingMatch->fighterB->name ?? 'TBA' }}</h4>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            
                            <div class="h2h-footer">
                                <div class="footer-group">
                                    <img src="{{ asset('img/flags/' . strtolower($onGoingMatch->fighterA->country ?? '') . '.png') }}" class="country-flag" alt="{{ $onGoingMatch->fighterA->country ?? '' }}">
                                    <span>{{ $onGoingMatch->fighterA->country ?? 'N/A' }}</span>
                                </div>
                                
                                <div class="text-danger fw-bold fs-5">LIVE NOW</div>
                                
                                <div class="footer-group">
                                    <span>{{ $onGoingMatch->fighterB->country ?? 'N/A' }}</span>
                                    <img src="{{ asset('img/flags/' . strtolower($onGoingMatch->fighterB->country ?? '') . '.png') }}" class="country-flag" alt="{{ $onGoingMatch->fighterB->country ?? '' }}">
                                </div>
                            </div>
                        </div>

                    @elseif($nextMatch)
                        <div class="highlight-status-banner status-next mx-auto" style="max-width: 500px;">
                            <i class="fas fa-forward me-2"></i> CLOSTEST UPCOMING FIGHT
                        </div>
                        
                        <div class="head-to-head-card">
                            <div class="corner-bars">
                                <div class="red-bar"></div>
                                <div class="blue-bar"></div>
                            </div>
                            
                            <div class="h2h-header border-bottom">
                                <h3 class="m-0 fs-4">COMBAT ARENA - NEXT BOUT</h3>
                                <p class="text-muted m-0 small">MIDNIGHT MADNESS EVENT</p>
                            </div>
                            
                            <div class="h2h-body">
                                <div class="h2h-photo-container">
                                    <div class="h2h-photo-wrapper">
                                        @if($nextMatch->fighterA->photo)
                                            <img src="{{ asset('storage/' . $nextMatch->fighterA->photo) }}" class="h2h-photo" alt="{{ $nextMatch->fighterA->name }}">
                                        @else
                                            <div class="h2h-photo d-inline-flex align-items-center justify-content-center" style="background: #eee;">
                                                <i class="fas fa-user-ninja fa-7x text-muted"></i>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <div class="h2h-vs">VS</div>
                                    
                                    <div class="h2h-photo-wrapper">
                                        @if($nextMatch->fighterB->photo)
                                            <img src="{{ asset('storage/' . $nextMatch->fighterB->photo) }}" class="h2h-photo" alt="{{ $nextMatch->fighterB->name }}">
                                        @else
                                            <div class="h2h-photo d-inline-flex align-items-center justify-content-center" style="background: #eee;">
                                                <i class="fas fa-user-ninja fa-7x text-muted"></i>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="h2h-details px-4">
                                    <div class="fighter-info-box info-red">
                                        <div class="info-box-corner-label">Red Corner</div>
                                        <h4 class="info-box-fighter-name">{{ $nextMatch->fighterA->name ?? 'TBA' }}</h4>
                                    </div>
                                    
                                    <div class="fighter-info-box info-blue">
                                        <div class="info-box-corner-label">Blue Corner</div>
                                        <h4 class="info-box-fighter-name">{{ $nextMatch->fighterB->name ?? 'TBA' }}</h4>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="h2h-footer">
                                <div class="footer-group">
                                    <img src="{{ asset('img/flags/' . strtolower($nextMatch->fighterA->country ?? '') . '.png') }}" class="country-flag" alt="{{ $nextMatch->fighterA->country ?? '' }}">
                                    <span>{{ $nextMatch->fighterA->country ?? 'N/A' }}</span>
                                </div>
                                
                                <div class="text-muted fw-bold">
                                    <i class="far fa-clock me-1"></i> {{ \Carbon\Carbon::parse($nextMatch->scheduled_at)->format('H:i') }} WIB
                                </div>
                                
                                <div class="footer-group">
                                    <span>{{ $nextMatch->fighterB->country ?? 'N/A' }}</span>
                                    <img src="{{ asset('img/flags/' . strtolower($nextMatch->fighterB->country ?? '') . '.png') }}" class="country-flag" alt="{{ $nextMatch->fighterB->country ?? '' }}">
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                
                <div class="mb-5">
                    <h2 class="section-title">UPCOMING FIGHTS</h2>
                    
                    @forelse($restOfFightCard as $match)
                        <div class="match-card card-coming-soon shadow-sm">
                            <div class="fighter-group">
                                <h4 class="fighter-name">{{ $match->fighterA->name ?? '-' }}</h4>
                                <div class="fighter-stats">{{ $match->fighterA->height_cm ?? '-' }}cm / {{ $match->fighterA->weight_kg ?? '-' }}kg</div>
                            </div>
                            <div class="vs-text">VS</div>
                            <div class="fighter-group">
                                <h4 class="fighter-name">{{ $match->fighterB->name ?? '-' }}</h4>
                                <div class="fighter-stats">{{ $match->fighterB->height_cm ?? '-' }}cm / {{ $match->fighterB->weight_kg ?? '-' }}kg</div>
                            </div>
                            <div class="match-meta">
                                <div class="match-date"><i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($match->scheduled_at)->format('H:i') }}</div>
                                <span class="badge-custom bg-coming">Upcoming</span>
                            </div>
                        </div>
                    @empty
                        <div class="alert text-center p-4" style="background: var(--card-bg); border: 1px dashed #333; color: #666; font-size: 1.1rem;">
                            Semua antrean pertandingan sudah masuk ring.
                        </div>
                    @endforelse
                </div>

                <div class="mb-4">
                    <h2 class="section-title" style="border-left-color: #198754;">MATCH RESULTS</h2>
                    
                    @forelse($finishedMatches as $match)
                        <div class="match-card card-finished shadow-sm">
                            <div class="fighter-group">
                                <h4 class="fighter-name {{ $match->winner == ($match->fighterA->name ?? '') ? 'text-success' : '' }}" 
                                    style="{{ $match->winner != ($match->fighterA->name ?? '') && $match->winner != 'Draw' ? 'text-decoration: line-through; color: #555;' : '' }}">
                                    {{ $match->fighterA->name ?? '-' }}
                                </h4>
                            </div>
                            <div class="vs-text">VS</div>
                            <div class="fighter-group">
                                <h4 class="fighter-name {{ $match->winner == ($match->fighterB->name ?? '') ? 'text-success' : '' }}"
                                    style="{{ $match->winner != ($match->fighterB->name ?? '') && $match->winner != 'Draw' ? 'text-decoration: line-through; color: #555;' : '' }}">
                                    {{ $match->fighterB->name ?? '-' }}
                                </h4>
                            </div>
                            <div class="match-meta">
                                <div class="match-date text-warning mb-1"><i class="fas fa-trophy"></i> W: {{ $match->winner ?? 'Draw' }}</div>
                                <span class="badge-custom bg-winner">Finished</span>
                            </div>
                        </div>
                    @empty
                        <div class="alert text-center p-4" style="background: var(--card-bg); border: 1px dashed #333; color: #666; font-size: 1.1rem;">
                            Belum ada hasil pertandingan.
                        </div>
                    @endforelse
                </div>

            </div>
        </div>
        
        <footer class="text-center mt-5 pt-4 pb-3" style="border-top: 1px solid #222;">
            <p style="color: #444; font-size: 0.9rem;">&copy; 2026 Combat Arena Management. Dibuat dengan semangat bertanding.</p>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>