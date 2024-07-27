<?= $this->extend('layout/v_template'); ?>

<?= $this->section('content'); ?>
<!-- Main content -->
<?php $pesan = session()->getFlashdata('pesan');
if (!empty($pesan)) { ?>
    <div class="swalDefaultSuccess"></div>
<?php } ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?= $jml_produk ?></h3>
                        <p>Produk</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-network-wired"></i>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><?= $jml_kategori ?></h3>
                        <p>Kategori</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-layer-group"></i>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3><?= $jml_user ?></h3>
                        <p>User</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="info-box bg-info">
                    <span class="info-box-icon"><i class="fas fa-money-bill-wave"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Income Hari Ini</span>
                        <span class="info-box-number">Rp. <?= !isset($p_hari_ini['grand_total']) ? 0 : number_format($p_hari_ini['grand_total'], 0) ?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
            <div class="col">
                <div class="info-box bg-success">
                    <span class="info-box-icon"><i class="fas fa-money-bill-wave"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Income Bulan Ini</span>
                        <span class="info-box-number">Rp. <?= !isset($p_bulan_ini['grand_total']) ? 0 : number_format($p_bulan_ini['grand_total'], 0) ?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
            <div class="col">
                <div class="info-box bg-danger">
                    <span class="info-box-icon"><i class="fas fa-money-bill-wave"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Income Tahun Ini</span>
                        <span class="info-box-number">Rp. <?= !isset($p_tahun_ini['grand_total']) ? 0 : number_format($p_tahun_ini['grand_total'], 0) ?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
        </div>

        <!-- Info Penjualan -->
        <div class="row">
            <div class="col">
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">Info Penjualan Perkategori</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chartjs-size-monitor">
                            <div class="chartjs-size-monitor-expand">
                                <div class=""></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink">
                                <div class=""></div>
                            </div>
                        </div>

                        <!-- Chart -->
                        <div>
                            <!-- <canvas id="myChart" height="40vw" width="80vw"></canvas> -->
                            <canvas id="myChart" style="min-height: 275px; height: 275px; max-height: 275px; max-width: 100%; display: block; width: 325px;" width="260" height="200" class="chartjs-render-monitor"></canvas>
                        </div>

                        <?php
                        if ($grafikDonat == null) {
                            $namaKategori[] = [];
                            $jumlahTerjual[] = [];
                        } else {
                            foreach ($grafikDonat as $key => $value) {
                                $namaKategori[] = $value['nama_kategori'];
                                $jumlahTerjual[] = $value['jumlah_terjual'];
                            }
                        }
                        ?>

                        <script>
                            const ctx = document.getElementById('myChart');
                            new Chart(ctx, {
                                type: 'doughnut',
                                data: {
                                    labels: <?= json_encode($namaKategori) ?>,
                                    datasets: [{
                                        label: 'Jumlah Terjual Keseluruhan',
                                        data: <?= json_encode($jumlahTerjual) ?>,
                                        backgroundColor: [
                                            'rgba(255, 99, 132, 0.9)',
                                            'rgba(54, 162, 235, 0.9)',
                                            'rgba(255, 205, 86, 0.9)',
                                            'rgba(155, 100, 90, 0.9)',
                                            'rgba(55, 205, 76, 0.9)',
                                            'rgba(100, 5, 90, 0.9)'
                                        ],
                                        hoverOffset: 10
                                    }]
                                }
                            })
                        </script>

                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>

        <!-- Grafik Penjualan -->
        <div class="row">
            <div class="col">
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">Grafik Penjualan Pertransaksi</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chartjs-size-monitor">
                            <div class="chartjs-size-monitor-expand">
                                <div class=""></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink">
                                <div class=""></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-3">
                                <div class="card bg-info">
                                    <div class="card-header">
                                        Pilih Periode
                                    </div>
                                    <div class="card-body bg-white">
                                        <?= form_open('Dashboard') ?>
                                        <div class="form-group">
                                            <label for="">Tanggal Awal :</label>
                                            <input type="date" name="tgl_awal" class="form-control" value="<?= $blnAwal ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Tanggal Akhir :</label>
                                            <input type="date" name="tgl_akhir" class="form-control" value="<?= $blnAkhir ?>" required>
                                        </div>
                                        <div class="form-group float-right">
                                            <button class="btn btn-info" type="submit"><i class="fas fa-search"></i> Cari</button>
                                        </div>
                                        <?= form_close() ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-9 grafikPenjualan">

                                <!-- Chart -->
                                <div>
                                    <canvas id="myChart2" style="min-height: 275px; height: 325px; max-height: 325px; max-width: 100%; width: 325px;" width="260" height="200"></canvas>
                                </div>

                                <?php
                                if ($grafik == null) {
                                    $tgl[] = [];
                                    $total[] = [];
                                } else {
                                    foreach ($grafik as $key => $value) {
                                        $tgl[] = $value['tgl_jual'];
                                        $total[] = $value['jumlah'];
                                    }
                                }
                                ?>

                                <script>
                                    const ctx2 = document.getElementById('myChart2');
                                    new Chart(ctx2, {
                                        type: 'bar',
                                        data: {
                                            labels: <?= json_encode($tgl) ?>,
                                            datasets: [{
                                                label: 'Jumlah Terjual',
                                                data: <?= json_encode($total) ?>,
                                                backgroundColor: [
                                                    'rgba(255, 159, 64, 0.2)',
                                                    'rgba(75, 192, 192, 0.2)',
                                                ],
                                                borderColor: [
                                                    'rgb(255, 159, 64)',
                                                    'rgb(75, 192, 192)',
                                                ],
                                                borderWidth: 1
                                            }]
                                        },
                                        options: {
                                            scales: {
                                                y: {
                                                    suggestedMin: 0,
                                                    // suggestedMax: 10
                                                    ticks: {
                                                        stepSize: 1
                                                    }
                                                }
                                            }
                                        }
                                    })
                                </script>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <script>
    function tampilGrafik() {
        $.ajax({
            type: "post",
            url: "/Dashboard/index",
            data: {
                awal: '2023-06-01',
                akhir: '2023-06-10'
            },
            dataType: "json",
            success: function(response) {
                // if (response.data) {
                //     $('.grafikPenjualan').html(response.data)
                // }
            },
            // error: function(xhr, ajaxOptions, thrownError) {
            //     alert(xhr.status + '\n' + thrownError);
            // }

        })
    }

    $(document).ready(function() {
        tampilGrafik();
    });
</script> -->
<?= $this->endSection(); ?>