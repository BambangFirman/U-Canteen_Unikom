@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Kelola Toko</h3>
    <a href="/admin/shops/create" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Tambah Toko</a>
</div>

@if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session()->get("success") }}
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
                    <th>Nama Toko</th>
                    <th>Jumlah Menu</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($shops as $index => $shop)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            @if($shop->img)
                                <img src="/storage/img/shops/featured/{{ $shop->img }}" style="width:60px;height:60px;object-fit:cover;" class="rounded" alt="">
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td class="align-middle">{{ $shop->name }}</td>
                        <td class="align-middle">{{ $shop->menus->count() }}</td>
                        <td class="align-middle">
                            <a href="/admin/shops/{{ $shop->id }}/menus" class="btn btn-sm btn-info text-white">
                                <i class="bi bi-journal-text"></i> Kelola Menu
                            </a>
                            <a href="/admin/shops/{{ $shop->id }}/edit" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <form action="/admin/shops/{{ $shop->id }}" method="post" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger btn-delete" data-name="{{ $shop->name }}">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Belum ada toko</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
