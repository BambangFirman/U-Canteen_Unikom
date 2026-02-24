@include('partials.header')

<div class="container">
    <div class="row vh-100 justify-content-center align-items-center">
        <div class="col-md-6 p-5">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>Edit Toko</h3>
                <a href="/" class="btn btn-secondary">Kembali</a>
            </div>

            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session()->get("success") }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="/shop/{{ $shop->id }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Toko</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name', $shop->name) }}">

                    @error('name')
                    <span class="text-danger p-2">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="formFile" class="form-label">Profile Toko</label>
                    @if($shop->img)
                        <div class="mb-2">
                            <img src="/storage/img/shops/featured/{{ $shop->img }}" class="img-fluid rounded" style="max-height: 150px;" alt="Current Image">
                        </div>
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar</small>
                    @endif
                    <input class="form-control @error('img') is-invalid @enderror" name="img" type="file" id="formFile">

                    @error('img')
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
