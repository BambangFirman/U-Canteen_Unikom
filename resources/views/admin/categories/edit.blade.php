@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Edit Kategori</h3>
    <a href="/admin/categories" class="btn btn-secondary">Kembali</a>
</div>

<div class="card stat-card">
    <div class="card-body">
        <form action="/admin/categories/{{ $category->id }}" method="post">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="categoryName" class="form-label">Nama Kategori</label>
                <input type="text" class="form-control @error('categoryName') is-invalid @enderror" name="categoryName" id="categoryName" value="{{ old('categoryName', $category->categoryName) }}">
                @error('categoryName') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3">
                <label for="desc" class="form-label">Deskripsi</label>
                <textarea class="form-control @error('desc') is-invalid @enderror" name="desc" id="desc" style="height: 80px">{{ old('desc', $category->desc) }}</textarea>
                @error('desc') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <button class="btn btn-primary" type="submit"><i class="bi bi-check-lg"></i> Perbarui</button>
        </form>
    </div>
</div>
@endsection
