@extends('template/layout')

@push('style')
<!-- <style>
    .tile_count {
            margin-bottom: 20px;
            /* Menambahkan margin bawah */
        }

        .tile_stats_count {
            background-color: #f9f9f9;
            /* Warna latar belakang */
            border: 1px solid #ddd;
            /* Warna border */
            border-radius: 5px;
            /* Sudut border */
            padding: 15px;
            /* Padding konten */
        }

        .tile_stats_count .count_top {
            font-weight: bold;
            /* Menambahkan ketebalan teks */
        }

        .tile_stats_count .count p {
            margin: 5px 0;
            /* Menambahkan margin atas dan bawah untuk setiap paragraf */
        }

        .tile_stats_count .count p:last-child {
            margin-bottom: 0;
            /* Menghapus margin bawah untuk paragraf terakhir */
        }

        .tile_stats_count .count p i {
            margin-right: 5px;
            /* Menambahkan margin kanan antara ikon dan teks */
        }
    </style> -->
@endpush

@section('content')
    <section class="content">
        <div class="right_col" role="main">
            <!-- /top tiles -->
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="dashboard_graph">
                        <div class="row x_title">
                            <div class="col-md-6">
                                <h3>
                                    PROJECT UJIKOM
                                    <h3>CHASIER GACORAN</h3>
                                </h3>
                            </div>
                            <div class="col-md-6">
                                <div id="reportrange" class="pull-right"
                                    style="
                                    background: #fff;
                                    cursor: pointer;
                                    padding: 5px 10px;
                                    border: 1px solid #ccc;
                                ">
                                    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                    <span>December 30, 2014 - January 28, 2015</span>
                                    <b class="caret"></b>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-3 bg-white">
                                <div class="x_title">
                                <h2>Dashboard</h2>
                                    <div class="float-right ml-auto">
                                        
                                        <!-- <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#modalFormJenis">
                                            Tambah Jenis
                                        </button>
                                        <a href="{{ route('export-jenis')}}" class="btn btn-success">
                                            <i class="fa fa-file-excel"></i> Export
                                        </a>
                                        <a href="{{ route('export-jenis-pdf')}}" class="btn btn-danger">
                                            <i class="fa fa-file-pdf"></i> Export PDF
                                        </a>
                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#formImport">
                                            <i class="fas fa-file-excel"></i> Import
                                        </button> -->

                                        <form action="{{ url('/data') }}" method="GET" style="display: flex; align-items: center;">
                                            <label for="tanggal_awal" style="margin-right: 5px;">Dari Tanggal:</label>
                                                <input type="date" class="form-control" id="tanggal_awal"
                                                    value="{{ $tanggal_awal ?? '' }}" name="tanggal_awal"
                                                        style="width: 150px; margin-right: 10px;">

                                            <label for="tanggal_akhir" style="margin-right: 5px;">Sampai Tanggal:</label>
                                                <input type="date" class="form-control" id="tanggal_akhir"
                                                    value="{{ $tanggal_akhir ?? '' }}" name="tanggal_akhir"
                                                    style="width: 150px; margin-right: 10px;">

                                            <button type="submit" class="btn btn-primary">Filter</button>
                                        </form>
                                    </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="card-body">
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                            </ul>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" \
                                            aria-label="Close">
                                        </button>
                                    </div>
                                @endif
                                <div class="mt-3">
                                              <!-- top tiles -->
                                    <div class="tile_count">
                                        <div class="col-md-2 col-sm-4  tile_stats_count">
                                            <span class="count_top"> <i class="fa-solid fa-basket-shopping"></i>Jumlah Transaksi</span>
                                                <div class="count "></i>{{ $count_transaksi }}</div>
                                            <span class="count_bottom"><i class="green"></i></i>Transaksi</span>
                                        </div>
                                        <div class="col-md-1 col-sm-4 ">
                                        </div>
                                        <div class="col-md-2 col-sm-4  tile_stats_count">
                                            <span class="count_top"><i class="fa-solid fa-money-bill-1-wave"></i> Jumlah Pendapatan</span>
                                                <div class="count green ">{{ number_format($pendapatan, 2) }}</div>
                                            <span class="count_bottom"><i class="green"> </i> </span>
                                        </div>
                                        <div class="col-md-1 col-sm-4 ">
                                        </div>
                                        <div class="col-md-2 col-sm-4  tile_stats_count">
                                            <span class="count_top"><i class="fa-solid fa-utensils"></i> Jumlah Menu</span>
                                            <div class="count">{{ $count_menu }}</div>
                                            <span class="count_bottom"><i class="green"> </i> Menu Yang Tersedia </span>
                                        </div>
                                        <div class="col-md-1 col-sm-4 ">
                                            </div>
                                            <div class="col-md-2 col-sm-4  tile_stats_count">
                                                <span class="count_top"><i class="fa-solid fa-database"></i> Sisa stok</span>
                                                <div class="count">{{ $sisaStok }}</div>
                                                <span class="count_bottom"><i class="green"></i> Sisa Stok</span>
                                            </div>
                                            <div class="col-md-1 col-sm-4 ">
                                                </div>
                                            </br>
                                            <!-- <div class="col-md-3 col-sm-4  tile_stats_count">
                                                <span class="count_top"><i class="fa-regular fa-calendar-days"></i></i>Jumlah Transaksi Saat Ini</span>
                                                <div class="count">0</div>
                                        <span class="count_bottom"><i class="red"></i></i>Jumlah transaksi hari ini</span>
                                        </div> -->
                                            <!-- <div class="col-md-2 col-sm-4  tile_stats_count">
                                                <span class="count_top"><i class="fa fa-user"></i> Total Collections</span>
                                            <div class="count">2,315</div>
                                        <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
                                        </div> -->
                                            <!-- <div class="col-md-2 col-sm-4  tile_stats_count">
                                                <span class="count_top"><i class="fa fa-user"></i> Total Connections</span>
                                            <div class="count">7,325</div>
                                        <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
                                        </div> -->
                                        <!-- <div class="col-md-8 col-sm-6  ">
                                            <div class="x_panel">
                                                <div class="x_title">
                                                    <h2>Grafik Penjualan</h2>
                                                    <ul class="nav navbar-right panel_toolbox">
                                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                    </li>
                                                    <li class="dropdown">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item" href="#">Settings 1</a>
                                                            <a class="dropdown-item" href="#">Settings 2</a>
                                                        </div>
                                                    </li>
                                                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                                                </li>
                                                    </ul>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="x_content">
                                                    <canvas id="mybarChart"></canvas>
                                                </div>
                                                </div>
                                            </div>
                                        </div> -->
                                        <!-- <ul class="list-unstyled top_profiles scroll-view">
                                            @foreach ($pelanggan  as $p)
                                            <li class="media event">
                                                <a class="pull-left border-aero profile_thumb">
                                                    <i class="fa fa-user aero"></i>
                                                </a>
                                                <div class="media-body">
                                                    <a class="title" >{{ $p->nama }}</a>
                                                    <p><strong>{{ $p->email }}</strong> {{ $p->no_tlp }}</p>
                                                    <p> <small>{{ $p->alamat }}</small>
                                                </p>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>  -->
                                    <!-- <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4>Pendapatan per Tanggal</h4>
                                                </div>
                                                <div class="card-body">
                                                    <canvas id="pendapatanPerTanggalChart" width="400" height="200"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="col-md-12 col-sm-5  ">
                                        <div class="x_panel">
                                            <div class="x_title">
                                                <h2>Bar graph <small>Sessions</small></h2>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="x_content">
                                                <canvas id="pendapatanPerTanggalChart"></canvas>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-5 ">
                                        <div class="x_panel tile fixed_height_330">
                                            <div class="x_title">
                                                <h2>Top 5 Penjualan</h2>
                                                <ul class="nav navbar-right panel_toolbox">
                                                    </ul>
                                                    <div class="clearfix"></div>
                                                </div>
                                                    @foreach ($most_ordered_menu as $menu => $count)
                                                        @php
                                                            // Temukan objek menu sesuai dengan nama_menu
                                                            $menuObject = \App\Models\Menu::where('nama_menu', $menu)->first();
                                                        @endphp
                                                        @if ($menuObject)
                                                            <div class="d-flex align-items-center mb-2">
                                                                <!-- Gunakan URL yang sesuai untuk mengakses gambar -->
                                                                <img src="{{ asset('images/' . $menuObject->image) }}"
                                                                    alt="{{ $menuObject->nama_menu }}" class="mr-2"
                                                                    style="width: 50px; height: 50px;">
                                                                <p>{{ $menuObject->nama_menu }}: {{ $count }}</p>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                            </div>
                                        </ul>
                                    </div>
                                    <div class="col-md-4 col-sm-5 ">
                                        <div class="x_panel tile fixed_height_330">
                                            <div class="x_title">
                                                <h2>Transaksi Terbaru</h2>
                                                <ul class="nav navbar-right panel_toolbox">
                                                    </ul>
                                                    <div class="clearfix"></div>
                                                </div>
                                                 @foreach ($latest_transactions as $transaction)
                                                    <li class="list-group-item">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <p>{{ $transaction->created_at }}</p>
                                                            <p>Total: Rp{{ $transaction->subtotal }}</p>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </div>
                                        </ul>
                                    </div>
                                    <div class="col-md-4 col-sm-5 ">
                                        <div class="x_panel tile fixed_height_330">
                                            <div class="x_title">
                                                <h2>Stok Ter Rendah</h2>
                                                <ul class="nav navbar-right panel_toolbox">
                                                    </ul>
                                                    <div class="clearfix"></div>
                                                </div>
                                                @foreach ($stokTerendah as $stok)
                                                    <img src="{{ asset('images/' . $stok->menu->image) }}"
                                                        alt="{{ $stok->menu->nama_menu }}" class="mr-3"
                                                        style="width: 50px; height: 50px;">
                                                        <p> {{ $stok->menu->nama_menu }} </p> 
                                                        <p> Jumlah: {{ $stok->jumlah }}  </p>
                                                @endforeach
                                            </div>
                                        </ul>
                                    </div>
                                    <!-- Button trigger modal -->
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!-- include -->
    </section>
    <!-- include -->
