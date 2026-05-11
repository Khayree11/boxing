<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Combat Arena - Live Event</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;700&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* Color Palette & Base Variables */
        :root {
            --primary-red: #e60000;
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

        h1, h2, h3, .fighter-name, .vs-text, .live-badge {
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
        .main-header h1 {
            font-size: 4rem;
            font-weight: 700;
            margin: 0;
            text-shadow: 2px 2px 10px rgba(230,0,0,0.5);
        }
        .main-header span.red-text { color: var(--primary-red); }

        /* TITLE SECTIONS */
        .section-title {
            font-size: 2.2rem;
            font-weight: 700;
            border-left: 6px solid var(--primary-red);
            padding-left: 15px;
            margin-bottom: 30px;
            color: #fff;
        }

        /* LIVE SECTION (Hero) */
        .live-container {
            background: var(--card-bg);
            border: 1px solid #333;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 0 40px rgba(230, 0, 0, 0.25);
            margin-bottom: 60px;
        }
        .live-info-bar {
            background: #000;
            border-bottom: 2px solid var(--primary-red);
            padding: 15px 25px;
        }
        .live-badge {
            background: var(--primary-red);
            color: white;
            padding: 6px 20px;
            font-weight: 700;
            border-radius: 4px;
            animation: pulse 1.5s infinite;
        }
        .iframe-container {
            position: relative;
            width: 100%;
            padding-top: 56.25%; /* 16:9 Aspect Ratio */
            background: #000;
        }
        .iframe-container iframe {
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            border: none;
        }

        /* MATCH CARDS */
        .match-card {
            background: var(--card-bg);
            border: 1px solid #222;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
        }
        .match-card:hover {
            transform: translateY(-4px);
            border-color: #444;
            box-shadow: 0 10px 20px rgba(0,0,0,0.5);
        }
        
        .card-coming-soon { border-left: 4px solid var(--primary-red); }
        .card-finished { border-left: 4px solid #198754; opacity: 0.85; }

        .fighter-group { flex: 1; text-align: center; }
        .fighter-name { font-size: 1.6rem; margin: 0; color: var(--text-main); }
        .fighter-stats { font-size: 0.8rem; color: var(--text-muted); margin-top: 5px; }
        
        .vs-text {
            font-size: 2rem;
            color: var(--primary-red);
            font-weight: 700;
            font-style: italic;
            padding: 0 15px;
            text-shadow: 0 0 10px rgba(230,0,0,0.5);
        }
        .card-finished .vs-text { color: #555; text-shadow: none; }

        .match-meta { text-align: right; min-width: 130px; }
        .match-date { color: var(--text-muted); font-size: 0.85rem; margin-bottom: 8px; }
        .badge-custom {
            padding: 5px 12px;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        .bg-coming { background: #222; color: #ccc; border: 1px solid #444; }
        .bg-winner { background: #198754; color: #fff; }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(230, 0, 0, 0.8); }
            70% { box-shadow: 0 0 0 15px rgba(230, 0, 0, 0); }
            100% { box-shadow: 0 0 0 0 rgba(230, 0, 0, 0); }
        }

        @media (max-width: 768px) {
            .match-card { flex-direction: column; }
            .match-meta { text-align: center; margin-top: 15px; padding-top: 15px; border-top: 1px solid #333; width: 100%; }
            .vs-text { padding: 10px 0; }
            .main-header h1 { font-size: 2.8rem; }
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
        
        @if($onGoingMatch)
            <div class="live-container">
                <div class="live-info-bar d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div class="d-flex flex-column">
                        <h3 class="m-0 text-white">
                            {{ $onGoingMatch->fighterA->name }} 
                            <span class="red-text mx-2">VS</span> 
                            {{ $onGoingMatch->fighterB->name }}
                        </h3>
                        <div class="fighter-stats mt-1 text-light">
                            <i class="fas fa-flag me-1"></i> {{ $onGoingMatch->fighterA->country }} ({{ $onGoingMatch->fighterA->weight_kg }}kg) 
                            <span class="mx-2">|</span> 
                            <i class="fas fa-flag me-1"></i> {{ $onGoingMatch->fighterB->country }} ({{ $onGoingMatch->fighterB->weight_kg }}kg)
                        </div>
                    </div>
                    <div class="live-badge"><i class="fas fa-circle me-2"></i>LIVE NOW</div>
                </div>
                
                @if($onGoingMatch->youtube_link)
                    <div class="iframe-container">
                        <iframe 
                            src="{{ str_replace('watch?v=', 'embed/', $onGoingMatch->youtube_link) }}" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen>
                        </iframe>
                    </div>
                @else
                    <div class="p-5 text-center" style="background: #000; min-height: 300px; display:flex; flex-direction:column; justify-content:center;">
                        <i class="fas fa-video-slash fa-3x mb-3" style="color: #333;"></i>
                        <h4 style="color: #555;">Siaran Langsung Segera Dimulai...</h4>
                    </div>
                @endif
            </div>
        @endif

        <div class="row">
            <div class="col-lg-6 mb-5">
                <h2 class="section-title">FIGHT CARD</h2>
                
                @forelse($comingSoonMatches as $match)
                    <div class="match-card card-coming-soon">
                        <div class="fighter-group">
                            <h4 class="fighter-name">{{ $match->fighterA->name }}</h4>
                            <div class="fighter-stats">{{ $match->fighterA->height_cm }}cm / {{ $match->fighterA->weight_kg }}kg</div>
                        </div>
                        <div class="vs-text">VS</div>
                        <div class="fighter-group">
                            <h4 class="fighter-name">{{ $match->fighterB->name }}</h4>
                            <div class="fighter-stats">{{ $match->fighterB->height_cm }}cm / {{ $match->fighterB->weight_kg }}kg</div>
                        </div>
                        <div class="match-meta">
                            <div class="match-date"><i class="far fa-clock me-1"></i> {{ \Carbon\Carbon::parse($match->scheduled_at)->format('d M y, H:i') }}</div>
                            <span class="badge-custom bg-coming">Upcoming</span>
                        </div>
                    </div>
                @empty
                    <div class="alert text-center" style="background: var(--card-bg); border: 1px dashed #444; color: #777;">
                        Belum ada jadwal *fight card* yang diumumkan.
                    </div>
                @endforelse
            </div>

            <div class="col-lg-6 mb-5">
                <h2 class="section-title" style="border-left-color: #198754;">RESULTS</h2>
                
                @forelse($finishedMatches as $match)
                    <div class="match-card card-finished">
                        <div class="fighter-group">
                            <h4 class="fighter-name {{ $match->winner == $match->fighterA->name ? 'text-success' : '' }}" 
                                style="{{ $match->winner != $match->fighterA->name && $match->winner != null ? 'text-decoration: line-through; color: #555;' : '' }}">
                                {{ $match->fighterA->name }}
                            </h4>
                        </div>
                        <div class="vs-text">VS</div>
                        <div class="fighter-group">
                            <h4 class="fighter-name {{ $match->winner == $match->fighterB->name ? 'text-success' : '' }}"
                                style="{{ $match->winner != $match->fighterB->name && $match->winner != null ? 'text-decoration: line-through; color: #555;' : '' }}">
                                {{ $match->fighterB->name }}
                            </h4>
                        </div>
                        <div class="match-meta">
                            <div class="match-date text-warning mb-1"><i class="fas fa-trophy me-1"></i> W: {{ $match->winner ?? 'Draw' }}</div>
                            <span class="badge-custom bg-winner">Finished</span>
                        </div>
                    </div>
                @empty
                    <div class="alert text-center" style="background: var(--card-bg); border: 1px dashed #444; color: #777;">
                        Belum ada hasil pertandingan.
                    </div>
                @endforelse
            </div>
        </div>
        
        <footer class="text-center mt-4 pt-4 pb-3" style="border-top: 1px solid #222;">
            <p style="color: #444; font-size: 0.9rem;">&copy; 2026 Combat Arena Management. Dibuat dengan semangat bertanding.</p>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>