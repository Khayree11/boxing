<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fighters Roster - Combat Arena</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;700&family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --dark-bg: #0a0a0a;
            --card-bg: #121212;
            --text-main: #ffffff;
            --text-muted: #888888;
        }

        body {
            background-color: var(--dark-bg);
            color: var(--text-main);
            font-family: 'Poppins', sans-serif;
            background-image: radial-gradient(circle at top, #1a1a1a 0%, #0a0a0a 100%);
            background-attachment: fixed;
            padding-bottom: 50px;
        }

        h1, h2, h3, h4, h5 { font-family: 'Oswald', sans-serif; text-transform: uppercase; letter-spacing: 1px; }

        /* HEADER */
        .main-header {
            text-align: center;
            padding: 50px 0 30px;
            margin-bottom: 40px;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            background: linear-gradient(180deg, rgba(0,0,0,0.5) 0%, rgba(10,10,10,0) 100%);
        }
        .main-header h1 { font-size: 4rem; font-weight: 700; margin: 0; color: #fff;}

        /* BENDERA NEGARA */
        .country-flag {
            width: 24px;
            border-radius: 3px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            vertical-align: text-top;
            margin-right: 8px;
        }

        /* ROSTER CARDS */
        .fighter-card {
            background: var(--card-bg);
            border: 1px solid #2a2a2a;
            border-radius: 12px;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.3s ease;
            height: 100%;
        }
        .fighter-card:hover {
            transform: translateY(-8px);
            border-color: #666;
            box-shadow: 0 15px 30px rgba(0,0,0,0.6);
        }
        .fighter-img-wrapper {
            width: 100%;
            height: 320px;
            background: #111;
            background-image: radial-gradient(circle at center, #222 0%, #080808 100%);
            overflow: hidden;
            display: flex;
            align-items: flex-end;
            justify-content: center;
            border-bottom: 1px solid #222;
        }
        .fighter-img-wrapper img {
            width: 100%;
            height: 95%;
            object-fit: contain;
            object-position: bottom;
            transition: transform 0.5s ease;
        }
        .fighter-card:hover .fighter-img-wrapper img { transform: scale(1.05); }
        
        .fighter-info { padding: 20px; text-align: center; }
        .fighter-info h4 { margin: 0; font-size: 1.8rem; font-weight: 800; }
        .fighter-info p { margin: 8px 0 0; color: var(--text-muted); font-size: 0.95rem; font-weight: 600; text-transform: uppercase; }

        /* MODAL STYLING */
        .modal-content {
            background-color: var(--card-bg);
            border: 1px solid #333;
            color: var(--text-main);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0,0,0,0.9);
        }
        .modal-header { border-bottom: 1px solid #222; background: #000; }
        .btn-close-white { filter: invert(1) grayscale(100%) brightness(200%); }
        .modal-body { padding: 0; }
        
        .modal-img-wrapper {
            width: 100%;
            height: 400px;
            background: #111;
            background-image: radial-gradient(circle at center, #2a2a2a 0%, #050505 100%);
            display: flex;
            align-items: flex-end;
            justify-content: center;
            border-bottom: 1px solid #333;
        }
        .modal-fighter-img { width: 100%; height: 95%; object-fit: contain; object-position: bottom; }
        
        .stat-box {
            background: #0a0a0a;
            border: 1px solid #222;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            height: 100%;
        }
        .stat-label { font-size: 0.8rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 5px; font-weight: 600;}
        .stat-value { font-size: 1.6rem; font-family: 'Oswald', sans-serif; font-weight: 700; color: var(--text-main); }
        
        /* FIGHT HISTORY STYLING BARU */
        .record-board {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 2rem;
            margin: 1.5rem 0;
            padding: 1rem;
            background: #050505;
            border-radius: 12px;
            border: 1px solid #1a1a1a;
        }
        .record-item { text-align: center; }
        .record-number { font-size: 2.5rem; font-family: 'Oswald', sans-serif; font-weight: 700; line-height: 1; margin-bottom: 5px; }
        .record-label { font-size: 0.75rem; color: #666; letter-spacing: 2px; text-transform: uppercase; font-weight: 600; }
        
        .history-card {
            background: #0f0f0f;
            border: 1px solid #222;
            border-left: 4px solid #444; /* Default border color */
            border-radius: 8px;
            padding: 15px 20px;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: transform 0.2s ease, background 0.2s ease;
        }
        .history-card:hover { transform: translateX(5px); background: #141414; }
        .history-card.win { border-left-color: #198754; }
        .history-card.loss { border-left-color: #dc3545; }
        .history-card.draw { border-left-color: #6c757d; }
        
        .history-result-badge {
            font-family: 'Oswald', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            width: 40px;
            text-align: center;
        }
        .history-opponent { font-size: 1.2rem; font-weight: 600; color: #fff; line-height: 1.2;}
        .history-date { font-size: 0.8rem; color: #888; }
    </style>
</head>
<body>

    @include('partials.nav')

    <header class="main-header">
        <h1>FIGHTER <span class="text-danger">ROSTER</span></h1>
        <p class="text mt-2" style="letter-spacing: 2px;">MEET THE WARRIORS</p>
    </header>

    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            
            @forelse($fighters as $fighter)
                <div class="col">
                    <div class="fighter-card" data-bs-toggle="modal" data-bs-target="#fighterModal{{ $fighter->id }}">
                        <div class="fighter-img-wrapper">
                            @if($fighter->photo)
                                <img src="{{ asset('storage/' . $fighter->photo) }}" alt="{{ $fighter->name }}">
                            @else
                                <i class="fas fa-user-ninja fa-8x text-secondary pb-4"></i>
                            @endif
                        </div>
                        <div class="fighter-info">
                            <h4>{{ $fighter->name }}</h4>
                            <p>
                                <img src="{{ asset('img/flags/' . strtolower($fighter->country) . '.png') }}" class="country-flag" onerror="this.style.display='none'"> 
                                {{ $fighter->country }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="fighterModal{{ $fighter->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title fs-5"><i class="fas fa-id-card text-muted me-2"></i> FIGHTER PROFILE</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            
                            <div class="modal-body">
                                <div class="modal-img-wrapper">
                                    @if($fighter->photo)
                                        <img src="{{ asset('storage/' . $fighter->photo) }}" alt="{{ $fighter->name }}" class="modal-fighter-img">
                                    @else
                                        <i class="fas fa-user-ninja fa-10x text-secondary pb-4"></i>
                                    @endif
                                </div>
                                
                                <div class="p-4">
                                    <div class="text-center mb-4">
                                        <h2 style="font-size: 2.8rem; line-height: 1.1;" class="mt-1 mb-2">{{ $fighter->name }}</h2>
                                        <div class="text-muted fs-6 fw-bold text-uppercase d-flex align-items-center justify-content-center gap-2">
                                            <img src="{{ asset('img/flags/' . strtolower($fighter->country) . '.png') }}" class="country-flag m-0" style="width: 24px;" onerror="this.style.display='none'">
                                            {{ $fighter->country }}
                                        </div>
                                    </div>
                                    
                                    <div class="row g-3 mb-2">
                                        <div class="col-6">
                                            <div class="stat-box">
                                                <div class="stat-label">Tinggi / Height</div>
                                                <div class="stat-value">{{ $fighter->height_cm }} cm</div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="stat-box">
                                                <div class="stat-label">Berat / Weight</div>
                                                <div class="stat-value">{{ $fighter->weight_kg }} kg</div>
                                            </div>
                                        </div>
                                    </div>

                                    @php
                                        $fightHistory = \App\Models\BoxingMatch::where('status', 'finished')
                                            ->where(function($query) use ($fighter) {
                                                $query->where('fighter_a_id', $fighter->id)
                                                      ->orWhere('fighter_b_id', $fighter->id);
                                            })->orderBy('scheduled_at', 'desc')->get();
                                            
                                        $wins = $fightHistory->where('winner', $fighter->name)->count();
                                        $draws = $fightHistory->where('winner', 'Draw')->count();
                                        $losses = $fightHistory->count() - $wins - $draws;
                                    @endphp

                                    <div class="record-board shadow-sm">
                                        <div class="record-item">
                                            <div class="record-number text-success">{{ $wins }}</div>
                                            <div class="record-label">WINS</div>
                                        </div>
                                        <div class="record-item" style="opacity: 0.3;">
                                            <div class="record-number">-</div>
                                        </div>
                                        <div class="record-item">
                                            <div class="record-number text-danger">{{ $losses }}</div>
                                            <div class="record-label">LOSSES</div>
                                        </div>
                                        <div class="record-item" style="opacity: 0.3;">
                                            <div class="record-number">-</div>
                                        </div>
                                        <div class="record-item">
                                            <div class="record-number text-secondary">{{ $draws }}</div>
                                            <div class="record-label">DRAWS</div>
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <h5 class="mb-3 fw-bold" style="color: #85919c; font-size: 1.1rem; letter-spacing: 1px;">PREVIOUS FIGHTS</h5>
                                        
                                        @if($fightHistory->isEmpty())
                                            <div class="text-center p-4 border border-secondary rounded" style="background: #0f0f0f; border-style: dashed !important;">
                                                <p class="text-muted m-0 small">Belum ada riwayat pertandingan resmi.</p>
                                            </div>
                                        @else
                                            <div class="history-container">
                                                @foreach($fightHistory as $match)
                                                    @php
                                                        $isWinner = $match->winner == $fighter->name;
                                                        $isDraw = $match->winner == 'Draw';
                                                        
                                                        $resultClass = $isDraw ? 'draw' : ($isWinner ? 'win' : 'loss');
                                                        $textClass = $isDraw ? 'text-secondary' : ($isWinner ? 'text-success' : 'text-danger');
                                                        $resultLetter = $isDraw ? 'D' : ($isWinner ? 'W' : 'L');
                                                        
                                                        // Tambahan variabel kata penuh (WIN/LOSS/DRAW)
                                                        $resultWord = $isDraw ? 'DRAW' : ($isWinner ? 'WIN' : 'LOSS');
                                                        
                                                        $opponent = $match->fighter_a_id == $fighter->id ? ($match->fighterB->name ?? 'TBA') : ($match->fighterA->name ?? 'TBA');
                                                    @endphp
                                                    
                                                    <div class="history-card {{ $resultClass }}">
                                                        <div class="d-flex align-items-center gap-3">
                                                            <div class="history-result-badge {{ $textClass }}">{{ $resultLetter }}</div>
                                                            <div>
                                                                <div class="history-opponent">{{ $fighter->name }} vs {{ $opponent }}</div>
                                                                <div class="history-date"><i class="far fa-calendar-alt me-1"></i> {{ \Carbon\Carbon::parse($match->scheduled_at)->format('d M Y') }}</div>
                                                            </div>
                                                        </div>
                                                        <div class="text-end">
                                                            <span class="badge bg-dark border border-secondary {{ $textClass }} px-2 py-1">
                                                                {{ $resultWord }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <i class="fas fa-users-slash fa-4x text-muted mb-3"></i>
                    <h3 class="text-muted">Belum ada data petarung.</h3>
                </div>
            @endforelse

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>