@endsection

@push('script')
    <!-- <script>
        $('#tbl-jenis').DataTable()
        window.onload = function() {
            var dataPenjualan = [];
            var dataJmlTransaksi = [];

            var chart;

            $.get("{{ url('data_penjualan')}}/0", function(data) {
            console.log(data)
            $.each(data, function(key, value) {
                let dat = value['tanggal'];
                let year = dat.substring(0, 4);
                let month = dat.substring(5, 7) - 1;
                let day = dat.substring(8, 10);
                // console.log(year+"-"+month+"-"+day);
                dataPenjualan.push({
                x: new Date(year, month, day),
                y: parseInt(value['total_bayar'])
                });

                dataJmlTransaksi.push({
                x: new Date(year, month, day),
                y: parseInt(value['jumlah'])
                });
            });

            chart = new CanvasJS.Chart("chart", {
                title: {
                text: "Grafik Pendapatan"
                },
                axisY: {
                title: "Penjualan",
                lineColor: "#C24642",
                tickColor: "#C24642",
                labelFontColor: "#C24642",
                titleFontColor: "#C24642",
                includeZero: true,
                suffix: ""
                },
                axisY2: {
                title: "Pendapatan",
                lineColor: "#7F6084",
                tickColor: "#7F6084",
                labelFontColor: "#7F6084",
                titleFontColor: "#7F6084",
                includeZero: true,
                prefix: "",
                suffix: ""
                },
                toolTip: {
                shared: true
                },
                legend: {
                cursor: "pointer",
                itemclick: toggleDataSeries
                },
                data: [{
                    type: "line",
                    name: "Penjualan",
                    color: "#C24642",
                    axisYIndex: 0,
                    showInLegend: true,
                    dataPoints: dataJmlTransaksi
                },
                {
                    type: "line",
                    name: "Pendapatan",
                    color: "#7F6084",
                    axisYType: "secondary",
                    showInLegend: true,
                    dataPoints: dataPenjualan
                }
                ]
            });
            chart.render();
            updateChart();
            });


            function updateChart() {
            $.get("{{ url('data_penjualan')}}/" + dataJmlTransaksi.length, function(data) {
                console.log(data)
                $.each(data, function(key, value) {
                let date = value['tanggal'];
                let year = date.substring(0, 4);
                let month = date.substring(5, 7) - 1;
                let day = date.substring(8, 10);
                console.log(year + "-" + month + "-" + day);
                dataPenjualan.push({
                    x: new Date(year, month, day),
                    y: parseInt(value['total_bayar'])
                });

                if (dataPenjualan.length == 1)
                    dataJmlTransaksi.pop({
                    x: new Date(year, month, day),
                    y: parseInt(value['jumlah'])
                    });
                else
                    dataJmlTransaksi.push({
                    x: new Date(year, month, day),
                    y: parseInt(value['jumlah'])
                    });

                });
            });
            chart.render();
            setTimeout(function() {
                updateChart()
            }, 10000);
            }

            function toggleDataSeries(e) {
            if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                e.dataSeries.visible = false;
            } else {
                e.dataSeries.visible = true;
            }
            e.chart.render();
            }

        }
    </script> -->
      <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js" integrity="sha512-L0Shl7nXXzIlBSUUPpxrokqq4ojqgZFQczTYlGjzONGTDAcLremjwaWv5A+EDLnxhQzY5xUZPWLOLqYRkY0Cbw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
        <script>
            // Mendapatkan data pendapatan per tanggal dari PHP
            var pendapatanPerTanggalData = {!! $pendapatan_per_tanggal !!};
            // Memformat data untuk Chart.js
            var labels = [];
            var data = [];
            pendapatanPerTanggalData.forEach(function(item) {
                labels.push(item.tanggal);
                data.push(item.total_pendapatan);
            });

            // Menggambar grafik pendapatan per tanggal
            var ctx = document.getElementById('pendapatanPerTanggalChart').getContext('2d');
            var pendapatanPerTanggalChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Pendapatan per Tanggal',
                        data: data,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        </script>
@endpush