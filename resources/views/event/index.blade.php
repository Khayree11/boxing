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
            --text-main: #ffffff;
            --text-muted: #888888;
        }

        body {
            background-color: var(--dark-bg);
            color: var(--text-main);
            font-family: 'Poppins', sans-serif;
            background-image: radial-gradient(circle at top, #220000 0%, #0a0a0a 50%);
            background-attachment: fixed;
        }

        h1, h2, h3, .fighter-name, .vs-text, .live-badge, .highlight-title, .h2h-header, .info-box-fighter-name {
            font-family: 'Oswald', sans-serif;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .main-header {
            text-align: center;
            padding: 50px 0 30px;
            margin-bottom: 30px;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            background: linear-gradient(180deg, rgba(0,0,0,0.8) 0%, rgba(10,10,10,0) 100%);
        }
        .main-header h1 { font-size: 4rem; font-weight: 700; margin: 0; text-shadow: 2px 2px 10px rgba(230,0,0,0.5); }
        .main-header span.red-text { color: var(--primary-red); }

        /* ==================== BANNER TIKET RAKSASA (ALA WWE) ==================== */
        .ticket-grand-banner {
            display: flex;
            background-color: #000;
            border-radius: 6px;
            overflow: hidden;
            border: 1px solid #333;
            box-shadow: 0 10px 30px rgba(0,0,0,0.8);
            margin-bottom: 40px;
            text-decoration: none;
            color: inherit;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .ticket-grand-banner.is-clickable { cursor: pointer; }
        .ticket-grand-banner.is-clickable:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(230,0,0,0.3);
            border-color: #555;
            color: inherit;
        }
        .tgb-left {
            background-color: #e60000;
            background-image: radial-gradient(rgba(255,255,255,0.2) 2px, transparent 2px);
            background-size: 10px 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px 30px;
            min-width: 250px;
        }
        .tgb-left h2 { color: #fff; font-size: 2.2rem; font-weight: 800; margin: 0; line-height: 1.1; text-align: center; }
        .tgb-mid { flex: 0 0 350px; background: #111; position: relative; }
        .tgb-mid img { width: 100%; height: 100%; object-fit: cover; }
        .tgb-right {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 40px;
            background-color: #050505;
        }
        .tgb-info-title { color: #fff; font-family: 'Poppins', sans-serif; font-size: 1.2rem; font-weight: 600; margin-bottom: 5px; }
        .btn-tgb { background: transparent; color: #0d6efd; border: none; font-size: 1.8rem; transition: transform 0.3s ease; }
        .ticket-grand-banner:hover .btn-tgb { transform: translateX(8px); color: #fff; }
        
        /* Link Lokasi Khusus */
        .location-link { transition: color 0.2s ease; position: relative; z-index: 10; }
        .location-link:hover { color: var(--primary-red) !important; text-decoration: underline !important; }

        /* YOUTUBE */
        .youtube-wrapper { background: #000; border: 2px solid #333; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.8); margin-bottom: 40px; }
        .iframe-container { position: relative; width: 100%; padding-top: 56.25%; background: #050505; }
        .iframe-container iframe { position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: none; }

        /* ==================== KARTU H2H (GLOBAL) ==================== */
        .head-to-head-card {
            background-color: #ffffff; color: #111; border-radius: 12px; overflow: hidden;
            box-shadow: 0 15px 40px rgba(0,0,0,0.5); border: 1px solid #ddd; margin-bottom: 25px; position: relative;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .clickable-card { cursor: pointer; }
        .clickable-card:hover { transform: translateY(-5px); box-shadow: 0 20px 50px rgba(0,0,0,0.8); border-color: #aaa; }
        
        .corner-bars { height: 6px; width: 100%; display: flex; position: absolute; top: 0; left: 0; z-index: 2; }
        .red-bar { background-color: var(--primary-red); flex: 1; }
        .blue-bar { background-color: var(--primary-blue); flex: 1; }
        
        .h2h-header { text-align: center; padding: 15px 0 10px; border-bottom: 1px solid #eee; color: #111; font-weight: 700; }
        .h2h-body { padding: 25px 20px 0px; position: relative; overflow: hidden; }
        .h2h-layout { display: flex; align-items: flex-end; justify-content: space-between; }
        
        .h2h-side { width: 30%; text-align: center; position: relative; }
        .h2h-photo { width: 100%; max-height: 380px; object-fit: contain; object-position: bottom; transition: transform 0.3s ease; }
        .list-photo { max-height: 250px; }
        
        .h2h-center { width: 40%; display: flex; align-items: center; justify-content: center; gap: 20px; padding-bottom: 30px; }
        .h2h-vs { font-size: 2.5rem; color: #ccc; font-weight: 700; font-style: italic; }
        .info-box-fighter-name { font-size: 2rem; font-weight: 800; margin: 0; color: #111; line-height: 1.1; }
        .info-box-corner-label { font-size: 0.8rem; text-transform: uppercase; margin-bottom: 5px; font-weight: 700; letter-spacing: 1px; color: #888;}
        
        .badge-win-tag {
            background-color: #ff4500; color: #fff; padding: 5px 20px; font-family: 'Oswald', sans-serif;
            font-size: 1.2rem; font-weight: 700; position: absolute; top: 20px; z-index: 10;
            box-shadow: 0 4px 10px rgba(255, 69, 0, 0.4); letter-spacing: 1px;
        }
        .left-badge { right: 0; }
        .right-badge { left: 0; }

        .h2h-footer { background-color: #f8f9fa; border-top: 1px solid #eee; padding: 12px 30px; display: flex; justify-content: space-between; align-items: center; }
        .footer-group { display: flex; align-items: center; gap: 10px; font-weight: 600; font-size: 0.9rem; text-transform: uppercase; color: #111;}
        .country-flag { width: 30px; border-radius: 3px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }

        .highlight-status-banner {
            border-radius: 12px 12px 0 0; padding: 8px 15px; text-align: center; font-weight: 700;
            letter-spacing: 2px; text-transform: uppercase; font-family: 'Oswald', sans-serif; color: #fff;
            margin-bottom: -5px; position: relative; z-index: 3; max-width: 400px;
        }
        .status-live { background-color: var(--primary-red); animation: pulse 1.5s infinite; }
        .status-next { background-color: var(--primary-blue); }

        .stats-dropdown-tv { background: #111; border-radius: 0 0 12px 12px; padding: 25px; color: #fff; }
        .stat-label-tv { font-size: 0.8rem; color: #888; margin-bottom: 2px; }

        .section-title { font-size: 2rem; font-weight: 700; border-left: 6px solid var(--primary-red); padding-left: 15px; margin-bottom: 25px; color: #fff; }

        /* COMPACT CARDS (UNTUK UPCOMING & RESULTS YANG BERSIH) */
        .compact-card { margin-bottom: 15px; border-radius: 8px; }
        .compact-card .h2h-header { padding: 8px 0 5px; }
        .compact-card .h2h-header h3 { font-size: 1.1rem !important; }
        .compact-card .h2h-body { padding: 15px 15px 0px; }
        .compact-card .h2h-center { padding-bottom: 15px; gap: 10px; }
        .compact-card .info-box-fighter-name { font-size: 1.6rem; }
        .compact-card .h2h-vs { font-size: 1.8rem; }
        .compact-card .h2h-footer { padding: 8px 20px; }
        .compact-card .footer-group { font-size: 0.8rem; }
        .compact-card .country-flag { width: 22px; }
        
        .match-thumbnail { width: 100%; max-height: 180px; object-fit: cover; border-bottom: 2px solid #eee; }

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

        @keyframes pulse { 0% { opacity: 1; } 50% { opacity: 0.7; } 100% { opacity: 1; } }

        @media (max-width: 992px) {
            .ticket-grand-banner { flex-direction: column; }
            .tgb-left { width: 100%; padding: 15px; }
            .tgb-mid { height: 180px; flex: none; }
            .tgb-right { padding: 20px; text-align: center; flex-direction: column; gap: 10px; }
            .ticket-grand-banner:hover .btn-tgb { transform: translateY(5px); }
            
            .h2h-center { gap: 10px; padding-bottom: 20px; }
            .info-box-fighter-name { font-size: 1.5rem; }
            .compact-card .info-box-fighter-name { font-size: 1.3rem; }
        }
        @media (max-width: 768px) {
            .h2h-layout { flex-direction: column; align-items: center; }
            .h2h-side, .h2h-center { width: 100%; }
            .h2h-center { flex-direction: column; padding: 20px 0; gap: 10px; }
            .h2h-photo { max-height: 250px; }
            .compact-card .list-photo { max-height: 180px; }
            .info-box-fighter-name { text-align: center !important; }
            .badge-win-tag { top: 0; left: 50%; transform: translateX(-50%); }
            .h2h-footer { flex-direction: column; gap: 10px; }
        }
    </style>
</head>
<body>

    @include('partials.nav')

    @php
        $eventName = \App\Models\Setting::where('key', 'event_name')->value('value') ?? 'COMBAT ARENA BOUT';
        $eventLocation = \App\Models\Setting::where('key', 'event_location')->value('value');
        $eventGmaps = \App\Models\Setting::where('key', 'event_gmaps')->value('value');
        $eventTicket = \App\Models\Setting::where('key', 'event_ticket')->value('value');
        $eventPoster = \App\Models\Setting::where('key', 'event_poster')->value('value');
    @endphp

    <header class="main-header">
        <h1>COMBAT <span class="red-text">ARENA</span></h1>
        <p class="text mt-2" style="letter-spacing: 2px;">THE ULTIMATE FIGHT NIGHT</p>
    </header>

    <div class="container pb-5">
        <div class="row">
            <div class="col-12">

                @php
                    $isLiveGlobally = $onGoingMatch ? true : false;
                @endphp

                @if(!$isLiveGlobally && ($eventLocation || $eventTicket))
                    <div class="ticket-grand-banner {{ $eventTicket ? 'is-clickable' : '' }}" 
                         @if($eventTicket) onclick="window.open('{{ $eventTicket }}', '_blank')" @endif>
                        <div class="tgb-left">
                            <h2>{{ $eventName }}<br>TICKETS</h2>
                        </div>
                        
                        @if($eventPoster)
                            <div class="tgb-mid">
                                <img src="{{ asset('storage/' . $eventPoster) }}" alt="Event Poster">
                            </div>
                        @endif
                        
                        <div class="tgb-right">
                            <div>
                                <div class="tgb-info-title">Tickets for {{ $eventName }} | Available Now</div>
                                <div class="text-muted small">
                                    <i class="fas fa-map-marker-alt text-danger me-1"></i>
                                    @if($eventGmaps)
                                        <a href="{{ $eventGmaps }}" target="_blank" class="text text-decoration-none location-link" onclick="event.stopPropagation();">
                                            {{ $eventLocation ?? 'Location TBA' }}
                                            <i class="fas fa-external-link-alt ms-1" style="font-size: 0.7rem;"></i>
                                        </a>
                                    @else
                                        {{ $eventLocation ?? 'Location TBA' }}
                                    @endif
                                </div>
                            </div>
                            @if($eventTicket)
                                <div class="btn-tgb"><i class="fas fa-chevron-right"></i></div>
                            @endif
                        </div>
                    </div>
                @endif
                
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
                    @if($onGoingMatch || $nextMatch)
                        @php 
                            $highlight = $onGoingMatch ? $onGoingMatch : $nextMatch;
                        @endphp

                        <div class="highlight-status-banner {{ $isLiveGlobally ? 'status-live' : 'status-next' }} mx-auto">
                            <i class="fas {{ $isLiveGlobally ? 'fa-circle animation-pulse' : 'fa-forward' }} me-2"></i> 
                            {{ $isLiveGlobally ? 'LIVE NOW' : 'CLOSEST UPCOMING MATCH' }}
                        </div>
                        
                        <div class="head-to-head-card clickable-card" data-bs-toggle="collapse" data-bs-target="#collapseHighlight">
                            <div class="corner-bars">
                                <div class="red-bar"></div>
                                <div class="blue-bar"></div>
                            </div>

                            <div class="h2h-header border-bottom">
                                <h3 class="m-0 fs-4">{{ $eventName }}</h3>
                                <p class="text-muted m-0 small">{{ $isLiveGlobally ? 'MAIN EVENT' : 'NEXT BOUT' }}</p>
                            </div>
                            
                            <div class="h2h-body">
                                <div class="h2h-layout">
                                    <div class="h2h-side">
                                        @if($highlight->fighterA->photo)
                                            <img src="{{ asset('storage/' . $highlight->fighterA->photo) }}" class="h2h-photo" alt="{{ $highlight->fighterA->name }}">
                                        @else
                                            <div class="h2h-photo d-inline-flex align-items-end justify-content-center pb-4">
                                                <i class="fas fa-user-ninja fa-8x text-muted"></i>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="h2h-center">
                                        <div class="text-end" style="flex: 1;">
                                            <div class="info-box-corner-label">Red Corner</div>
                                            <h4 class="info-box-fighter-name">{{ $highlight->fighterA->name ?? 'TBA' }}</h4>
                                        </div>
                                        <div class="h2h-vs">VS</div>
                                        <div class="text-start" style="flex: 1;">
                                            <div class="info-box-corner-label">Blue Corner</div>
                                            <h4 class="info-box-fighter-name">{{ $highlight->fighterB->name ?? 'TBA' }}</h4>
                                        </div>
                                    </div>

                                    <div class="h2h-side">
                                        @if($highlight->fighterB->photo)
                                            <img src="{{ asset('storage/' . $highlight->fighterB->photo) }}" class="h2h-photo" alt="{{ $highlight->fighterB->name }}">
                                        @else
                                            <div class="h2h-photo d-inline-flex align-items-end justify-content-center pb-4">
                                                <i class="fas fa-user-ninja fa-8x text-muted"></i>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <div class="h2h-footer">
                                <div class="footer-group">
                                    <img src="{{ asset('img/flags/' . strtolower($highlight->fighterA->country ?? '') . '.png') }}" class="country-flag" onerror="this.style.display='none'">
                                    <span>{{ $highlight->fighterA->country ?? '-' }}</span>
                                </div>
                                <div class="{{ $isLiveGlobally ? 'text-danger fw-bold fs-5' : 'text-dark fw-bold' }}">
                                    @if($isLiveGlobally)
                                        <i class="fas fa-circle text-danger small me-1 animation-pulse"></i> LIVE NOW
                                    @else
                                        <i class="far fa-clock me-1"></i> {{ \Carbon\Carbon::parse($highlight->scheduled_at)->format('H:i') }} WIB
                                    @endif
                                </div>
                                <div class="footer-group">
                                    <span>{{ $highlight->fighterB->country ?? '-' }}</span>
                                    <img src="{{ asset('img/flags/' . strtolower($highlight->fighterB->country ?? '') . '.png') }}" class="country-flag" onerror="this.style.display='none'">
                                </div>
                            </div>

                            <div class="collapse" id="collapseHighlight">
                                <div class="stats-dropdown-tv">
                                    <div class="row text-center text-md-start">
                                        <div class="col-md-5 text-md-end border-md-end border-secondary pe-md-4 mb-4 mb-md-0">
                                            <div class="stat-label-tv text-danger fw-bold">TINGGI / HEIGHT</div>
                                            <h4 class="mb-3">{{ $highlight->fighterA->height_cm ?? '-' }} cm</h4>
                                            <div class="stat-label-tv text-danger fw-bold">BERAT / WEIGHT</div>
                                            <h4 class="mb-0">{{ $highlight->fighterA->weight_kg ?? '-' }} kg</h4>
                                        </div>
                                        <div class="col-md-2 d-flex align-items-center justify-content-center mb-4 mb-md-0">
                                            <span class="badge bg-light text-dark px-3 py-2 fs-6">TALE OF THE TAPE</span>
                                        </div>
                                        <div class="col-md-5 ps-md-4">
                                            <div class="stat-label-tv text-primary fw-bold">TINGGI / HEIGHT</div>
                                            <h4 class="mb-3">{{ $highlight->fighterB->height_cm ?? '-' }} cm</h4>
                                            <div class="stat-label-tv text-primary fw-bold">BERAT / WEIGHT</div>
                                            <h4 class="mb-0">{{ $highlight->fighterB->weight_kg ?? '-' }} kg</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="mb-5">
                    <h2 class="section-title">UPCOMING FIGHTS</h2>
                    
                    @forelse($restOfFightCard as $match)
                        <div class="head-to-head-card compact-card clickable-card" data-bs-toggle="collapse" data-bs-target="#collapseUp{{ $match->id }}">
                            
                            @if($match->thumbnail)
                                <img src="{{ asset('storage/' . $match->thumbnail) }}" class="match-thumbnail">
                            @endif

                            <div class="h2h-header border-bottom bg-light">
                                <h3 class="m-0 fs-6 text-muted">{{ $eventName }}</h3>
                            </div>
                            
                            <div class="h2h-body">
                                <div class="h2h-layout">
                                    <div class="h2h-side">
                                        @if($match->fighterA->photo)
                                            <img src="{{ asset('storage/' . $match->fighterA->photo) }}" class="h2h-photo list-photo" alt="{{ $match->fighterA->name }}">
                                        @else
                                            <div class="h2h-photo list-photo d-inline-flex align-items-end justify-content-center pb-3">
                                                <i class="fas fa-user-ninja fa-5x text-muted"></i>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="h2h-center pb-3">
                                        <div class="text-end" style="flex: 1;">
                                            <h4 class="info-box-fighter-name">{{ $match->fighterA->name ?? '-' }}</h4>
                                        </div>
                                        <div class="h2h-vs">VS</div>
                                        <div class="text-start" style="flex: 1;">
                                            <h4 class="info-box-fighter-name">{{ $match->fighterB->name ?? '-' }}</h4>
                                        </div>
                                    </div>

                                    <div class="h2h-side">
                                        @if($match->fighterB->photo)
                                            <img src="{{ asset('storage/' . $match->fighterB->photo) }}" class="h2h-photo list-photo" alt="{{ $match->fighterB->name }}">
                                        @else
                                            <div class="h2h-photo list-photo d-inline-flex align-items-end justify-content-center pb-3">
                                                <i class="fas fa-user-ninja fa-5x text-muted"></i>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <div class="h2h-footer">
                                <div class="footer-group">
                                    <img src="{{ asset('img/flags/' . strtolower($match->fighterA->country ?? '') . '.png') }}" class="country-flag" onerror="this.style.display='none'">
                                    <span>{{ $match->fighterA->country ?? '-' }}</span>
                                </div>
                                <div class="text-dark fw-bold small">
                                    <i class="far fa-clock me-1"></i> {{ \Carbon\Carbon::parse($match->scheduled_at)->format('H:i') }} WIB
                                </div>
                                <div class="footer-group">
                                    <span>{{ $match->fighterB->country ?? '-' }}</span>
                                    <img src="{{ asset('img/flags/' . strtolower($match->fighterB->country ?? '') . '.png') }}" class="country-flag" onerror="this.style.display='none'">
                                </div>
                            </div>

                            <div class="collapse" id="collapseUp{{ $match->id }}">
                                <div class="stats-dropdown-tv">
                                    <div class="row text-center text-md-start">
                                        <div class="col-md-5 text-md-end border-md-end border-secondary pe-md-4 mb-3 mb-md-0">
                                            <div class="stat-label-tv text-GREY fw-bold">TINGGI / HEIGHT</div>
                                            <h5 class="mb-2">{{ $match->fighterA->height_cm ?? '-' }} cm</h5>
                                            <div class="stat-label-tv text-GREY fw-bold">BERAT / WEIGHT</div>
                                            <h5 class="mb-0">{{ $match->fighterA->weight_kg ?? '-' }} kg</h5>
                                        </div>
                                        <div class="col-md-2 d-flex align-items-center justify-content-center mb-3 mb-md-0">
                                            <span class="badge bg-light text-dark px-2 py-1 fs-6">TALE OF THE TAPE</span>
                                        </div>
                                        <div class="col-md-5 ps-md-4">
                                            <div class="stat-label-tv text-GREY fw-bold">TINGGI / HEIGHT</div>
                                            <h5 class="mb-2">{{ $match->fighterB->height_cm ?? '-' }} cm</h5>
                                            <div class="stat-label-tv text-GREY fw-bold">BERAT / WEIGHT</div>
                                            <h5 class="mb-0">{{ $match->fighterB->weight_kg ?? '-' }} kg</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="alert text-center p-4" style="background: #111; border: 1px dashed #333; color: #666; font-size: 1.1rem;">
                            Semua antrean pertandingan sudah masuk ring.
                        </div>
                    @endforelse
                </div>

                <div class="mb-4">
                    <h2 class="section-title" style="border-left-color: #198754;">MATCH RESULTS</h2>
                    
                    @forelse($finishedMatches as $match)
                        @php
                            $isAWinner = $match->winner == ($match->fighterA->name ?? '');
                            $isBWinner = $match->winner == ($match->fighterB->name ?? '');
                            $isDraw = $match->winner == 'Draw';
                        @endphp

                        <div class="head-to-head-card compact-card clickable-card" data-bs-toggle="collapse" data-bs-target="#collapseRes{{ $match->id }}">
                            
                            @if($match->thumbnail)
                                <img src="{{ asset('storage/' . $match->thumbnail) }}" class="match-thumbnail">
                            @endif

                            <div class="h2h-header border-bottom bg-light">
                                <h3 class="m-0 fs-6 text-muted">{{ $eventName }} RESULT</h3>
                            </div>
                            
                            <div class="h2h-body">
                                <div class="h2h-layout">
                                    <div class="h2h-side">
                                        @if($isAWinner)
                                            <div class="badge-win-tag left-badge">WIN</div>
                                        @endif
                                        @if($match->fighterA->photo)
                                            <img src="{{ asset('storage/' . $match->fighterA->photo) }}" class="h2h-photo list-photo" alt="{{ $match->fighterA->name }}" style="{{ !$isAWinner && !$isDraw ? 'filter: grayscale(80%) opacity(0.7);' : '' }}">
                                        @else
                                            <div class="h2h-photo list-photo d-inline-flex align-items-end justify-content-center pb-3">
                                                <i class="fas fa-user-ninja fa-5x text-muted"></i>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="h2h-center pb-3">
                                        <div class="text-end" style="flex: 1;">
                                            <h4 class="info-box-fighter-name" style="{{ !$isAWinner && !$isDraw ? 'text-decoration: line-through; color: #888;' : '' }}">
                                                {{ $match->fighterA->name ?? '-' }}
                                            </h4>
                                        </div>
                                        <div class="h2h-vs">VS</div>
                                        <div class="text-start" style="flex: 1;">
                                            <h4 class="info-box-fighter-name" style="{{ !$isBWinner && !$isDraw ? 'text-decoration: line-through; color: #888;' : '' }}">
                                                {{ $match->fighterB->name ?? '-' }}
                                            </h4>
                                        </div>
                                    </div>

                                    <div class="h2h-side">
                                        @if($isBWinner)
                                            <div class="badge-win-tag right-badge">WIN</div>
                                        @endif
                                        @if($match->fighterB->photo)
                                            <img src="{{ asset('storage/' . $match->fighterB->photo) }}" class="h2h-photo list-photo" alt="{{ $match->fighterB->name }}" style="{{ !$isBWinner && !$isDraw ? 'filter: grayscale(80%) opacity(0.7);' : '' }}">
                                        @else
                                            <div class="h2h-photo list-photo d-inline-flex align-items-end justify-content-center pb-3">
                                                <i class="fas fa-user-ninja fa-5x text-muted"></i>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <div class="h2h-footer">
                                <div class="footer-group">
                                    <img src="{{ asset('img/flags/' . strtolower($match->fighterA->country ?? '') . '.png') }}" class="country-flag" onerror="this.style.display='none'">
                                    <span>{{ $match->fighterA->country ?? '-' }}</span>
                                </div>
                                
                                <div class="text-success fw-bold small">
                                    @if($isDraw)
                                        <span class="text-secondary"><i class="fas fa-handshake me-1"></i> DRAW</span>
                                    @else
                                        <i class="fas fa-trophy me-1"></i> OFFICIAL RESULT
                                    @endif
                                </div>
                                
                                <div class="footer-group">
                                    <span>{{ $match->fighterB->country ?? '-' }}</span>
                                    <img src="{{ asset('img/flags/' . strtolower($match->fighterB->country ?? '') . '.png') }}" class="country-flag" onerror="this.style.display='none'">
                                </div>
                            </div>

                            <div class="collapse" id="collapseRes{{ $match->id }}">
                                <div class="stats-dropdown-tv">
                                    <div class="row text-center text-md-start">
                                        <div class="col-md-5 text-md-end border-md-end border-secondary pe-md-4 mb-3 mb-md-0">
                                            <div class="stat-label-tv text-GREY fw-bold">TINGGI / HEIGHT</div>
                                            <h5 class="mb-2">{{ $match->fighterA->height_cm ?? '-' }} cm</h5>
                                            <div class="stat-label-tv text-GREY fw-bold">BERAT / WEIGHT</div>
                                            <h5 class="mb-0">{{ $match->fighterA->weight_kg ?? '-' }} kg</h5>
                                        </div>
                                        <div class="col-md-2 d-flex flex-column align-items-center justify-content-center mb-3 mb-md-0">
                                            <span class="badge bg-success text-light px-3 py-1 fs-6 mb-2">W: {{ $match->winner ?? 'Draw' }}</span>
                                            <span class="badge bg-light text-dark px-2 py-1 fs-6">TALE OF THE TAPE</span>
                                        </div>
                                        <div class="col-md-5 ps-md-4">
                                            <div class="stat-label-tv text-GREY fw-bold">TINGGI / HEIGHT</div>
                                            <h5 class="mb-2">{{ $match->fighterB->height_cm ?? '-' }} cm</h5>
                                            <div class="stat-label-tv text-GREY fw-bold">BERAT / WEIGHT</div>
                                            <h5 class="mb-0">{{ $match->fighterB->weight_kg ?? '-' }} kg</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="alert text-center p-4" style="background: #111; border: 1px dashed #333; color: #666; font-size: 1.1rem;">
                            Belum ada hasil pertandingan.
                        </div>
                    @endforelse
                </div>

            </div>
        </div>
    </div> <footer class="combat-footer">
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