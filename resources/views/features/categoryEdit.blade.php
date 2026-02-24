@include('partials.header')

<div class="container">
    <div class="row vh-100 justify-content-center align-items-center">
        <div class="col-md-6 p-5">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>Edit Kategori</h3>
                <a href="/categories" class="btn btn-secondary">Kembali</a>
            </div>

            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session()->get("success") }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="/categories/{{ $category->id }}" method="post">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="categoryName" class="form-label">Nama Kategori</label>
                    <input type="text" class="form-control @error('categoryName') is-invalid @enderror" name="categoryName" id="categoryName" value="{{ old('categoryName', $category->categoryName) }}" placeholder="Contoh: Makanan">

                    @error('categoryName')
                    <span class="text-danger p-2">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="desc" class="form-label">Deskripsi</label>
                    <textarea class="form-control @error('desc') is-invalid @enderror" name="desc" id="desc" placeholder="Deskripsi kategori..." style="height: 80px">{{ old('desc', $category->desc) }}</textarea>

                    @error('desc')
                    <span class="text-danger p-2">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <button class="btn btn-primary w-100" type="submit">Perbarui</button>
            </form>
        </div>
    </div>
</div>

@include('partials.footer')
