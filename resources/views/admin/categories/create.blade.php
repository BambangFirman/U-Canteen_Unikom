@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Tambah Kategori</h3>
    <a href="/admin/categories" class="btn btn-secondary">Kembali</a>
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
        <form action="/admin/categories" method="post">
            @csrf
            <div class="mb-3">
                <label for="categoryName" class="form-label">Nama Kategori</label>
                <input type="text" class="form-control @error('categoryName') is-invalid @enderror" name="categoryName" id="categoryName" value="{{ old('categoryName') }}" placeholder="Contoh: Makanan">
                @error('categoryName') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3">
                <label for="desc" class="form-label">Deskripsi</label>
                <textarea class="form-control @error('desc') is-invalid @enderror" name="desc" id="desc" placeholder="Deskripsi kategori..." style="height: 80px">{{ old('desc') }}</textarea>
                @error('desc') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <button class="btn btn-info text-white" type="submit"><i class="bi bi-plus-lg"></i> Simpan</button>
        </form>
    </div>
</div>
@endsection
