@include('partials.header')

<section id="login">
    <div class="container">
        <div class="row vh-100 justify-content-center align-items-center">
            <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 small-shadow p-4">

                <div class="login-card p-5 rounded-3">
                    <div class="logo-template mb-5 text-center">
                        <img src="/assets/img/logo.png" alt="Logo Unikom" class="img-fluid">
                    </div>

                    @if(session()->has('success'))
                    <div class="row mx-auto" style="width:98%">
                        <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
                            <div>
                                {{ session()->get("success") }}
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                    @endif

                    @if(session()->has('error'))
                    <div class="row mx-auto" style="width:98%">
                        <div class="alert alert-warning d-flex align-items-center alert-dismissible fade show" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </svg>
                            <div>
                                {{ session()->get("error") }}
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                    @endif



                    <form action="/login" method="post">
                        @csrf
                        <div class="input-group rounded-3 p-1" tabindex="0">
                            <span class="input-group-text border-0 bg-white" id="basic-addon1"><i class="bi bi-person-fill"></i></span>
                            <input type="text" class="form-control border-0 @error('username') is-invalid @enderror" name="username" id="floatingInput" value="{{ old('username') }}" placeholder="Username">
                        </div>

                        <small class="text-white p-2">
                            @error('username')
                            {{ $message }}
                            @enderror
                        </small>

                        <div class="input-group rounded-3 p-1" tabindex="0">
                            <span class="input-group-text bg-white border-0" id="basic-addon1"><i class="bi bi-key-fill"></i></span>
                            <input type="password" class="form-control border-0 @error('password') is-invalid @enderror" name="password" id="floatingPassword" placeholder="Password">
                        </div>

                        <small class="text-white position-relative p-2">
                            @error('password')
                            {{ $message }}
                            @enderror
                        </small>

                        <div class="forgot-password text-end mb-3">
{{--                            <span>--}}
{{--                                <a class="text-white" href="/forgot">Lupa password?</a>--}}
{{--                            </span>--}}
                        </div>

                        <button type="submit" class="btn btn-outline-light w-100">
                            <span class="fw-bold">Log in</span>
                        </button>

                        <div class="text-center mt-3">
                            <span class="text-white">Belum punya akun? <a href="/register" class="text-warning">Daftar</a></span>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>

@include('partials.footer')
