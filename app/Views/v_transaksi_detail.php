<?= $this->extend('layout/v_template'); ?>

<?= $this->section('content'); ?>
<!-- Main content -->
<div class="content">
    <div class="col-md-12">
        <div class="card card-warning shadow-lg">
            <div class="card-header">
                <h3 class="card-title mt-1">Transaksi Detail</h3>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example10" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width=50px class="text-center">#</th>
                                <th>Nomor Faktur</th>
                                <th>Nama Customer</th>
                                <th>Nama Produk</th>
                                <th class="text-center">qty</th>
                                <th class="text-center">Total Bayar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($transaksi as $key => $value) { ?>
                                <tr>
                                    <td class="text-center"><?= $no++ ?></td>
                                    <td><?= $value['no_faktur'] ?></td>
                                    <td><?= $value['nama_customer'] ?></td>
                                    <td><?= $value['nama_produk'] ?></td>
                                    <td class="text-center"><?= $value['qty'] ?></td>
                                    <td class="text-center"><?= number_format($value['total_harga'], 0) ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="5">Total</th>
                                <th id="total_order" class="text-center"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <!-- End Card Body -->
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