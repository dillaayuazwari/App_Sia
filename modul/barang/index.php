<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/appsia_/koneksi.php");

$koneksi = mysqli_connect("localhost", "root", "", "app_sia");
$query = "SELECT * FROM barang";
$exec = mysqli_query($koneksi, $query);
$no = 1;
?>
<div class="card mb-3">
    <div class="card-body">
        <form action="modul/barang/aksi_barang.php?act=insert" method="post">
            <div class="row">
                <div class="mb-3 col-md-4">
                    <label for="nama_barang" class="form-label">Nama Barang</label>
                    <input type="text" class="form-control" name="nama_barang" required>
                </div>
                <div class="mb-3 col-md-4">
                    <label for="harga_beli" class="form-label">Harga Beli</label>
                    <input type="number" class="form-control" name="harga_beli" required>
                </div>
                <div class="mb-3 col-md-4">
                    <label for="harga_jual" class="form-label">Harga Jual</label>
                    <input type="number" class="form-control" name="harga_jual" required>
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-md-4">
                    <label for="stok" class="form-label">Stok</label>
                    <input type="number" class="form-control" name="stok" required>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="d-flex">
                    <span class="me-auto text-gray">
                        <?php
                        if (isset($_SESSION['pesan'])) {
                            echo $_SESSION['pesan'];
                            unset($_SESSION['pesan']);
                        }
                        ?>
                    </span>
                    <button class="btn btn-secondary" type="reset">Reset</button>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3>Data Barang</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Barang</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>Stok</th>
                        <th><i class="bi bi-gear-fill"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($data = mysqli_fetch_array($exec)) { ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $data['nama_barang'] ?></td>
                        <td>Rp. <?= number_format($data['harga_beli'], 0, ',', '.') ?></td>
                        <td>Rp. <?= number_format($data['harga_jual'], 0, ',', '.') ?></td>
                        <td><?= $data['stok'] ?></td>
                        <td>
                            <a href="#editBarang<?= $data['barang_id'] ?>" class="text-decoration-none" data-bs-toggle="modal">
                                <i class="bi bi-pencil-square text-success"></i>
                            </a>
                            <a href="modul/barang/aksi_barang.php?act=delete&id=<?= $data['barang_id'] ?>" class="text-decoration-none">
                                <i class="bi bi-trash text-danger"></i>
                            </a>
                        </td>
                    </tr>
                    <!-- Modal Edit Barang -->
                    <div class="modal fade" id="editBarang<?= $data['barang_id'] ?>" tabindex="-1" aria-labelledby="editBarangLabel" aria-hidden="true">
                        <form action="modul/barang/aksi_barang.php?act=update&id=<?= $data['barang_id'] ?>" method="post">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editBarangLabel">Edit Barang</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="nama_barang" class="form-label">Nama Barang</label>
                                            <input type="text" class="form-control" name="nama_barang" value="<?= $data['nama_barang'] ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="harga_beli" class="form-label">Harga Beli</label>
                                            <input type="number" class="form-control" name="harga_beli" value="<?= $data['harga_beli'] ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="harga_jual" class="form-label">Harga Jual</label>
                                            <input type="number" class="form-control" name="harga_jual" value="<?= $data['harga_jual'] ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="stok" class="form-label">Stok</label>
                                            <input type="number" class="form-control" name="stok" value="<?= $data['stok'] ?>" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
mysqli_close($koneksi);
?>
