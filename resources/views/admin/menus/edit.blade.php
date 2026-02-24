@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Edit Menu — {{ $shop->name }}</h3>
    <a href="/admin/shops/{{ $shop->id }}/menus" class="btn btn-secondary">Kembali</a>
</div>

<div class="card stat-card">
    <div class="card-body">
        <form action="/admin/shops/{{ $shop->id }}/menus/{{ $menu->id }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Nama Menu</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name', $menu->menuName) }}">
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="price" class="form-label">Harga</label>
                    <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" id="price" value="{{ old('price', $menu->price) }}">
                    @error('price') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Kategori</label>
                <select class="form-control @error('category') is-invalid @enderror" name="category" id="category">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category', $menu->category_id) == $category->id ? 'selected' : '' }}>{{ $category->categoryName }}</option>
                    @endforeach
                </select>
                @error('category') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3">
                <label for="desc" class="form-label">Deskripsi</label>
                <textarea class="form-control @error('desc') is-invalid @enderror" name="desc" id="desc" style="height: 80px">{{ old('desc', $menu->desc) }}</textarea>
                @error('desc') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3">
                <label for="img" class="form-label">Gambar Menu</label>
                @if($menu->img)
                    <div class="mb-2">
                        <img src="/storage/img/shops/menus/{{ $menu->img }}" class="rounded" style="max-height: 100px;" alt="">
                    </div>
                    <small class="text-muted d-block mb-2">Kosongkan jika tidak ingin mengubah gambar</small>
                @endif
                <input class="form-control @error('img') is-invalid @enderror" name="img" type="file" id="img">
                @error('img') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <button class="btn btn-primary" type="submit"><i class="bi bi-check-lg"></i> Perbarui</button>
        </form>
    </div>
</div>
@endsection
