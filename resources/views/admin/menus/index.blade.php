@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <a href="/admin/shops" class="btn btn-secondary btn-sm me-2"><i class="bi bi-arrow-left"></i> Kembali ke Toko</a>
        <h3 class="d-inline align-middle">Kelola Menu — {{ $shop->name }}</h3>
    </div>
    <a href="/admin/shops/{{ $shop->id }}/menus/create" class="btn btn-success"><i class="bi bi-plus-lg"></i> Tambah Menu</a>
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
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Nama Menu</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($menus as $index => $menu)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            @if($menu->img)
                                <img src="/storage/img/shops/menus/{{ $menu->img }}" style="width:50px;height:50px;object-fit:cover;" class="rounded" alt="">
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td class="align-middle">{{ ucwords($menu->menuName) }}</td>
                        <td class="align-middle">{{ $menu->category->categoryName ?? '-' }}</td>
                        <td class="align-middle">Rp. {{ number_format($menu->price) }}</td>
                        <td class="align-middle">
                            <a href="/admin/shops/{{ $shop->id }}/menus/{{ $menu->id }}/edit" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <form action="/admin/shops/{{ $shop->id }}/menus/{{ $menu->id }}" method="post" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger btn-delete" data-name="{{ $menu->menuName }}">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Belum ada menu</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
