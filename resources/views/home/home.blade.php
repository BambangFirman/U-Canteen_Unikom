@include('partials.header')
@include('partials.navbar')

<section id="shop">
    <div class="container p-5">
        <h3 class="title">WELCOME TO U-CANTEEN</h3>
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Beranda</li>
            </ol>
        </nav>

        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get("success") }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            @foreach($allShopData ?? [] as $get)

                <div class="col-sm-6 col-md-6 col-lg-4">
                    <div class="card mb-3 mt-5 p-4" style="max-width: 540px;">
                        <div class="row g-0 align-items-center">
                            <div class="col col-md-5">
                                <img src="/storage/img/shops/featured/{{ $get->img }}" class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col col-md-7">
                                <div class="card-body text-center">
                                    <h1 class="card-title text-white">TOKO</h1>
                                    <center>
                                        <a href="/{{ strtolower(\Illuminate\Support\Str::slug($get->name)) }}/menu" class="btn">
                                            <span class="text-body-tertiary">Lihat</span>
                                            <svg width="34" height="34" viewBox="0 0 74 74" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="37" cy="37" r="35.5" stroke="black" stroke-width="3"></circle>
                                                <path d="M25 35.5C24.1716 35.5 23.5 36.1716 23.5 37C23.5 37.8284 24.1716 38.5 25 38.5V35.5ZM49.0607 38.0607C49.6464 37.4749 49.6464 36.5251 49.0607 35.9393L39.5147 26.3934C38.9289 25.8076 37.9792 25.8076 37.3934 26.3934C36.8076 26.9792 36.8076 27.9289 37.3934 28.5147L45.8787 37L37.3934 45.4853C36.8076 46.0711 36.8076 47.0208 37.3934 47.6066C37.9792 48.1924 38.9289 48.1924 39.5147 47.6066L49.0607 38.0607ZM25 38.5L48 38.5V35.5L25 35.5V38.5Z" fill="black"></path>
                                            </svg>
                                        </a>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="row tagline">
                            <div class="col-md-12">
                                <h4 class="shop-name text-center text-white pt-3">{{ strtoupper($get->name) }}</h4>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
        </div>


    </div>
</section>



@include('partials.footer')
