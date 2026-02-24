@include('partials.header')

<div class="container">
    <div class="row justify-content-center py-5">
        <div class="col-md-8">
            <div class="d-flex justify-content-between align-items-center mb-4 mt-5">
                <h3>Daftar Kategori</h3>
                <div>
                    <a href="/categories/create" class="btn btn-primary">+ Tambah Kategori</a>
                    <a href="/" class="btn btn-secondary ms-2">Kembali</a>
                </div>
            </div>

            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session()->get("success") }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $index => $category)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $category->categoryName }}</td>
                            <td>{{ $category->desc ?? '-' }}</td>
                            <td>
                                <a href="/categories/{{ $category->id }}/edit" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="/categories/{{ $category->id }}" method="post" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Belum ada kategori</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('partials.footer')
