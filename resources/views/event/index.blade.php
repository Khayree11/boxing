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

        h1, h2, h3, .fighter-name, .vs-text, .live-badge, .highlight-title {
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

        /* HIGHLIGHT MATCH (Live / Next) */
        .highlight-match {
            background: var(--card-bg);
            border: 1px solid #333;
            border-radius: 12px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .highlight-live { border-color: var(--primary-red); box-shadow: 0 0 30px rgba(230,0,0,0.2); }
        .highlight-next { border-color: #0d6efd; box-shadow: 0 0 30px rgba(13,110,253,0.15); }
        
        .highlight-header { padding: 12px; font-weight: 700; letter-spacing: 2px; font-size: 1.1rem; }
        .bg-live { background: var(--primary-red); color: white; animation: pulse 1.5s infinite; }
        .bg-next { background: #0d6efd; color: white; }

        .highlight-body { padding: 40px 20px; }
        .highlight-title { font-size: 3rem; margin-bottom: 15px; }
        .vs-highlight { color: var(--primary-red); font-style: italic; margin: 0 30px; font-size: 2.5rem; }
        .highlight-next .vs-highlight { color: #0d6efd; }

        /* SECTIONS & CARDS */
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

        @keyframes pulse { 0% { opacity: 1; } 50% { opacity: 0.7; } 100% { opacity: 1; } }

        @media (max-width: 768px) {
            .match-card { flex-direction: column; }
            .match-meta { text-align: center; margin-top: 15px; padding-top: 15px; border-top: 1px solid #333; width: 100%; }
            .highlight-title { font-size: 2rem; }
            .vs-highlight { font-size: 1.5rem; margin: 0 15px; }
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
                        <div class="highlight-match highlight-live shadow-lg">
                            <div class="highlight-header bg-live"><i class="fas fa-circle me-2"></i> SEDANG BERTANDING (LIVE NOW)</div>
                            <div class="highlight-body">
                                <div class="highlight-title">
                                    {{ $onGoingMatch->fighterA->name ?? 'TBA' }}
                                    <span class="vs-highlight">VS</span>
                                    {{ $onGoingMatch->fighterB->name ?? 'TBA' }}
                                </div>
                                <div class="fighter-stats mt-4 fs-5">
                                    <span class="text-light me-4"><i class="fas fa-flag text-muted"></i> {{ $onGoingMatch->fighterA->country ?? '-' }}</span>
                                    <span class="text-light"><i class="fas fa-flag text-muted"></i> {{ $onGoingMatch->fighterB->country ?? '-' }}</span>
                                </div>
                            </div>
                        </div>
                    @elseif($nextMatch)
                        <div class="highlight-match highlight-next shadow-lg">
                            <div class="highlight-header bg-next"><i class="fas fa-forward me-2"></i> PERTANDINGAN SELANJUTNYA</div>
                            <div class="highlight-body">
                                <div class="highlight-title">
                                    {{ $nextMatch->fighterA->name ?? 'TBA' }}
                                    <span class="vs-highlight">VS</span>
                                    {{ $nextMatch->fighterB->name ?? 'TBA' }}
                                </div>
                                <div class="fighter-stats mt-4">
                                    <span class="badge bg-dark fs-5 px-4 py-2"><i class="far fa-clock text-primary"></i> Jadwal: {{ \Carbon\Carbon::parse($nextMatch->scheduled_at)->format('d M Y - H:i') }} WIB</span>
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