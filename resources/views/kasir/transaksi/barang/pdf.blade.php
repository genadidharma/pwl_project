<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{config('app.name')}}</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.svg')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('assets/vendors/iconly/bold.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/bootstrap-icons/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/simple-datatables/style.css')}}">
</head>
<body>
    <section class="section">
        <div class="row">
            <div class="col-xl-8 col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-between">
                        <h4 class="align-self-center">Daftar Barang</h4>
                        <a href="{{route('transaksi.barang.show',['barang'=>$transaksi->id,'print'=>'true'])}}" class="btn btn-danger ms-auto m-3"> <i class="icon-mid bi-file-earmark-arrow-down"></i> Download PDF</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="table2">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th width="50%">Nama</th>
                                    <th>Jumlah</th>
                                    <th>Harga Satuan(Rp)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaksi->barang as $index=>$barang)
                                <tr>
                                    <td>{{$index+=1}}</td>
                                    <td>{{$barang->nama}}</td>
                                    <td>{{$barang->jumlah}}</td>
                                    <td>{{$barang->harga_satuan}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    
            <div class="col-xl">
                <div class="card">
                    <div class="card-header">
                        <h4>Ringkasan Pembayaran</h4>
                    </div>
    
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <p>Total Transaksi</p>
                            </div>
                            <div class="col">
                                <p class="text-end">{{$transaksi->total_harga}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p>PPN(10%)</p>
                            </div>
                            <div class="col">
                                <p class="text-end">{{$transaksi->total_ppn}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p>Total Biaya</p>
                            </div>
                            <div class="col">
                                <p class="fw-bold text-end">{{$transaksi->total_harga+$transaksi->total_ppn}}</p>
                            </div>
                        </div>
                    </div>
    
                    <div class="card-footer bg-light">
                        <div class="row">
                            <div class="col">
                                <p>Uang</p>
                            </div>
                            <div class="col">
                                <p class="fw-bold text-end">{{$transaksi->uang}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p>Kembalian</p>
                            </div>
                            <div class="col">
                                <p class="fw-bold text-end">{{$transaksi->uang-($transaksi->total_harga+$transaksi->total_ppn)}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="{{asset('assets/vendors/simple-datatables/simple-datatables.js')}}"></script>
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);

        let table2 = document.querySelector('#table2')
        let datataTable = new simpleDatatables.DataTable(table2, {
            searching: false
        })
    </script>
    <script>
        feather.replace()
    </script>

    <script src="{{asset('assets/js/main.js')}}"></script>    
</body>
</html>