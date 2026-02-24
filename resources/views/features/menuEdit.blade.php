@include('partials.header')

<div class="container">
    <div class="row vh-100 justify-content-center align-items-center">
        <div class="col-md-6 p-5">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>Edit Menu</h3>
                <a href="/" class="btn btn-secondary">Kembali</a>
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

            <form action="/menu/{{ $menu->id }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Menu</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name', $menu->menuName) }}">

                    @error('name')
                    <span class="text-danger p-2">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select class="form-control @error('category') is-invalid @enderror" name="category" id="category">
                        <option>CHOOSE ONE: </option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category', $menu->category_id) == $category->id ? 'selected' : '' }}>{{ $category->categoryName }}</option>
                        @endforeach
                    </select>

                    @error('category')
                    <span class="text-danger p-2">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="shop" class="form-label">Shop</label>
                    <select class="form-control @error('shop') is-invalid @enderror" name="shop" id="shop">
                        <option>CHOOSE ONE: </option>
                        @foreach($shops as $shop)
                            <option value="{{ $shop->id }}" {{ old('shop', $menu->shop_id) == $shop->id ? 'selected' : '' }}>{{ $shop->name }}</option>
                        @endforeach
                    </select>

                    @error('shop')
                    <span class="text-danger p-2">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Harga</label>
                    <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" id="price" value="{{ old('price', $menu->price) }}">

                    @error('price')
                    <span class="text-danger p-2">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="desc" class="form-label">Deskripsi</label>
                    <textarea class="form-control @error('desc') is-invalid @enderror" name="desc" id="desc" style="height: 100px">{{ old('desc', $menu->desc) }}</textarea>

                    @error('desc')
                    <span class="text-danger p-2">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="formFile" class="form-label">Gambar Menu</label>
                    @if($menu->img)
                        <div class="mb-2">
                            <img src="/storage/img/shops/menus/{{ $menu->img }}" class="img-fluid rounded" style="max-height: 150px;" alt="Current Image">
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
