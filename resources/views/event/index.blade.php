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

        h1, h2, h3, .fighter-name, .vs-text, .live-badge, .highlight-title, .h2h-header, .info-box-fighter-name {
            font-family: 'Oswald', sans-serif;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* HEADER & YOUTUBE */
        .main-header {
            text-align: center;
            padding: 50px 0 30px;
            margin-bottom: 40px;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            background: linear-gradient(180deg, rgba(0,0,0,0.8) 0%, rgba(10,10,10,0) 100%);
        }
        .main-header h1 { font-size: 4rem; font-weight: 700; margin: 0; text-shadow: 2px 2px 10px rgba(230,0,0,0.5); }
        .main-header span.red-text { color: var(--primary-red); }

        .youtube-wrapper {
            background: #000;
            border: 2px solid #333;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.8);
            margin-bottom: 40px;
        }
        .iframe-container { position: relative; width: 100%; padding-top: 56.25%; background: #050505; }
        .iframe-container iframe { position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: none; }

        /* ==================== HEAD-TO-HEAD TV CARD ==================== */
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
        
        .corner-bars { height: 6px; width: 100%; display: flex; position: absolute; top: 0; left: 0; z-index: 2; }
        .red-bar { background-color: var(--primary-red); flex: 1; }
        .blue-bar { background-color: var(--primary-blue); flex: 1; }
        
        /* Layout Tengah untuk Nama & VS */
        .h2h-body { padding: 30px 20px 0px; position: relative; }
        .h2h-layout {
            display: flex;
            align-items: flex-end; /* Gambar menempel di bawah */
            justify-content: space-between;
        }
        
        /* Foto Petarung (Menggunakan contain agar transparan aman) */
        .h2h-side { width: 30%; text-align: center; }
        .h2h-photo {
            width: 100%;
            max-height: 400px;
            object-fit: contain;
            object-position: bottom; /* Jangkar di bawah */
            transition: transform 0.3s ease;
        }
        
        /* Bagian Teks di Tengah */
        .h2h-center {
            width: 40%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 25px;
            padding-bottom: 40px; /* Jarak agar tidak terlalu ke bawah */
        }
        
        .h2h-vs { font-size: 3rem; color: #ccc; font-weight: 700; font-style: italic; }
        .info-box-fighter-name { font-size: 2.2rem; font-weight: 800; margin: 0; color: #111; line-height: 1.1; }
        .info-box-corner-label { font-size: 0.85rem; text-transform: uppercase; margin-bottom: 5px; font-weight: 700; letter-spacing: 1.5px; }

        /* General Header Teks (Atas-Tengah) */
        .h2h-header { text-align: center; padding: 15px 0; border-bottom: 1px solid #eee; color: #111; font-weight: 700; }

        /* H2H Footer (Flags & Country Names) */
        .h2h-footer {
            background-color: #f8f9fa; border-top: 1px solid #eee; padding: 12px 30px;
            display: flex; justify-content: space-between; align-items: center;
        }
        .footer-group { display: flex; align-items: center; gap: 10px; font-weight: 600; font-size: 0.9rem; text-transform: uppercase; color: #111;}
        .country-flag { width: 30px; border-radius: 3px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }

        /* Banner Status di Atas Kartu */
        .highlight-status-banner {
            border-radius: 12px 12px 0 0; padding: 8px 15px; text-align: center; font-weight: 700;
            letter-spacing: 2px; text-transform: uppercase; font-family: 'Oswald', sans-serif; color: #fff;
            margin-bottom: -5px; position: relative; z-index: 3;
        }
        .status-live { background-color: var(--primary-red); animation: pulse 1.5s infinite; }
        .status-next { background-color: var(--primary-blue); }

        /* Dropdown Detail Statistik TV Card */
        .stats-dropdown-tv { background: #111; border-radius: 0 0 12px 12px; padding: 25px; color: #fff; }
        .stat-label-tv { font-size: 0.8rem; color: #888; margin-bottom: 2px; }

        /* ==================== CARDS ANTREAN & HASIL ==================== */
        .section-title { font-size: 2rem; font-weight: 700; border-left: 6px solid var(--primary-red); padding-left: 15px; margin-bottom: 25px; color: #fff; }
        
        .clickable-card { cursor: pointer; transition: all 0.3s ease; }
        .clickable-card:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(0,0,0,0.5); border-color: #555; }
        
        .match-card { background: var(--card-bg); border: 1px solid #222; border-radius: 8px; padding: 20px; margin-bottom: 15px; }
        .card-coming-soon { border-left: 5px solid var(--primary-red); }
        .card-finished { border-left: 5px solid #198754; opacity: 0.9; }
        
        .fighter-group { flex: 1; text-align: center; }
        .fighter-name { font-size: 1.6rem; margin: 0; color: var(--text-main); }
        .vs-text { font-size: 1.8rem; color: var(--primary-red); font-weight: 700; font-style: italic; padding: 0 20px; }
        .card-finished .vs-text { color: #555; }
        
        .match-meta { text-align: right; min-width: 140px; }
        .badge-custom { padding: 6px 14px; border-radius: 4px; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; }
        
        /* Stats Table Dropdown */
        .stats-table { width: 100%; text-align: center; margin-top: 15px; font-size: 0.95rem; }
        .stats-table th { color: var(--text-muted); font-size: 0.8rem; font-weight: normal; padding-bottom: 10px; }
        .stats-table td { padding: 8px 0; border-bottom: 1px solid #222; }
        .stats-table tr:last-child td { border-bottom: none; }

        @keyframes pulse { 0% { opacity: 1; } 50% { opacity: 0.7; } 100% { opacity: 1; } }

        @media (max-width: 992px) {
            .h2h-center { gap: 15px; padding-bottom: 20px; }
            .info-box-fighter-name { font-size: 1.5rem; }
            .h2h-vs { font-size: 2rem; }
        }
        @media (max-width: 768px) {
            .h2h-layout { flex-direction: column; align-items: center; }
            .h2h-side, .h2h-center { width: 100%; }
            .h2h-center { flex-direction: column; padding: 20px 0; gap: 10px; }
            .h2h-photo { max-height: 250px; }
            .info-box-fighter-name { text-align: center !important; }
            .info-box-corner-label { text-align: center !important; }
            .flex-mobile-col { flex-direction: column; text-align: center; }
            .match-meta { text-align: center; margin-top: 15px; padding-top: 15px; border-top: 1px solid #333; width: 100%; }
        }
    </style>
</head>
<body>

    @include('partials.nav')

    <header class="main-header">
        <h1>COMBAT <span class="red-text">ARENA</span></h1>
        <p class="text mt-2" style="letter-spacing: 2px;">THE ULTIMATE FIGHT NIGHT</p>
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
                    @if($onGoingMatch || $nextMatch)
                        @php 
                            $highlight = $onGoingMatch ? $onGoingMatch : $nextMatch;
                            $isLive = $onGoingMatch ? true : false;
                        @endphp

                        <div class="highlight-status-banner {{ $isLive ? 'status-live' : 'status-next' }} mx-auto" style="max-width: 500px;">
                            <i class="fas {{ $isLive ? 'fa-circle animation-pulse' : 'fa-forward' }} me-2"></i> 
                            {{ $isLive ? 'LIVE NOW' : 'CLOSEST FIGHT' }}
                        </div>
                        
                        <div class="head-to-head-card clickable-card" data-bs-toggle="collapse" data-bs-target="#collapseHighlight">
                            <div class="corner-bars">
                                <div class="red-bar"></div>
                                <div class="blue-bar"></div>
                            </div>
                            
                            <div class="h2h-header border-bottom">
                                <h3 class="m-0 fs-4">COMBAT ARENA - {{ $isLive ? 'MAIN EVENT' : 'NEXT BOUT' }}</h3>
                                <p class="text-muted m-0 small">CLICK TO VIEW FIGHTER STATS</p>
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
                                            <div class="info-box-corner-label text-danger">Red Corner</div>
                                            <h4 class="info-box-fighter-name">{{ $highlight->fighterA->name ?? 'TBA' }}</h4>
                                        </div>
                                        
                                        <div class="h2h-vs">VS</div>
                                        
                                        <div class="text-start" style="flex: 1;">
                                            <div class="info-box-corner-label text-primary">Blue Corner</div>
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
                                
                                <div class="{{ $isLive ? 'text-danger fw-bold fs-5' : 'text-muted fw-bold' }}">
                                    @if($isLive)
                                        LIVE NOW
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
                        <div class="match-card card-coming-soon shadow-sm clickable-card" data-bs-toggle="collapse" data-bs-target="#collapseUp{{ $match->id }}">
                            <div class="w-100">
                                <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                                    <div class="fighter-group">
                                        <h4 class="fighter-name">{{ $match->fighterA->name ?? '-' }}</h4>
                                    </div>
                                    <div class="vs-text my-2 my-md-0">VS</div>
                                    <div class="fighter-group">
                                        <h4 class="fighter-name">{{ $match->fighterB->name ?? '-' }}</h4>
                                    </div>
                                    <div class="match-meta">
                                        <div class="match-date"><i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($match->scheduled_at)->format('H:i') }}</div>
                                        <span class="badge-custom bg-coming">Klik Detail <i class="fas fa-chevron-down ms-1"></i></span>
                                    </div>
                                </div>
                                
                                <div class="collapse mt-3" id="collapseUp{{ $match->id }}">
                                    <div class="border-top border-secondary pt-3 mt-2">
                                        <table class="stats-table">
                                            <tr>
                                                <th width="40%">{{ $match->fighterA->name ?? '-' }}</th>
                                                <th width="20%">STATISTIK</th>
                                                <th width="40%">{{ $match->fighterB->name ?? '-' }}</th>
                                            </tr>
                                            <tr>
                                                <td class="text-danger fw-bold">{{ $match->fighterA->height_cm ?? '-' }} cm</td>
                                                <td class="text-muted small">TINGGI</td>
                                                <td class="text-primary fw-bold">{{ $match->fighterB->height_cm ?? '-' }} cm</td>
                                            </tr>
                                            <tr>
                                                <td class="text-danger fw-bold">{{ $match->fighterA->weight_kg ?? '-' }} kg</td>
                                                <td class="text-muted small">BERAT</td>
                                                <td class="text-primary fw-bold">{{ $match->fighterB->weight_kg ?? '-' }} kg</td>
                                            </tr>
                                            <tr>
                                                <td><i class="fas fa-flag text-muted me-2"></i>{{ $match->fighterA->country ?? '-' }}</td>
                                                <td class="text-muted small">NEGARA</td>
                                                <td><i class="fas fa-flag text-muted me-2"></i>{{ $match->fighterB->country ?? '-' }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
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
                        <div class="match-card card-finished shadow-sm clickable-card" data-bs-toggle="collapse" data-bs-target="#collapseRes{{ $match->id }}">
                            <div class="w-100">
                                <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                                    <div class="fighter-group">
                                        <h4 class="fighter-name {{ $match->winner == ($match->fighterA->name ?? '') ? 'text-success' : '' }}" 
                                            style="{{ $match->winner != ($match->fighterA->name ?? '') && $match->winner != 'Draw' ? 'text-decoration: line-through; color: #555;' : '' }}">
                                            {{ $match->fighterA->name ?? '-' }}
                                        </h4>
                                    </div>
                                    <div class="vs-text my-2 my-md-0">VS</div>
                                    <div class="fighter-group">
                                        <h4 class="fighter-name {{ $match->winner == ($match->fighterB->name ?? '') ? 'text-success' : '' }}"
                                            style="{{ $match->winner != ($match->fighterB->name ?? '') && $match->winner != 'Draw' ? 'text-decoration: line-through; color: #555;' : '' }}">
                                            {{ $match->fighterB->name ?? '-' }}
                                        </h4>
                                    </div>
                                    <div class="match-meta">
                                        <div class="match-date text-warning mb-1"><i class="fas fa-trophy"></i> W: {{ $match->winner ?? 'Draw' }}</div>
                                        <span class="badge-custom bg-winner">Hasil & Detail <i class="fas fa-chevron-down ms-1"></i></span>
                                    </div>
                                </div>

                                <div class="collapse mt-3" id="collapseRes{{ $match->id }}">
                                    <div class="border-top border-secondary pt-3 mt-2">
                                        <div class="text-center mb-3">
                                            <span class="badge bg-light text-dark px-3 py-1">Pemenang: <strong>{{ $match->winner ?? 'Seri / Draw' }}</strong></span>
                                        </div>
                                        <table class="stats-table">
                                            <tr>
                                                <th width="40%">{{ $match->fighterA->name ?? '-' }}</th>
                                                <th width="20%">STATISTIK</th>
                                                <th width="40%">{{ $match->fighterB->name ?? '-' }}</th>
                                            </tr>
                                            <tr>
                                                <td class="text-light">{{ $match->fighterA->height_cm ?? '-' }} cm</td>
                                                <td class="text-muted small">TINGGI</td>
                                                <td class="text-light">{{ $match->fighterB->height_cm ?? '-' }} cm</td>
                                            </tr>
                                            <tr>
                                                <td class="text-light">{{ $match->fighterA->weight_kg ?? '-' }} kg</td>
                                                <td class="text-muted small">BERAT</td>
                                                <td class="text-light">{{ $match->fighterB->weight_kg ?? '-' }} kg</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
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