<nav class="navbar navbar-expand-lg navbar-light fixed-top">
    <div class="container">
        <a class="navbar-brand" href="/"><img src="/assets/img/brand.png"></a>


            <div class="row justify-content-end">
                <div class="col d-flex align-items-center">
                    <a class="me-1" aria-current="page" href="/checkout">
                        <i class="fa-solid fa-cart-shopping fa-lg" style="color: #f2f2f2;"></i>
                    </a>
                    <span class="count-cart bg-primary">{{ $qtyTotal }}</span>
                </div>
                <div class="col">
                    <form id="logout-form" action="/logout" method="post">
                        @csrf
                        <button id="btn-logout" type="submit" class="Btn">
                            <div class="sign"><svg viewBox="0 0 512 512"><path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path></svg></div>
                        </button>
                    </form>
                </div>
            </div>
    </div>
</nav>
<div class="alert alert-warning alert-dismissible fade show position-absolute w-100 after-navbar text-center" role="alert" style="margin-top: -3rem">
    <i class="fa-solid fa-clock"></i> <strong>Info:</strong> Kantin buka dari pukul <strong>08:00</strong> sampai <strong>16:00</strong>
    @if(!empty($userName))
        <span class="mx-2">|</span> <i class="fa-solid fa-hand-wave"></i> Halo, <strong>{{ $userName }}</strong>! 👋 Selamat datang
    @endif
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

