@include('partials.header')
@include('partials.navbar')

<section id="menu">
    <div class="container p-5">
        <h3 class="title">TOKO {{ strtoupper($shop->name) }}</h3>
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item " aria-current="page"><a href="/">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Toko {{ ucwords(\Illuminate\Support\Str::slug($shop->name, ' ')) }}</li>
            </ol>
        </nav>

        <div class="row">

            @php
                $previousCategory = null;
            @endphp

            @foreach($menus as $menu)

                @if($menu->categoryName != $previousCategory)
                    <figure class="mt-5">
                        <blockquote class="blockquote">
                            <p>{{ $menu->categoryName}}</p>
                        </blockquote>
                        <figcaption class="blockquote-footer">
                            {{ $menu->category_desc }}
                        </figcaption>
                    </figure>
                @endif

                <div class="col-sm-6 col-md-6 col-lg-6 ">
                    <div class="card mb-3 " style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4" style="background: url('/storage/img/shops/menus/{{ $menu->img }}'); background-size: cover; background-position: center">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{ ucwords($menu->menuName) }}</h5>
                                    <hr>
                                    <h5 class="card-title">Rp. {{ number_format($menu->price) }},-</h5>
                                    <p class="card-desc pt-2">{{ $menu->menu_desc }}</p>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <form action="/{{ strtolower(\Illuminate\Support\Str::slug($menu->menuName)) }}/{{ $menu->id }}" method="post">
                                        @csrf
                                        <button class="CartBtn m-3" type="submit">
                                          <span class="IconContainer">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512" fill="white" class="cart"><path d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"></path></svg>
                                          </span>
                                            <p class="text">Add Menu</p>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @php
                $previousCategory = $menu->categoryName;
            @endphp
            @endforeach

            @if(session()->has('error'))
                <script>
                    swal( "Oops" ,  "{{ session()->get('error') }}" ,  "error" )
                </script>
            @endif

            @if(session()->has('success'))
                <script>
                    swal("Good job!", "{{ session()->get('success') }}", "success");
                </script>
            @endif

        </div>
    </div>
</section>


@include('partials.footer')

