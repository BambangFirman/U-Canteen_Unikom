<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <style>
        body{
            overflow: hidden;
        }
        #invoice-template {
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #777;
        }

        #invoice-template h1 {
            font-weight: 900;
            color: #000;
        }

        #invoice-template a {
            color: #06f;
        }

        #invoice-template .invoice-box {
            position: relative;
            width: 600px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 20px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
            page-break-inside: avoid;
        }

        #invoice-template .invoice-box .logo-background{
            position: absolute;
            width: 100%;
            height: 50%;
            opacity: 0.1;
            background: url("{{ public_path('assets/img/logo.png') }}");
            transform: translate(28%, 38%);
            background-repeat: no-repeat;
            z-index: 1;
        }

        #invoice-template .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }

        #invoice-template .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        #invoice-template .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        #invoice-template .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        #invoice-template .invoice-box table tr.information table td {
            padding-bottom: 20px;
        }

        #invoice-template .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        #invoice-template .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        #invoice-template .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        #invoice-template .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        #invoice-template .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }
    </style>
<body>
    <section id="invoice-template">
        <div class="invoice-box">
            <div class="logo-background"></div>
            <table>
                @foreach($invoiceData as $invoice)
                    @if($loop->first)
                        <tr class="top">
                            <td colspan="2">
                                <table>
                                    <tr>

                                        <td class="title" colspan="2" align="center" style="line-height: 5px">
                                            <h1>#{{$invoice->invoice}}</h1><br>
                                            Dibuat: {{ \Illuminate\Support\Carbon::parse($invoice->created_at)->format('j F, Y') }}
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr class="information">
                            <td colspan="2">
                                <table>
                                    <tr>
                                        <td>

                                        </td>

                                        <td>
                                            Hormat Kami, <br />
                                            <b>U-Canteen</b><br />
                                            ucanteen@unikom.ac.id
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr class="heading">
                            <td>Pelanggan</td>

                            <td></td>
                        </tr>

                        <tr class="item">
                            <td>Nama Pelanggan</td>

                            <td>{{ $userData->first_name . ' ' . $userData->last_name  }}</td>
                        </tr>

                        <tr class="details item">
                            <td>Email</td>

                            <td>{{ $userData->email }}</td>
                        </tr>

                        <tr class="heading">
                            <td>Metode Pembayaran</td>

                            <td>Jumlah Bayar #</td>
                        </tr>

                        <tr class="details">
                            <td>{{ $invoice->billing_method }}</td>

                            <td>Rp. {{ number_format($invoiceData->sum('total_price')) }}</td>
                        </tr>

                        <tr class="heading">
                            <td>Menu</td>
                            <td>Harga</td>
                        </tr>
                    @endif

                    <tr class="item">
                        <td>{{ $invoice->menuName . " ( x$invoice->quantity)" }}</td>

                        <td>Rp. {{ number_format($invoice->total_price) }}</td>
                    </tr>

                    @if($loop->last)
                        <tr class="total">
                            <td></td>

                            <td>Total: Rp. {{ number_format($invoiceData->sum('total_price')) }}</td>
                        </tr>
                        <tr class="heading">
                            <td colspan="2" align="center">
                                <b>Jam Pengambilan</b> : {{ \Illuminate\Support\Carbon::parse($invoice->pickup_time)->format('H:i') }}
                            </td>
                        </tr>
                    @endif

                @endforeach
            </table>
        </div>
    </section>
</body>
</html>
