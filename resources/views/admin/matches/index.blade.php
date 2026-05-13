<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Combat Arena</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&display=swap" rel="stylesheet">

    <style>
        body { background-color: #f4f6f9; font-family: 'Inter', sans-serif; color: #333; }
        h2 { font-weight: 800; color: #1a1a1a; letter-spacing: -1px; text-transform: uppercase;}
        .card { border: none; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.04); margin-bottom: 2rem; overflow: hidden; }
        .card-header { font-weight: 600; padding: 1rem 1.5rem; border-bottom: none; }
        .bg-gradient-dark { background: linear-gradient(135deg, #111 0%, #333 100%); color: white; }
        .form-control, .form-select { border-radius: 8px; border: 1px solid #ddd; padding: 0.6rem 1rem; }
        .form-control:focus, .form-select:focus { border-color: #e60000; box-shadow: 0 0 0 0.25rem rgba(230, 0, 0, 0.1); }
        .btn { border-radius: 8px; font-weight: 500; padding: 0.5rem 1rem; }
        .table th { background-color: #f8f9fa; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px; color: #666; }
        .fighter-name { font-weight: 700; font-size: 1.1rem; color: #111; }
        .vs-badge { background-color: #e60000; color: white; font-size: 0.75rem; padding: 3px 8px; border-radius: 4px; font-weight: 800; font-style: italic; }
        .animation-pulse { animation: pulse 1.5s infinite; }
        @keyframes pulse { 0% { opacity: 1; } 50% { opacity: 0.5; } 100% { opacity: 1; } }
    </style>
</head>
<body>

    <div class="container py-5">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-5 gap-3 border-bottom pb-4">
            <div>
                <h2><i class="fas fa-satellite-dish me-2 text-danger"></i> Control Panel</h2>
                <p class="text-muted mb-0">Atur jalannya event Combat Arena secara Real-Time.</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.fighters.index') }}" class="btn btn-dark"><i class="fas fa-users me-1"></i> Database Petarung</a>
                <a href="{{ route('home') }}" class="btn btn-outline-primary" target="_blank"><i class="fas fa-external-link-alt me-1"></i> Lihat Web Public</a>
                <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger"><i class="fas fa-sign-out-alt"></i></button>
                </form>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-md-4">
                <div class="card border-danger mb-4">
                    <div class="card-header bg-danger text-white"><i class="fab fa-youtube me-2"></i> 1. Link Live Stream</div>
                    <div class="card-body">
                        <form action="{{ route('admin.settings.youtube') }}" method="POST">
                            @csrf
                            <input type="url" name="youtube_link" class="form-control mb-2" placeholder="https://youtu.be/..." value="{{ $youtubeLink->value ?? '' }}">
                            <button type="submit" class="btn btn-dark w-100">Update Link YouTube</button>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="col-md-8">
                <div class="card border-primary mb-4">
                    <div class="card-header bg-primary text-white"><i class="fas fa-ticket-alt me-2"></i> 2. Pengaturan Info Event & Tiket</div>
                    <div class="card-body">
                        @php
                            $eName = \App\Models\Setting::where('key', 'event_name')->value('value');
                            $eLoc = \App\Models\Setting::where('key', 'event_location')->value('value');
                            $eGmaps = \App\Models\Setting::where('key', 'event_gmaps')->value('value');
                            $eTicket = \App\Models\Setting::where('key', 'event_ticket')->value('value');
                            $ePoster = \App\Models\Setting::where('key', 'event_poster')->value('value');
                        @endphp
                        <form action="{{ route('admin.settings.event') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Nama Event</label>
                                    <input type="text" name="event_name" class="form-control form-control-sm" value="{{ $eName }}" placeholder="Ex: BYON KICKSTRIKING ASIA">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Banner/Thumbnail Event</label>
                                    <input type="file" name="event_poster" class="form-control form-control-sm" accept="image/*">
                                    @if($ePoster) <small class="text-success" style="font-size: 11px;"><i class="fas fa-check"></i> Banner terpasang</small> @endif
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold">Lokasi Venue</label>
                                    <input type="text" name="event_location" class="form-control form-control-sm" value="{{ $eLoc }}" placeholder="Ex: Gelora Bung Karno">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold">Link Google Maps</label>
                                    <input type="url" name="event_gmaps" class="form-control form-control-sm" value="{{ $eGmaps }}" placeholder="https://maps.google.com/...">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold">Link Tiket (Opsional)</label>
                                    <input type="url" name="event_ticket" class="form-control form-control-sm" value="{{ $eTicket }}" placeholder="https://tiket.com/...">
                                </div>
                                <div class="col-12 mt-3 text-end">
                                    <button type="submit" class="btn btn-primary px-4">Simpan Info Event</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @php
            $liveMatch = $matches->where('status', 'on_going')->first();
            $upcomingList = $matches->where('status', 'coming_soon')->sortBy('scheduled_at');
            $finishedList = $matches->where('status', 'finished')->sortByDesc('scheduled_at');
        @endphp

        <h4 class="mb-3 fw-bold mt-5"><i class="fas fa-crosshairs text-danger me-2"></i> 3. Sorotan Utama</h4>
        
        @if($liveMatch)
            <div class="card border-danger shadow border-2">
                <div class="card-header bg-danger text-white fs-5">
                    <i class="fas fa-circle me-2 animation-pulse"></i> SEDANG BERLANGSUNG (LIVE)
                </div>
                <div class="card-body text-center py-5 bg-white">
                    <h1 class="fw-black" style="font-size: 2.5rem;">
                        {{ $liveMatch->fighterA->name ?? 'TBA' }} 
                        <span class="text-danger mx-3 fs-3 font-italic">VS</span> 
                        {{ $liveMatch->fighterB->name ?? 'TBA' }}
                    </h1>
                    <p class="text-muted mt-2">Waktu Jadwal: {{ \Carbon\Carbon::parse($liveMatch->scheduled_at)->format('d M Y, H:i') }} WIB</p>
                    
                    <form action="{{ route('admin.matches.updateStatus', $liveMatch->id) }}" method="POST" class="mt-4 mx-auto" style="max-width: 500px;">
                        @csrf @method('PUT')
                        <input type="hidden" name="status" value="finished">
                        <div class="input-group input-group-lg shadow-sm">
                            <select name="winner" class="form-select" required>
                                <option value="" selected disabled>-- Pilih Siapa Pemenangnya? --</option>
                                <option value="{{ $liveMatch->fighterA->name ?? '' }}">{{ $liveMatch->fighterA->name ?? '' }}</option>
                                <option value="{{ $liveMatch->fighterB->name ?? '' }}">{{ $liveMatch->fighterB->name ?? '' }}</option>
                                <option value="Draw">Draw (Seri)</option>
                            </select>
                            <button type="submit" class="btn btn-dark fw-bold">Akhiri Match</button>
                        </div>
                    </form>
                </div>
            </div>
        @elseif($upcomingList->isNotEmpty())
            @php $nextMatch = $upcomingList->first(); @endphp
            <div class="card border-primary shadow border-2">
                <div class="card-header bg-primary text-white fs-5">
                    <i class="fas fa-forward me-2"></i> PERTANDINGAN SELANJUTNYA (NEXT MATCH)
                </div>
                <div class="card-body text-center py-5 bg-white">
                    <h2 class="fw-black" style="font-size: 2.2rem;">
                        {{ $nextMatch->fighterA->name ?? 'TBA' }} 
                        <span class="text-primary mx-3 fs-4 font-italic">VS</span> 
                        {{ $nextMatch->fighterB->name ?? 'TBA' }}
                    </h2>
                    <p class="text-muted mt-2"><i class="far fa-clock"></i> Jadwal: {{ \Carbon\Carbon::parse($nextMatch->scheduled_at)->format('d M Y, H:i') }} WIB</p>
                    
                    <form action="{{ route('admin.matches.updateStatus', $nextMatch->id) }}" method="POST" class="mt-4">
                        @csrf @method('PUT')
                        <input type="hidden" name="status" value="on_going">
                        <button type="submit" class="btn btn-success btn-lg shadow"><i class="fas fa-play-circle me-2"></i> Mulai Match Ini (Set Live)</button>
                    </form>
                </div>
            </div>
        @else
            <div class="alert alert-secondary text-center py-4 rounded-3 mb-4">
                <i class="fas fa-box-open fa-2x mb-2 text-muted"></i><br>Belum ada jadwal pertandingan yang tersedia.
            </div>
        @endif

        <div class="row mt-5">
            <div class="col-lg-8">
                <h4 class="mb-3 fw-bold"><i class="fas fa-list-ul text-warning me-2"></i> 4. Fight Card (Antrean)</h4>
                <div class="card p-3">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>Petarung</th>
                                <th>Jadwal</th>
                                <th>Aksi Cepat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $tableUpcoming = (!$liveMatch && $upcomingList->isNotEmpty()) ? $upcomingList->slice(1) : $upcomingList;
                            @endphp

                            @forelse($tableUpcoming as $match)
                                <tr>
                                    <td>
                                        <div class="fighter-name">{{ $match->fighterA->name ?? '-' }}</div>
                                        <div class="vs-badge">VS</div>
                                        <div class="fighter-name">{{ $match->fighterB->name ?? '-' }}</div>
                                    </td>
                                    <td>
                                        <div class="fw-bold">{{ \Carbon\Carbon::parse($match->scheduled_at)->format('d M') }}</div>
                                        <div class="text-muted small">{{ \Carbon\Carbon::parse($match->scheduled_at)->format('H:i') }}</div>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.matches.destroy', $match->id) }}" method="POST" onsubmit="return confirm('Hapus antrean ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i> Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="3" class="text-center py-4 text-muted">Tidak ada antrean tersisa.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <h4 class="mb-3 fw-bold mt-5"><i class="fas fa-history text-success me-2"></i> 5. Hasil Pertandingan</h4>
                <div class="card p-3">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>Match</th>
                                <th>Pemenang</th>
                                <th>Hapus Histori</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($finishedList as $match)
                                <tr>
                                    <td>
                                        {{ $match->fighterA->name ?? '-' }} <span class="text-danger mx-1">vs</span> {{ $match->fighterB->name ?? '-' }}
                                    </td>
                                    <td>
                                        <span class="badge bg-success px-3 py-2"><i class="fas fa-trophy me-1"></i> {{ $match->winner }}</span>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.matches.destroy', $match->id) }}" method="POST" onsubmit="return confirm('Hapus hasil ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-light text-danger"><i class="fas fa-times"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="3" class="text-center py-4 text-muted">Belum ada pertandingan yang selesai.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card bg-gradient-dark">
                    <div class="card-header fs-5 border-bottom border-secondary"><i class="fas fa-plus-circle me-2"></i> Buat Jadwal Fight</div>
                    <div class="card-body p-4">
                        <form action="{{ route('admin.matches.store') }}" method="POST">
                            @csrf
                            
                            <div class="mb-3">
                                <label class="form-label text-light">Sudut Merah</label>
                                <select name="fighter_a_id" class="form-select" required>
                                    <option value="" selected disabled>Pilih Petarung A</option>
                                    @foreach($fighters as $fighter)
                                        <option value="{{ $fighter->id }}">{{ $fighter->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="text-center mb-3"><span class="vs-badge">VS</span></div>
                            
                            <div class="mb-3">
                                <label class="form-label text-light">Sudut Biru</label>
                                <select name="fighter_b_id" class="form-select" required>
                                    <option value="" selected disabled>Pilih Petarung B</option>
                                    @foreach($fighters as $fighter)
                                        <option value="{{ $fighter->id }}">{{ $fighter->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="mb-4">
                                <label class="form-label text-light">Jadwal Tanding</label>
                                <input type="datetime-local" name="scheduled_at" class="form-control" required>
                            </div>
                            
                            <button type="submit" class="btn btn-danger w-100 py-2 fw-bold">Tambahkan ke Antrean</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>