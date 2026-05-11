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
            padding-bottom: 50px;
        }

        h1, h2, h3, h4, h5 { font-family: 'Oswald', sans-serif; text-transform: uppercase; }

        /* HEADER */
        .main-header {
            text-align: center;
            padding: 50px 0 30px;
            margin-bottom: 40px;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            background: linear-gradient(180deg, rgba(0,0,0,0.8) 0%, rgba(10,10,10,0) 100%);
        }
        .main-header h1 { font-size: 3.5rem; font-weight: 700; margin: 0; text-shadow: 2px 2px 10px rgba(230,0,0,0.5); }
        .main-header span.red-text { color: var(--primary-red); }

        /* ROSTER CARDS */
        .fighter-card {
            background: var(--card-bg);
            border: 1px solid #333;
            border-radius: 12px;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.3s ease;
            height: 100%;
        }
        .fighter-card:hover {
            transform: translateY(-10px);
            border-color: var(--primary-red);
            box-shadow: 0 15px 30px rgba(230,0,0,0.2);
        }
        .fighter-img-wrapper {
            width: 100%;
            height: 300px;
            background: #000;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .fighter-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        .fighter-card:hover .fighter-img-wrapper img { transform: scale(1.05); }
        .fighter-info { padding: 20px; text-align: center; }
        .fighter-info h4 { margin: 0; font-size: 1.8rem; letter-spacing: 1px; }
        .fighter-info p { margin: 5px 0 0; color: var(--text-muted); font-size: 0.9rem; }

        /* MODAL STYLING (DARK THEME) */
        .modal-content {
            background-color: var(--card-bg);
            border: 1px solid #444;
            color: var(--text-main);
            border-radius: 12px;
            overflow: hidden;
        }
        .modal-header {
            border-bottom: 1px solid #333;
            background: #000;
        }
        .btn-close-white { filter: invert(1) grayscale(100%) brightness(200%); }
        .modal-body { padding: 0; }
        
        .modal-fighter-img {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-bottom: 3px solid var(--primary-red);
        }
        .stat-box {
            background: #0a0a0a;
            border: 1px solid #222;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            height: 100%;
        }
        .stat-label { font-size: 0.8rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 5px;}
        .stat-value { font-size: 1.4rem; font-family: 'Oswald', sans-serif; font-weight: 700; color: var(--primary-red); }
    </style>
</head>
<body>

    @include('partials.nav')

    <header class="main-header">
        <h1>FIGHTER <span class="red-text">ROSTER</span></h1>
        <p class="text-muted mt-2" style="letter-spacing: 2px;">MEET THE WARRIORS</p>
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
                                <i class="fas fa-user-ninja fa-5x text-secondary"></i>
                            @endif
                        </div>
                        <div class="fighter-info">
                            <h4>{{ $fighter->name }}</h4>
                            <p><i class="fas fa-map-marker-alt me-1 text-danger"></i> {{ $fighter->country }}</p>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="fighterModal{{ $fighter->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title fs-4"><i class="fas fa-id-card text-danger me-2"></i> Fighter Profile</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                @if($fighter->photo)
                                    <img src="{{ asset('storage/' . $fighter->photo) }}" alt="{{ $fighter->name }}" class="modal-fighter-img">
                                @else
                                    <div class="modal-fighter-img d-flex align-items-center justify-content-center" style="background: #111;">
                                        <i class="fas fa-user-ninja fa-7x text-secondary"></i>
                                    </div>
                                @endif
                                
                                <div class="p-4">
                                    <h2 class="text-center mb-1" style="font-size: 2.5rem;">{{ $fighter->name }}</h2>
                                    <i class="fas fa-flag text-danger me-2"></i>{{ $fighter->country }}</p>
                                    
                                    <div class="row g-3">
                                        <div class="col-6">
                                            <div class="stat-box">
                                                <div class="stat-label">Tinggi / Height</div>
                                                <div class="stat-value">{{ $fighter->height_cm }} cm</div>
                                                <div class="text-muted small mt-1">{{ $fighter->height_ft ?? '-' }}</div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="stat-box">
                                                <div class="stat-label">Berat / Weight</div>
                                                <div class="stat-value">{{ $fighter->weight_kg }} kg</div>
                                                <div class="text-muted small mt-1">{{ $fighter->weight_lbs ?? '-' }}</div>
                                            </div>
                                        </div>
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