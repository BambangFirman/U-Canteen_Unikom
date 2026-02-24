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

            <form action="/shop-add" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nama Toko</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="exampleFormControlInput1" placeholder="Mencintai">

                    @error('name')
                    <span class="text-danger p-2 ">
                        {{ $message }}
                    </span>
                    @enderror

                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Profile Toko</label>
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
