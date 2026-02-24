@include('partials.header')

<div class="container">

    <div class="row vh-100 justify-content-center align-items-center">
        <div class="col-md-6 p-5">
            @if(session()->has('success'))
                <div class="row mx-auto" style="width:98%">
                    <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
                        <div>
                            {{ session()->get("success") }}
                            Silahkan kembali ke
                            <a href="/" class="alert-link">Beranda</a>
                            untuk melihat perubahan
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif

                @if(session()->has('error'))
                    <div class="row mx-auto" style="width:98%">
                        <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
                            <div>
                                {{ session()->get("error") }}
                            </div>
                        </div>
                    </div>
                @endif

            <form action="/menu-add" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nama Menu</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="exampleFormControlInput1" value="{{ old('name') }}" placeholder="Mencintai">

                    @error('name')
                    <span class="text-danger p-2 ">
                        {{ $message }}
                    </span>
                    @enderror

                </div>

                <div class="mb-3">
                    <label for="formFile" class="form-label">Category</label>
                    <select class="form-control @error('category') is-invalid @enderror" name="category" id="formFile">
                        <option>CHOOSE ONE: </option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}" {{ old('category') == $category->id ? 'selected' : ''}}>{{ $category->categoryName }}</option>
                        @endforeach
                    </select>

                    @error('category')
                    <span class="text-danger p-2 ">
                        {{ $message }}
                    </span>
                    @enderror

                </div>

                <div class="mb-3">
                    <label for="formFile" class="form-label">Shop</label>
                    <select class="form-control @error('shop') is-invalid @enderror" name="shop" id="formFile">
                        <option>CHOOSE ONE: </option>
                        @foreach($shops as $shop)
                            <option value="{{$shop->id}}" {{ old('shop') == $shop->id ? 'selected' : ''}}>{{ $shop->name }}</option>
                        @endforeach
                    </select>

                    @error('category')
                    <span class="text-danger p-2 ">
                        {{ $message }}
                    </span>
                    @enderror

                </div>

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Harga</label>
                    <input type="text" class="form-control @error('price') is-invalid @enderror" value="{{ old('price')}}" name="price" id="exampleFormControlInput1" placeholder="Mencintai">

                    @error('price')
                    <span class="text-danger p-2 ">
                        {{ $message }}
                    </span>
                    @enderror

                </div>

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Deskripsi</label>
                    <textarea class="form-control @error('price') is-invalid @enderror" placeholder="..." name="desc" id="exampleFormControlInput1" style="height: 100px">{{ old('desc')}}</textarea>

                    @error('desc')
                    <span class="text-danger p-2 ">
                        {{ $message }}
                    </span>
                    @enderror

                </div>

                <div class="mb-3">
                    <label for="formFile" class="form-label">Gambar Menu</label>
                    <input class="form-control @error('img') is-invalid @enderror" name="img" type="file" id="formFile">

                    @error('img')
                    <span class="text-danger p-2 ">
                        {{ $message }}
                    </span>
                    @enderror

                </div>
                <button class="btn btn-primary w-100" type="submit">Add+</button>
            </form>
        </div>
    </div>
</div>


@include('partials.footer')
