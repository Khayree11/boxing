<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Combat Arena</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Inter', sans-serif;
            color: #333;
        }
        
        /* Typography & Utilities */
        h2 { font-weight: 700; color: #1a1a1a; letter-spacing: -0.5px; }
        .text-muted { color: #888 !important; }
        
        /* Cards */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
            margin-bottom: 2rem;
        }
        .card-header {
            background: linear-gradient(135deg, #111 0%, #333 100%);
            color: #fff;
            font-weight: 600;
            border-radius: 12px 12px 0 0 !important;
            padding: 1rem 1.5rem;
            border-bottom: none;
        }
        
        /* Forms */
        .form-label { font-weight: 500; font-size: 0.9rem; margin-bottom: 0.3rem; }
        .form-control, .form-select { border-radius: 8px; border: 1px solid #ddd; padding: 0.6rem 1rem; }
        .form-control:focus, .form-select:focus { border-color: #e60000; box-shadow: 0 0 0 0.25rem rgba(230, 0, 0, 0.1); }
        
        /* Buttons */
        .btn { border-radius: 8px; font-weight: 500; padding: 0.5rem 1rem; }
        .btn-brand { background-color: #e60000; color: #fff; border: none; }
        .btn-brand:hover { background-color: #cc0000; color: #fff; }
        
        /* Table */
        .table-wrapper { border-radius: 12px; overflow: hidden; border: 1px solid #eaeaea; background: #fff; }
        .table { margin-bottom: 0; }
        .table th { background-color: #f8f9fa; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px; color: #666; padding: 1rem; border-bottom: 2px solid #eaeaea; }
        .table td { padding: 1.2rem 1rem; vertical-align: middle; border-bottom: 1px solid #f0f0f0; }
        .table tbody tr:hover { background-color: #fcfcfc; }
        
        /* Custom Elements */
        .fighter-name { font-weight: 600; font-size: 1.1rem; color: #111; }
        .vs-badge { background-color: #e60000; color: white; font-size: 0.75rem; padding: 3px 8px; border-radius: 4px; font-weight: 700; font-style: italic; display: inline-block; margin: 4px 0; }
        .action-column { min-width: 200px; }
    </style>
</head>
<body>

    <div class="container py-5">
        
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-5 gap-3">
            <div>
                <h2><i class="fas fa-gavel me-2 text-danger"></i> Admin Dashboard</h2>
                <p class="text-muted mb-0">Kelola jadwal pertandingan dan hasil akhir Combat Arena.</p>
            </div>
            <div class="d-flex gap-2">
                <a href="#" class="btn btn-secondary"><i class="fas fa-users me-1"></i> Data Petarung</a>
                <a href="{{ route('home') }}" class="btn btn-outline-primary" target="_blank"><i class="fas fa-external-link-alt me-1"></i> Lihat Web</a>
                <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger"><i class="fas fa-sign-out-alt me-1"></i> Logout</button>
                </form>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-header"><i class="fas fa-plus-circle me-2"></i> Tambah Jadwal Pertandingan Baru</div>
            <div class="card-body p-4">
                <form action="{{ route('admin.matches.store') }}" method="POST">
                    @csrf
                    <div class="row g-3 align-items-end">
                        
                        <div class="col-md-3">
                            <label class="form-label">Sudut Merah (Fighter A)</label>
                            <select name="fighter_a_id" class="form-select" required>
                                <option value="" selected disabled>-- Pilih Petarung --</option>
                                @foreach($fighters as $fighter)
                                    <option value="{{ $fighter->id }}">{{ $fighter->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="col-md-1 text-center pb-2">
                            <span class="vs-badge">VS</span>
                        </div>
                        
                        <div class="col-md-3">
                            <label class="form-label">Sudut Biru (Fighter B)</label>
                            <select name="fighter_b_id" class="form-select" required>
                                <option value="" selected disabled>-- Pilih Petarung --</option>
                                @foreach($fighters as $fighter)
                                    <option value="{{ $fighter->id }}">{{ $fighter->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="col-md-3">
                            <label class="form-label">Jadwal Tanding</label>
                            <input type="datetime-local" name="scheduled_at" class="form-control" required>
                        </div>
                        
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-brand w-100"><i class="fas fa-save me-1"></i> Simpan</button>
                        </div>
                    </div>
                    
                    <div class="row mt-3">
                        <div class="col-12">
                            <label class="form-label">Link YouTube Live <span class="text-muted fw-normal">(Opsional)</span></label>
                            <input type="url" name="youtube_link" class="form-control" placeholder="https://youtube.com/watch?v=...">
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="table-wrapper shadow-sm">
            <table class="table table-borderless align-middle">
                <thead>
                    <tr>
                        <th width="30%">Fight Card (A vs B)</th>
                        <th width="20%">Jadwal</th>
                        <th width="15%">Status</th>
                        <th width="15%">Pemenang</th>
                        <th width="20%" class="text-center">Aksi / Kontrol</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($matches as $match)
                    <tr>
                        <td>
                            <div class="text-center d-inline-block">
                                <div class="fighter-name">{{ $match->fighterA->name ?? 'Petarung Dihapus' }}</div>
                                <div class="vs-badge">VS</div>
                                <div class="fighter-name">{{ $match->fighterB->name ?? 'Petarung Dihapus' }}</div>
                            </div>
                        </td>
                        <td>
                            <div class="fw-medium">{{ \Carbon\Carbon::parse($match->scheduled_at)->format('d M Y') }}</div>
                            <div class="text-muted small"><i class="far fa-clock me-1"></i> {{ \Carbon\Carbon::parse($match->scheduled_at)->format('H:i') }} WIB</div>
                        </td>
                        <td>
                            @if($match->status == 'on_going')
                                <span class="badge bg-danger rounded-pill px-3 py-2 animation-pulse"><i class="fas fa-circle me-1 small"></i> ON GOING</span>
                            @elseif($match->status == 'finished')
                                <span class="badge bg-success rounded-pill px-3 py-2"><i class="fas fa-check me-1 small"></i> FINISHED</span>
                            @else
                                <span class="badge bg-dark rounded-pill px-3 py-2"><i class="fas fa-calendar-alt me-1 small"></i> COMING SOON</span>
                            @endif
                        </td>
                        <td>
                            @if($match->winner)
                                <span class="fw-bold text-success"><i class="fas fa-trophy me-1"></i> {{ $match->winner }}</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td class="action-column">
                            <form action="{{ route('admin.matches.updateStatus', $match->id) }}" method="POST" class="mb-2 bg-light p-2 rounded border">
                                @csrf @method('PUT')
                                <label class="form-label small text-muted mb-1">Ubah Status:</label>
                                <select name="status" class="form-select form-select-sm mb-2" onchange="this.form.submit()">
                                    <option value="coming_soon" {{ $match->status == 'coming_soon' ? 'selected' : '' }}>Coming Soon</option>
                                    <option value="on_going" {{ $match->status == 'on_going' ? 'selected' : '' }}>On Going</option>
                                    <option value="finished" {{ $match->status == 'finished' ? 'selected' : '' }}>Finished</option>
                                </select>
                                
                                @if($match->status == 'on_going')
                                    <input type="text" name="winner" placeholder="Input Nama Pemenang..." class="form-control form-control-sm mb-2" required>
                                    <button type="submit" name="status" value="finished" class="btn btn-sm btn-dark w-100">Akhiri & Simpan Hasil</button>
                                @endif
                            </form>

                            <form action="{{ route('admin.matches.destroy', $match->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus jadwal ini secara permanen?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger w-100"><i class="fas fa-trash-alt me-1"></i> Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <i class="fas fa-inbox fa-3x text-muted mb-3 d-block"></i>
                            <h5 class="text-muted">Belum ada data pertandingan</h5>
                            <p class="text-muted small">Jadwal pertandingan yang Anda tambahkan akan muncul di sini.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>