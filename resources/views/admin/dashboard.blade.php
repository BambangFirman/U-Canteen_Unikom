@extends('admin.layouts.app')

@section('content')
<h3 class="mb-4">Dashboard</h3>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="card stat-card">
            <div class="card-body text-center">
                <div class="mb-2"><i class="bi bi-shop-window fs-1 text-primary"></i></div>
                <h2 class="fw-bold">{{ $totalShops }}</h2>
                <p class="text-muted mb-0">Total Toko</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card">
            <div class="card-body text-center">
                <div class="mb-2"><i class="bi bi-journal-text fs-1 text-success"></i></div>
                <h2 class="fw-bold">{{ $totalMenus }}</h2>
                <p class="text-muted mb-0">Total Menu</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card">
            <div class="card-body text-center">
                <div class="mb-2"><i class="bi bi-tags fs-1 text-info"></i></div>
                <h2 class="fw-bold">{{ $totalCategories }}</h2>
                <p class="text-muted mb-0">Total Kategori</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card">
            <div class="card-body text-center">
                <div class="mb-2"><i class="bi bi-people fs-1 text-warning"></i></div>
                <h2 class="fw-bold">{{ $totalUsers }}</h2>
                <p class="text-muted mb-0">Total User</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card stat-card">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-shop-window text-primary"></i> Kelola Toko</h5>
                <p class="card-text text-muted">Tambah, edit, atau hapus toko kantin</p>
                <a href="/admin/shops" class="btn btn-primary btn-sm">Buka</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stat-card">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-journal-text text-success"></i> Kelola Menu</h5>
                <p class="card-text text-muted">Kelola menu per toko melalui halaman Kelola Toko</p>
                <a href="/admin/shops" class="btn btn-success btn-sm">Buka Kelola Toko</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stat-card">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-tags text-info"></i> Kelola Kategori</h5>
                <p class="card-text text-muted">Tambah, edit, atau hapus kategori menu</p>
                <a href="/admin/categories" class="btn btn-info btn-sm text-white">Buka</a>
            </div>
        </div>
    </div>
</div>
@endsection
