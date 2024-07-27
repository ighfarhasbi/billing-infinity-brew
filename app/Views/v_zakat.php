<?= $this->extend('layout/v_template'); ?>

<?= $this->section('content'); ?>
<!-- Main content -->
<div class="content">
    <?php if (session()->getFlashdata('pesan')) { ?>
        <div class="swalDefaultSuccess"></div>
    <?php } ?>
    <div class="col-md-12">
        <div class="card card-warning shadow-lg">
            <div class="card-header">
                <h3 class="card-title mt-1">Zakat</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#selesai-semua">
                        <i class="fas fa-circle-check"></i> Selesaikan Semua
                    </button>
                </div>
            </div>
            <div class=" card-body">
                <div class="table-responsive">
                    <table id="example10" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width=50px class="text-center">#</th>
                                <th>Kode Produk</th>
                                <th>Nama Produk</th>
                                <th class="text-center">Modal Pokok</th>
                                <th class="text-center">qty</th>
                                <th class="text-center">Besar Zakat</th>
                                <th width=10px class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($dataZakat as $key => $value) { ?>
                                <tr>
                                    <td class="text-center"><?= $no++ ?></td>
                                    <td><?= $value['kode_produk'] ?></td>
                                    <td><?= $value['nama_produk'] ?></td>
                                    <td class="text-center"><?= number_format($value['modal_pokok'], 0) ?></td>
                                    <td class="text-center"><?= $value['qty'] ?></td>
                                    <td class="text-center"><?= number_format($value['zakat'], 0) ?></td>
                                    <td>
                                        <div class="row">
                                            <button class="btn btn-success btn-sm ml-3" data-toggle="modal" data-target="#hapus-zakat<?= $value['id_zakat'] ?>"><i class="fas fa-circle-check"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan=" 5">Total</th>
                                <th id="total_order" class="text-center"></th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Hapus Data -->
<?php foreach ($dataZakat as $key => $value) { ?>
    <div class=" modal fade" id="hapus-zakat<?= $value['id_zakat'] ?>" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title">Selesaikan Data <?= $title ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda ingin menyelesaikan data ini?</p>
                    Kode Produk : <b><?= $value['kode_produk'] ?></b>
                    <br>
                    Besar Zakat : <b><?= $value['zakat'] ?></b>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <a href="<?= '/transaksi/hapusZakat/' . $value['id_zakat'] ?>" class="btn btn-success"><i class="fas fa-circle-check"></i> Selesai</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php } ?>

<!-- Modal Hapus Semua Data -->
<div class=" modal fade" id="selesai-semua" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title">Selesaikan Semua Data <?= $title ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda ingin menyelesaikan semua data ini?</p>
                Besar Zakat : <b>Rp. <?= number_format($totalZakat['zakat'], 0) ?></b>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <a href="/transaksi/hapusSemuaZakat" class="btn btn-success"><i class="fas fa-circle-check"></i> Selesai</a>
            </div>
        </div>
    </div>
</div>

<!-- script total footer -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $("#example10").DataTable({
            footerCallback: function(row, data, start, end, display) {
                var api = this.api();

                // Remove the formatting to get integer data for summation
                var intVal = function(i) {
                    return typeof i === "string" ?
                        i.replace(/[\$,]/g, "") * 1 :
                        typeof i === "number" ?
                        i :
                        0;
                };

                // Total over this page
                pageTotal = api
                    .column(5, {
                        page: "current"
                    })
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Update footer
                $(api.column(5).footer()).html(new Intl.NumberFormat().format(pageTotal));
            },
        });
    });
</script>
<?= $this->endSection(); ?>