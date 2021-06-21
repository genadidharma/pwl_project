<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Pembelian Obat ID#{{$transaksi->id}}</title>

    <!-- Favicon -->
    <link rel="icon" href="./images/favicon.png" type="image/x-icon" />

    <!-- Invoice styling -->
    <style>
        body {
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            text-align: center;
            color: #777;
        }

        body h1 {
            font-weight: 300;
            margin-bottom: 0px;
            padding-bottom: 0px;
            color: #000;
        }

        body h3 {
            font-weight: 300;
            margin-top: 10px;
            margin-bottom: 20px;
            font-style: italic;
            color: #555;
        }

        body a {
            color: #06f;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }
    </style>
</head>

<body>

    <div class="invoice-box">
        <table>
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                Struk Obat
                            </td>

                            <td>
                                Struk ID: {{$transaksi->id}} <br />
                                Kasir: {{$transaksi->user->nama}} <br />
                                Dibuat: {{Carbon\Carbon::parse($transaksi->created_at)->format('l, d M')}}<br />
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
                                Petto Inc.<br />
                            </td>

                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <table>
            <tr class="heading">
                <td>No</td>
                <td>Nama</td>
                <td>Jumlah</td>
                <td>Harga Satuan(Rp)</td>
                <td>Total(Rp)</td>
            </tr>

            @foreach ($transaksi->resep_obat as $index=>$resep_obat)
            <tr class="item">
                <td>{{$index+=1}}</td>
                <td>{{$resep_obat->barang->nama}}</td>
                <td>{{$resep_obat->jumlah}}</td>
                <td>@idr($resep_obat->barang->harga_satuan)</td>
                <td>@idr($resep_obat->total)</td>
            </tr>
            @endforeach

            <tr class="total">
                <td colspan="5" style="text-align: right;">Total Transaksi: @idr_sign($transaksi->total_harga)</td>
            </tr>
            <tr class="total">
                <td colspan="5" style="text-align: right;">PPN(10%): @idr_sign($transaksi->total_ppn)</td>
            </tr>
            <tr class="total">
                <td colspan="5" style="text-align: right;">Total Biaya: <b>@idr_sign($transaksi->total_harga+$transaksi->total_ppn)</b></td>
            </tr>

        </table>

        <hr/>

        <table>
            <tr class="total">
                <td colspan="5" style="text-align: right;"> Uang: <b>@idr_sign($transaksi->uang)</b></td>
            </tr>
            <tr class="total">
                <td colspan="5" style="text-align: right;">Kembalian: <b>@idr_sign($transaksi->uang-($transaksi->total_harga+$transaksi->total_ppn))</b></td>
            </tr>
        </table>
        
    </div>
</body>

</html>