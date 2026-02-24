@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Edit Toko</h3>
    <a href="/admin/shops" class="btn btn-secondary">Kembali</a>
</div>

<div class="card stat-card">
    <div class="card-body">
        <form action="/admin/shops/{{ $shop->id }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Nama Toko</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name', $shop->name) }}">
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="img" class="form-label">Profile Toko</label>
                @if($shop->img)
                    <div class="mb-2">
                        <img src="/storage/img/shops/featured/{{ $shop->img }}" class="rounded" style="max-height: 120px;" alt="">
                    </div>
                    <small class="text-muted d-block mb-2">Kosongkan jika tidak ingin mengubah gambar</small>
                @endif
                <input class="form-control @error('img') is-invalid @enderror" name="img" type="file" id="img">
                @error('img')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button class="btn btn-primary" type="submit"><i class="bi bi-check-lg"></i> Perbarui</button>
        </form>
    </div>
</div>
@endsection
