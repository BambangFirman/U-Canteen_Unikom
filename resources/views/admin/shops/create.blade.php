@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Tambah Toko</h3>
    <a href="/admin/shops" class="btn btn-secondary">Kembali</a>
</div>

@if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session()->get("success") }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session()->has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session()->get("error") }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card stat-card">
    <div class="card-body">
        <form action="/admin/shops" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nama Toko</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') }}" placeholder="Masukkan nama toko">
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="img" class="form-label">Profile Toko</label>
                <input class="form-control @error('img') is-invalid @enderror" name="img" type="file" id="img">
                @error('img')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button class="btn btn-primary" type="submit"><i class="bi bi-plus-lg"></i> Simpan</button>
        </form>
    </div>
</div>
@endsection
