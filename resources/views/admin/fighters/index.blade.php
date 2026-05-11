<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Petarung - Combat Arena</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f4f6f9; font-family: 'Inter', sans-serif; }
        .card { border: none; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .fighter-thumb { width: 50px; height: 50px; object-fit: cover; border-radius: 8px; border: 1px solid #ddd; }
    </style>
</head>
<body class="py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-users text-danger me-2"></i> Data Petarung</h2>
            <a href="{{ route('admin.matches.index') }}" class="btn btn-outline-dark"><i class="fas fa-arrow-left"></i> Kembali ke Jadwal</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-header bg-dark text-white fw-bold">Tambah Petarung Baru</div>
                    <div class="card-body">
                        <form action="{{ route('admin.fighters.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Asal Negara</label>
                                <input type="text" name="country" class="form-control" placeholder="Contoh: Indonesia" required>
                            </div>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label class="form-label">Tinggi (cm)</label>
                                    <input type="number" name="height_cm" class="form-control" required>
                                </div>
                                <div class="col-6 mb-3">
                                    <label class="form-label">Berat (kg)</label>
                                    <input type="number" name="weight_kg" class="form-control" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Foto Profil</label>
                                <input type="file" name="photo" class="form-control" accept="image/*">
                            </div>
                            <button type="submit" class="btn btn-danger w-100">Simpan Data</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card">
                    <div class="table-responsive p-3">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Foto</th>
                                    <th>Nama / Negara</th>
                                    <th>Statistik</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($fighters as $fighter)
                                <tr>
                                    <td>
                                        @if($fighter->photo)
                                            <img src="{{ asset('storage/' . $fighter->photo) }}" class="fighter-thumb">
                                        @else
                                            <div class="fighter-thumb bg-secondary d-flex align-items-center justify-content-center text-white">?</div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="fw-bold">{{ $fighter->name }}</div>
                                        <div class="text-muted small">{{ $fighter->country }}</div>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark border">{{ $fighter->height_cm }} cm</span>
                                        <span class="badge bg-light text-dark border">{{ $fighter->weight_kg }} kg</span>
                                    </td>
                                    <td>
                                        @if ($errors->any())
                                        <div class="alert alert-danger mb-4">
                                            <strong>Data gagal disimpan!</strong>
                                            <ul class="mb-0 mt-2">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                        <form action="{{ route('admin.fighters.destroy', $fighter->id) }}" method="POST" onsubmit="return confirm('Hapus petarung ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4">Belum ada data petarung.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>