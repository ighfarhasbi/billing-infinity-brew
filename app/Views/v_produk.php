<?= $this->extend('layout/v_template'); ?>
<?= $this->section('content'); ?>

<!-- Main content -->
<div class="content">
    <?php if (session()->getFlashdata('pesan')) { ?>
        <div class="swalDefaultSuccess"></div>
    <?php } ?>
    <?php $error = session()->getFlashdata('errors');
    if (!empty($error)) { ?>
        <div class="swalDefaultError"></div>
    <?php } ?>
    <div class="col-md-12">
        <div class="card card-warning shadow-lg">
            <div class="card-header">
                <h3 class="card-title mt-1">Produk</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#add-data">
                        <i class="fas fa-plus"> </i> Add Data
                    </button>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width=50px class="text-center">#</th>
                            <th>Kode Produk</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th class="text-center">Satuan</th>
                            <th class="text-center">Modal Pokok</th>
                            <th class="text-center">HPP (Rp.)</th>
                            <th class="text-center">Harga Jual (Rp.)</th>
                            <th class="text-center">Untung (%)</th>
                            <th class="text-center">Stok</th>
                            <th width=79x class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($produk as $key => $value) { ?>
                            <tr <?= $value['stok'] <= 2 ? 'style="background-color:#ff9966;"' : '' ?>>
                                <td class="text-center"><?= $no++ ?></td>
                                <td><?= $value['kode_produk'] ?></td>
                                <td><?= $value['nama_produk'] ?></td>
                                <td><?= $value['nama_kategori'] ?></td>
                                <td class="text-center"><?= $value['nama_satuan'] ?></td>
                                <td class="text-center"><?= number_format($value['modal_pokok'], 0) ?></td>
                                <td class="text-center"><?= number_format($value['harga_beli'], 0) ?></td>
                                <td class="text-center"><?= number_format($value['harga_jual'], 0) ?></td>
                                <td class="text-center"><?= $value['persen_untung'] ?></td>
                                <td class="text-center"><?= $value['stok'] ?></td>
                                <td class="text-center">
                                    <div class="row">
                                        <button class="btn btn-danger btn-sm mr-1 ml-4" data-toggle="modal" data-target="#hapus-data<?= $value['id_produk'] ?>"><i class="fas fa-trash"></i></button>
                                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit-data<?= $value['id_produk'] ?>"><i class="fas fa-pen"></i></button>
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
            <?= form_open('Produk/tambahData') ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Kode Produk</label>
                    <input name="kode_produk" value="<?= old('kode_produk') ?>" placeholder="Masukkan Kode Produk" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Nama Produk</label>
                    <input name="nama_produk" value="<?= old('nama_produk') ?>" placeholder="Masukkan Nama Produk" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Kategori</label>
                    <select name="id_kategori" class="form-control" required>
                        <option value=""> -- Pilih Kategori -- </option>

                        <?php foreach ($kategori as $key => $value) { ?>
                            <option value="<?= $value['id_kategori'] ?>" <?= $value['id_kategori'] == old('id_kategori') ? 'selected' : '' ?>><?= $value['nama_kategori'] ?></option>
                        <?php } ?>

                    </select>
                </div>
                <div class="form-group">
                    <label for="">Satuan</label>
                    <select name="id_satuan" class="form-control" required>
                        <option value=""> -- Pilih Satuan -- </option>
                        <?php foreach ($satuan as $key => $value) { ?>
                            <option value="<?= $value['id_satuan'] ?>" <?= $value['id_satuan'] == old('id_satuan') ? 'selected' : '' ?>><?= $value['nama_satuan'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Modal Pokok</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp.</span>
                        </div>
                        <input name="modal_pokok" id="modal_pokok" value="<?= old('modal_pokok') ?>" class="form-control" placeholder="Masukkan Modal Pokok" required autocomplete="off">
                    </div>
                </div>
                <div class="form-group">
                    <label for="">HPP</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp.</span>
                        </div>
                        <input name="harga_beli" id="harga_beli" value="<?= old('harga_beli') ?>" class="form-control" placeholder="Masukkan HPP" required autocomplete="off">
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Harga Jual</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp.</span>
                        </div>
                        <input name="harga_jual" id="harga_jual" value="<?= old('harga_jual') ?>" class="form-control" placeholder="Masukkan Harga Jual" required autocomplete="off">
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Stok</label>
                    <input name="stok" type="number" value="<?= old('stok') ?>" placeholder="Masukkan Stok Barang" class="form-control" required>
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
<?php foreach ($produk as $key => $value) { ?>
    <div class="modal fade" id="edit-data<?= $value['id_produk'] ?>" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title">Edit Data <?= $title ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <?= form_open('Produk/editData/' . $value['id_produk']) ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Kode Produk</label>
                        <input name="kode_produk" value="<?= $value['kode_produk'] ?>" placeholder="Masukkan Kode Produk" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Nama Produk</label>
                        <input name="nama_produk" value="<?= $value['nama_produk'] ?>" placeholder="Masukkan Nama Produk" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Kategori</label>
                        <select name="id_kategori" class="form-control" required>
                            <option value=""> -- Pilih Kategori -- </option>

                            <?php foreach ($kategori as $key => $k) { ?>
                                <option value="<?= $k['id_kategori'] ?>" <?= $value['id_kategori'] == $k['id_kategori'] ? 'selected' : '' ?>><?= $k['nama_kategori'] ?></option>
                            <?php } ?>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Satuan</label>
                        <select name="id_satuan" class="form-control" required>
                            <option value=""> -- Pilih Satuan -- </option>
                            <?php foreach ($satuan as $key => $s) { ?>
                                <option value="<?= $s['id_satuan'] ?>" <?= $value['id_satuan'] == $s['id_satuan'] ? 'selected' : '' ?>><?= $s['nama_satuan'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Modal Pokok</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp.</span>
                            </div>
                            <input name="modal_pokok" id="modal_pokok<?= $value['id_produk'] ?>" value="<?= $value['modal_pokok'] ?>" class="form-control" placeholder="Masukkan Modal Pokok" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">HPP</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp.</span>
                            </div>
                            <input name="harga_beli" id="harga_beli<?= $value['id_produk'] ?>" value="<?= $value['harga_beli'] ?>" class="form-control" placeholder="Masukkan HPP" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Harga Jual</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp.</span>
                            </div>
                            <input name="harga_jual" id="harga_jual<?= $value['id_produk'] ?>" value="<?= $value['harga_jual'] ?>" class="form-control" placeholder="Masukkan Harga Jual" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Stok</label>
                        <input name="stok" type="number" value="<?= $value['stok'] ?>" placeholder="Masukkan Stok Barang" class="form-control" required>
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
<?php } ?>

<!-- Modal Hapus Data -->
<?php foreach ($produk as $key => $value) { ?>
    <div class="modal fade" id="hapus-data<?= $value['id_produk'] ?>" style="display: none;" aria-hidden="true">
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
                    Kode Produk : <b><?= $value['kode_produk'] ?></b>
                    <br>
                    Nama Produk : <b><?= $value['nama_produk'] ?></b>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <!-- <button type="submit" class="btn btn-success"> </button> -->
                    <a href="<?= 'produk/hapusData/' . $value['id_produk'] ?>" class="btn btn-success"><i class="fas fa-trash"></i> Hapus</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php } ?>

<script>
    <?php foreach ($produk as $key => $value) { ?>
        new AutoNumeric('#harga_beli<?= $value['id_produk'] ?>', {
            digitGroupSeparator: ',',
            decimalPlaces: 0,
        });
        new AutoNumeric('#harga_jual<?= $value['id_produk'] ?>', {
            digitGroupSeparator: ',',
            decimalPlaces: 0,
        });
        new AutoNumeric('#modal_pokok<?= $value['id_produk'] ?>', {
            digitGroupSeparator: ',',
            decimalPlaces: 0,
        });
    <?php } ?>
</script>
<?= $this->endSection(); ?>