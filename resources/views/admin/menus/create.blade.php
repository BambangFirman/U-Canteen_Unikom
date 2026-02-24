@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Tambah Menu — {{ $shop->name }}</h3>
    <a href="/admin/shops/{{ $shop->id }}/menus" class="btn btn-secondary">Kembali</a>
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
        <form action="/admin/shops/{{ $shop->id }}/menus" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Nama Menu</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') }}" placeholder="Masukkan nama menu">
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="price" class="form-label">Harga</label>
                    <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" id="price" value="{{ old('price') }}" placeholder="Contoh: 15000">
                    @error('price') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Kategori</label>
                <select class="form-control @error('category') is-invalid @enderror" name="category" id="category">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>{{ $category->categoryName }}</option>
                    @endforeach
                </select>
                @error('category') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3">
                <label for="desc" class="form-label">Deskripsi</label>
                <textarea class="form-control @error('desc') is-invalid @enderror" name="desc" id="desc" style="height: 80px" placeholder="Deskripsi menu...">{{ old('desc') }}</textarea>
                @error('desc') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3">
                <label for="img" class="form-label">Gambar Menu</label>
                <input class="form-control @error('img') is-invalid @enderror" name="img" type="file" id="img">
                @error('img') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <button class="btn btn-success" type="submit"><i class="bi bi-plus-lg"></i> Simpan</button>
        </form>
    </div>
</div>
@endsection
