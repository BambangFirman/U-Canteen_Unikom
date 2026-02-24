@include('partials.header')
@include('partials.navbar')

<section id="invoice">
    <div class="container d-flex align-items-center justify-content-center vh-100">
        <div class="card text-center p-4">
            <div class="card-body">

                <i class="bi bi-check2-circle fs-1 text-success"></i><br>
                <h4 class="card-title">Pembayaran Berhasil!</h4>

                <p class="card-text pt-3">Terimakasih sudah bertransaksi di U-Canteen, Kami tunggu ordernya lagi <i class="bi bi-heart-fill text-danger"></i></p>
                <form action="/invoice/{{$id}}/download" method="post">
                    @csrf
                    <button type="submit" class="btn btn-primary">Order Detail</button>
                    <a href="/" class="btn btn-outline-secondary">Yuk! Order Lagi</a>
                </form>
            </div>
        </div>
    </div>
</section>

@include('partials.footer')
