<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Infinity Brew</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url('template') ?>/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('template') ?>/plugins/fontawesome6/css/all.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url('template') ?>/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url('template') ?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('template') ?>/dist/css/adminlte.min.css">
    <!-- AutonumericJS -->
    <script src="<?= base_url('autoNumeric') ?>/src/AutoNumeric.js"></script>
    <!-- SweetAlert -->
    <link rel="stylesheet" href="<?= base_url('template') ?>/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">
        <!-- Popup Kembalian -->
        <div class="flash-data" data-flashdata="<?= (session()->getFlashdata('kembali')) ?>"></div>
        <div class="flash-kembali" data-flashKembali="<?= (session()->getFlashdata('salahKembali')) ?>"></div>

        <!-- Session stok habis -->
        <?php if (session()->getFlashdata('pesan')) { ?>
            <div class="swalDefaultError"></div>
        <?php } ?>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container">
                <a href="<?= base_url('Transaksi/transaksiPenjualan') ?>" class="navbar-brand">
                    <i class="fas fa-cart-plus fa-lg mr-1"></i>
                    <span class="brand-text font-weight-light">Transaksi Penjualan</span>
                </a>

                <!-- Right navbar links -->
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <?php if (session()->get('level') != 1) { ?>
                        <li class="nav-item">
                            <a href="Login/logout" class="nav-link">
                                <i class="nav-icon fas fa-right-from-bracket mr-1"></i>Logout
                            </a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a href="Dashboard" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt fa-lg mr-1"></i>Dashboard
                            </a>
                        </li>
                    <?php } ?>

                </ul>
            </div>
        </nav>
        <!-- /.navbar -->

        <!-- /.navbar -->

        <div class="content-wrapper">
            <div class="content-header">
                <!-- Pemisah Navbar dan Content -->
            </div>

            <!-- Main content -->
            <div class="content">
                <div class="row">
                    <div class="col-7">
                        <div class="card card-warning card-outline">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="">No. Faktur</label>
                                            <label class="form-control form-control"><?= $no_faktur ?></label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="">Tanggal</label>
                                            <label class="form-control form-control"><?= date('d M Y') ?></label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="">Waktu</label>
                                            <label class="form-control form-control" id="jam"></label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="">Nama Kasir</label>
                                            <label class="form-control form-control"><?= session()->get('nama_user') ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.card -->
                    </div>
                    <div class="col">
                        <div class="card card-warning card-outline">
                            <div class="card-body bg-black text-right">
                                <label class="display-4 text-warning "><b>Rp. <?= number_format($total_bayar, 0) ?></b></label>
                            </div>
                        </div><!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card card-warning card-outline">
                            <div class="card-body">
                                <?= form_open(base_url('Penjualan/keranjang')) ?>
                                <div class="row">
                                    <div class="col-2">
                                        <div class="input-group">
                                            <select name="kode_produk" id="kode_produk" class="form-control select2" data-dropdown-css-class="select2-warning" style=" width: 100%;">
                                                <option selected>--Pilih Menu--</option>
                                                <?php foreach ($menu as $key => $value) { ?>
                                                    <option value="<?= $value['kode_produk'] ?>"><?= $value['nama_produk'] ?></option>
                                                <?php } ?>
                                                <option disabled="disabled">Kopi Gula Aren (Habis)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <input name="kode_produk" class="form-control" placeholder="Kode Produk" readonly>
                                    </div>
                                    <div class="col-2">
                                        <input name="nama_kategori" class="form-control" placeholder="Kategori" readonly>
                                        <!-- Nambah nama produk tapi dihide (untuk keperluan ke keranjang) -->
                                        <input name="nama_produk" hidden>
                                    </div>
                                    <div class=" col-1">
                                        <input name="nama_satuan" class="form-control" placeholder="Satuan" readonly>
                                    </div>
                                    <div class="col-2">
                                        <input name="harga_jual" class="form-control" placeholder="Harga" readonly>
                                    </div>
                                    <div class="col">
                                        <input id="qty" type="number" name="qty" min="1" value="1" class="form-control text-center" placeholder="Qty">
                                    </div>
                                    <div class="col-3">
                                        <button type="submit" class="btn btn-warning" id="keranjangBtn"><i class="fas fa-cart-arrow-down mr-1"></i>Tambahkan Pesanan</button>
                                        <a href="Penjualan/hapusKeranjang">
                                            <button type="button" class="btn btn-info"><i class="fas fa-sync mr-1"></i>Clear All</button>
                                        </a>
                                        <button id="bayarbtn" type="button" class="btn btn-success" data-toggle="modal" data-target="#bayarBtn"><i class="fas fa-cash-register mr-1"></i>Bayar</button>
                                    </div>
                                </div>
                                <?= form_close() ?>
                            </div>
                        </div><!-- /.card -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card card-warning card-outline">
                            <div class="card-body p-0">
                                <table class="table table-striped" id="tbl_keranjang">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">No.</th>
                                            <th class="text-center">Kode Produk</th>
                                            <th>Nama Produk</th>
                                            <th class="text-center">Kategori</th>
                                            <th class="text-center">Harga Satuan</th>
                                            <th class="text-center">Qty</th>
                                            <th class="text-center">Total Harga</th>
                                            <th style="width: 40px">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($keranjang as $key => $value) { ?>
                                            <tr>
                                                <td class="text-center"><?= $no++ ?></td>
                                                <td class="text-center"><?= $value['kode_produk'] ?></td>
                                                <td><?= $value['nama_produk'] ?></td>
                                                <td class="text-center"><?= $value['nama_kategori'] ?></td>
                                                <td class="text-center"><?= number_format($value['harga_jual'], 0) ?></td>
                                                <td class="text-center"><?= $value['qty'] ?></td>
                                                <td class="text-center"><?= number_format($value['total_harga'], 0) ?></td>
                                                <td>
                                                    <a href="<?= 'Penjualan/removeKeranjang/' . $value['id_jual_temp'] ?>"><button class="btn btn-danger btn-sm"><i class="fas fa-times-circle"></i></button></a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Modal BAYAR btn -->
        <div class="modal fade" id="bayarBtn">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-warning">
                        <h5 class="modal-title">Proses Pembayaran</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form name="myForm" action="Penjualan/bayar" method="POST">
                        <div class="modal-body">
                            <div class="form-group text-center">
                                <label for="">
                                    <h4><b>NAMA CUSTOMER</b></h4>
                                </label>
                                <input name="nama_customer" placeholder="Pesanan Atas Nama Siapa?" class="form-control form-control-lg" id="input" required autocomplete="off">
                            </div>
                            <hr>
                            <!-- radio -->
                            <div class="form-group text-center">
                                <label for="">
                                    <h5><b>Metode Pembayaran</b></h5>
                                </label>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input custom-control-input-warning" type="radio" id="customRadio1" name="metode" value="TUNAI" checked>
                                    <label for="customRadio1" class="custom-control-label">Tunai</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input custom-control-input-warning" type="radio" id="customRadio2" name="metode" value="NON-TUNAI">
                                    <label for="customRadio2" class="custom-control-label">Non-Tunai</label>
                                </div>
                            </div>
                            <hr>
                            <div class="elements" id="bayar_tunai">
                                <div class="form-group text-center">
                                    <label for="">
                                        <h5><b>Jumlah Uang Cash</b></h5>
                                    </label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><b>Rp.</b></span>
                                        </div>
                                        <input name="cash" id="cash" class="form-control form-control-lg" placeholder="Masukkan Nominal Uang" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
                            <button type="submit" class="btn btn-success"> <i class="fas fa-money-bill-trend-up mr-2"></i> SELESAI </button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                House Of Coffee
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2023 <a href="#">InfinityBrew</a>.</strong> All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="<?= base_url('template') ?>/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('template') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Select2 -->
    <script src="<?= base_url('template') ?>/plugins/select2/js/select2.full.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('template') ?>/dist/js/adminlte.min.js"></script>
    <!-- Swall2 -->
    <script src="<?= base_url('template') ?>/plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <!-- myScript untuk swall kembalian -->
    <script>
        const flashdata = $(".flash-data").data("flashdata");
        if (flashdata > 0) {
            Swal.fire({
                title: new Intl.NumberFormat().format(flashdata),
                text: 'Kembalian',
                icon: 'success'
            })
        }

        const flashKembali = $(".flash-kembali").data("flashkembali");
        if (flashKembali) {
            Swal.fire({
                title: 'GAGAL!',
                text: flashKembali,
                icon: 'warning'
            })
        }
    </script>
    <!-- Page specific script -->
    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()
        })
    </script>

    <!-- Script Selection Menu Makanan dan autocomplit data kesamping kanan -->
    <script>
        $(document).ready(function() {
            $('#kode_produk').focus();
            document.getElementById("keranjangBtn").disabled = true;
            $('#kode_produk').change(function() {
                var kode_produk = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('Penjualan/cekProduk') ?>",
                    data: {
                        kode_produk: kode_produk
                    },
                    dataType: "JSON",
                    success: function(response) {
                        $('[name="kode_produk"]').val(response.kode_produk);
                        $('[name="nama_kategori"]').val(response.nama_kategori);
                        $('[name="nama_satuan"]').val(response.nama_satuan);
                        $('[name="harga_jual"]').val(new Intl.NumberFormat().format(response.harga_jual));
                        $('#qty').focus();
                        // nambah tapi di hide (untuk keperluan tampilkan nama produk di keranjang)
                        $('[name="nama_produk"]').val(response.nama_produk);
                        if ((kode_produk == '--Pilih Menu--') || (kode_produk == '')) {
                            document.getElementById("keranjangBtn").disabled = true;
                        } else {
                            document.getElementById("keranjangBtn").disabled = false;
                        }
                        // document.getElementById("keranjangBtn").disabled = true;
                    }
                })
            })
        });
    </script>
    <!-- Waktu berjalan -->
    <script>
        window.onload = function() {
            startTime();
        }

        function startTime() {
            var today = new Date();
            var h = today.getHours();
            var m = today.getMinutes();
            var s = today.getSeconds();
            m = checkTime(m);
            s = checkTime(s);
            document.getElementById('jam').innerHTML = h + ":" + m + ":" + s;
            var t = setTimeout(function() {
                startTime();
            }, 1000);
        }

        function checkTime(i) {
            if (i < 10) {
                i = "0" + i
            }
            return i;
        }
    </script>

    <script>
        // Initialization Autonumeric
        // new AutoNumeric('#total_harga', {
        //     digitGroupSeparator: ',',
        //     decimalPlaces: 0,
        // });
        // new AutoNumeric('#harga_jual', {
        //     digitGroupSeparator: ',',
        //     decimalPlaces: 0,
        // });
    </script>

    <script>
        new AutoNumeric('#cash', {
            digitGroupSeparator: ',',
            decimalPlaces: 0,
        });
        // new AutoNumeric('#kembalian', {
        //     digitGroupSeparator: ',',
        //     decimalPlaces: 0,
        // });
    </script>

    <script>
        $(document).ready(function() {
            $('#bayarBtn').on('shown.bs.modal', function() {
                $('#input').trigger('focus');
            });
        });
    </script>

    <script type="text/javascript">
        var rad = document.querySelector('input[name="metode"]:checked').value;
        console.log(rad)
        rad = document.myForm.metode;
        for (var i = 0; i < rad.length; i++) {
            rad[i].onclick = function() {
                console.log(rad.value);
                if (rad.value == 'TUNAI') {
                    document.getElementById('bayar_tunai').style.display = 'block';
                } else {
                    document.getElementById('bayar_tunai').style.display = 'none';
                }
            };
        }
    </script>

    <script>
        var tbl = document.getElementById('tbl_keranjang');
        if (tbl.rows.length == 1) {
            document.getElementById("bayarbtn").disabled = true;
            console.log(tbl.rows.length)
        } else {
            document.getElementById("bayarbtn").disabled = false;
            console.log(tbl.rows.length)
        }
    </script>

    <!-- SweetAlert -->
    <script src="<?= base_url('template') ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script>
        $(function() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top',
                width: '300px',
                padding: '10px 20px 15px',
                showConfirmButton: false,
                timer: 4000
            });

            $('.swalDefaultError').show(function() {
                Toast.fire({
                    icon: 'error',
                    title: '<?= (session()->getFlashdata('pesan')) ?>'
                })
            });

        });
    </script>
</body>

</html>