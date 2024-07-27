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
                <h3 class="card-title mt-1">Kategori</h3>
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
                            <th>Kategori</th>
                            <th width=79x class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($kategori as $key => $value) { ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td><?= $value['nama_kategori'] ?></td>
                                <td>
                                    <div class="row">
                                        <button class="btn btn-danger btn-sm mr-1" data-toggle="modal" data-target="#hapus-data<?= $value['id_kategori'] ?>"><i class="fas fa-trash"></i></button>
                                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit-data<?= $value['id_kategori'] ?>"><i class="fas fa-pen"></i></button>
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
            <?= form_open('Kategori/tambahData') ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Nama Kategori</label>
                    <input name="nama_kategori" placeholder="Masukkan Nama Kategori" class="form-control" required>
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
<?php foreach ($kategori as $key => $value) { ?>
    <div class="modal fade" id="edit-data<?= $value['id_kategori'] ?>" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title">Edit Data <?= $title ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <?= form_open('Kategori/editData/' . $value['id_kategori']) ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama Kategori</label>
                        <input name="nama_kategori" placeholder="Masukkan Nama Kategori" value="<?= $value['nama_kategori'] ?>" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success"> <i class="fas fa-pen"></i> Simpan</button>
                </div>
                <?= form_close() ?>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php } ?>

<!-- Modal Hapus Data -->
<?php foreach ($kategori as $key => $value) { ?>
    <div class="modal fade" id="hapus-data<?= $value['id_kategori'] ?>" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title">Hapus Data <?= $title ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin menghapus data ini?</p>
                    <b><?= $value['nama_kategori'] ?></b>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <!-- <button type="submit" class="btn btn-success"> </button> -->
                    <a href="<?= 'kategori/hapusData/' . $value['id_kategori'] ?>" class="btn btn-success"><i class="fas fa-trash"></i> Hapus</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php } ?>
<?= $this->endSection(); ?>