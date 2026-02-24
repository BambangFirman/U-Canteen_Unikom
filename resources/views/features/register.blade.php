@include('partials.header')

<section id="login">
    <div class="container">
        <div class="row vh-100 justify-content-center align-items-center">
            <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 small-shadow p-4">

                <div class="login-card p-5 rounded-3">
                    <div class="logo-template mb-4 text-center">
                        <img src="/assets/img/logo.png" alt="Logo Unikom" class="img-fluid" style="max-height: 150px;">
                    </div>

                    <h5 class="text-white text-center mb-4">Daftar Akun Baru</h5>

                    @if(session()->has('error'))
                    <div class="row mx-auto" style="width:98%">
                        <div class="alert alert-warning d-flex align-items-center alert-dismissible fade show" role="alert">
                            <div>
                                {{ session()->get("error") }}
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                    @endif

                    <form action="/register" method="post">
                        @csrf
                        <div class="input-group rounded-3 p-1 mb-1" tabindex="0">
                            <span class="input-group-text border-0 bg-white" id="basic-addon1"><i class="bi bi-person-fill"></i></span>
                            <input type="text" class="form-control border-0 @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" placeholder="Nama Depan">
                        </div>
                        <small class="text-white p-2">
                            @error('first_name') {{ $message }} @enderror
                        </small>

                        <div class="input-group rounded-3 p-1 mb-1" tabindex="0">
                            <span class="input-group-text border-0 bg-white" id="basic-addon1"><i class="bi bi-person-fill"></i></span>
                            <input type="text" class="form-control border-0 @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" placeholder="Nama Belakang">
                        </div>
                        <small class="text-white p-2">
                            @error('last_name') {{ $message }} @enderror
                        </small>

                        <div class="input-group rounded-3 p-1 mb-1" tabindex="0">
                            <span class="input-group-text border-0 bg-white" id="basic-addon1"><i class="bi bi-person-badge-fill"></i></span>
                            <input type="text" class="form-control border-0 @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" placeholder="Username">
                        </div>
                        <small class="text-white p-2">
                            @error('username') {{ $message }} @enderror
                        </small>

                        <div class="input-group rounded-3 p-1 mb-1" tabindex="0">
                            <span class="input-group-text border-0 bg-white" id="basic-addon1"><i class="bi bi-envelope-fill"></i></span>
                            <input type="email" class="form-control border-0 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email">
                        </div>
                        <small class="text-white p-2">
                            @error('email') {{ $message }} @enderror
                        </small>

                        <div class="input-group rounded-3 p-1 mb-1" tabindex="0">
                            <span class="input-group-text bg-white border-0" id="basic-addon1"><i class="bi bi-key-fill"></i></span>
                            <input type="password" class="form-control border-0 @error('password') is-invalid @enderror" name="password" placeholder="Password">
                        </div>
                        <small class="text-white p-2">
                            @error('password') {{ $message }} @enderror
                        </small>

                        <div class="input-group rounded-3 p-1 mb-1" tabindex="0">
                            <span class="input-group-text bg-white border-0" id="basic-addon1"><i class="bi bi-key-fill"></i></span>
                            <input type="password" class="form-control border-0 @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="Konfirmasi Password">
                        </div>
                        <small class="text-white p-2">
                            @error('password_confirmation') {{ $message }} @enderror
                        </small>

                        <button type="submit" class="btn btn-outline-light w-100 mt-3">
                            <span class="fw-bold">Register</span>
                        </button>

                        <div class="text-center mt-3">
                            <span class="text-white">Sudah punya akun? <a href="/login" class="text-warning">Login</a></span>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>

@include('partials.footer')
