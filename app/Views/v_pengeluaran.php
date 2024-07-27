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
                <h3 class="card-title mt-1">Pengeluaran</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#add-data">
                        <i class="fas fa-plus"> </i> Add Data
                    </button>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width=50px class="text-center">#</th>
                            <th>Nama Pengeluaran</th>
                            <th class="text-center">Qty</th>
                            <th class="text-center">Harga Satuan</th>
                            <th>Keterangan</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Jumlah Pengeluaran</th>
                            <th width=79x class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($pengeluaran as $key => $value) { ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td><?= $value['nama_pengeluaran'] ?></td>
                                <td class="text-center"><?= $value['qty'] ?></td>
                                <td class="text-center"><?= $value['harga_satuan'] ?></td>
                                <td><?= $value['keterangan'] ?></td>
                                <td class="text-center"><?= $value['tanggal'] ?></td>
                                <td class="text-center"><?= $value['jumlah_pengeluaran'] ?></td>
                                <td>
                                    <div class="row">
                                        <button class="btn btn-danger btn-sm mr-1" data-toggle="modal" data-target="#hapus-data<?= $value['id_pengeluaran'] ?>"><i class="fas fa-trash"></i></button>
                                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit-data<?= $value['id_pengeluaran'] ?>"><i class="fas fa-pen"></i></button>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <!-- End Card Body -->
        </div>
    </div>
</div>

<!-- Modal Add Data -->
<div class="modal fade" id="add-data" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title">Tambah Data <?= $title ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <?= form_open('pengeluaran/tambahData') ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Nama Pengeluaran</label>
                    <input name="nama_pengeluaran" placeholder="Masukkan Nama Pengeluaran" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">E-mail</label>
                    <input name="email" type="email" placeholder="Masukkan Alamat Email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input name="password" placeholder="Masukkan Password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Level</label>
                    <select name="level" class="form-control">
                        <option value="1">Admin</option>
                        <option value="2" selected>Kasir</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success"> <i class="fas fa-plus"></i> Simpan </button>
            </div>
            <?= form_close() ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- Modal Edit Data -->


<!-- Modal Hapus Data -->

<?= $this->endSection(); ?>