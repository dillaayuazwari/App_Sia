<div class="card mb-3">
    <div class="card-body">
        <from action="modul/pembelian/aksi_pembelian.php?act=insert"method="post">
        <form action="" method="post">
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="invoice" class="form-label">Invoice</label>
                    <input type="text" class="form-control" name="invoice">
                </div>
                <div class="col-md-4">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" name="tanggal">
                </div>
                <div class="col-md-4">
                    <label for="supplier" class="form-label">Supplier</label>
                    <select name="supplier" class="form-select">
                        <option value="1">PT Supplier Jaya</option>
                        <option value="2">CV Maju Jaya</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input type="number" class="form-control" name="jumlah">
                </div>
                <div class="col-md-4">
                    <label for="harga" class="form-label">Harga</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp.</span>
                        <input type="number" class="form-control" name="harga">
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="total" class="form-label">Total</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp.</span>
                        <input type="number" class="form-control" name="total" disabled>
                    </div>
                </div>
            </div>
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
                    <div class="button-container">
                        <button type="reset" class="btn btn-secondary">Reset</button>
                        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <textarea name="keterangan" class="form-control"></textarea>
                </div>
            </div>
            <hr class="text-secondary">
            <div class="text-end">
                <button type="reset" class="btn btn-secondary">Reset</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
        </form>
    </div>
</div>
<br>
<div class="card">
    <div class="card-header">
        <h3>Data Pembelian</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Invoice</th>
                        <th>Tanggal</th>
                        <th>Supplier</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Total</th>
                        <th>Keterangan</th>
                        <th><i class="bi bi-gear-fill"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT a.id as id_pembelian, a.invoice, a.tanggal, b.id as id_supplier, b.nama_supplier, a.jumlah, a.harga, a.total, a.keterangan from tbl_pembelian a INNER JOIN tbl_supplier b ON a.id_suplier = b.id";
                    $exec = mysqli_query($koneksi, $query);
                    $no = 0;
                    while($row = mysqli_fetch_array($exec)){
                    $no++;
                ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><?= $row['invoice'] ?></td>
                        <td><?= $row['tanggal'] ?></td>
                        <td><?= $row['nama_supplier'] ?></td>
                        <td><?= $row['jumlah'] ?></td>
                        <td><?= "Rp. " . number_format($row['harga'], 2, ',', '.'); ?></td>
                        <td><?= "Rp. " . number_format($row['total'], 2, ',', '.'); ?></td>
                        <td><?= $row['keterangan'] ?></td>
                        <td>
                            <a href="#editPembelian<?= $row['id_pembelian'] ?>" class="text-decoration-none" data-bs-toggle="modal">
                                <i class="bi bi-pencil-square text-success"></i>
                            </a>
                            <a href="modul/pembelian/aksi_pembelian.php?act=delete&id=<?= $row['id_pembelian']; ?>" class="text-decoration-none">
                            <i class="bi bi-trash text-danger"></i>
                        </a>
                    </td>
                    <!-- Modal -->
                    <div class="modal fade" id="editPembelian<?= $row['id_pembelian'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <form action="modul/pembelian/aksi_pembelian.php?act=update&id=<?= $row['id_pembelian']; ?>" method="post">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Pembelian</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <label for="invoice" class="form-label">Invoice</label>
                                                <input type="text" class="form-control" name="invoice" value="<?= $row['invoice'] ?>" readonly>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="tanggal" class="form-label">Tanggal</label>
                                                <input type="date" class="form-control" name="tanggal" value="<?= $row['tanggal'] ?>">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="suplier" class="form-label">Supplier</label>
                                                <select name="id_supplier" class="form-select">
                                            <?php
                                            $q_sup = "SELECT * from tbl_supplier";
                                            $exec_sup = mysqli_query($koneksi, $q_sup);
                                            while($r_sup = mysqli_fetch_array($exec_sup)){
                                            ?>
                                            <option value="<?= $r_sup['id'] ?>" <?= $row['id_supplier'] === $r_sup['id'] ? 'selected' : ''; ?>>
                                            <?= $r_sup['nama_supplier'] ?>
                                        </option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="jumlah" class="form-label">Jumlah</label>
                                    <input type="number" class="form-control" name="jumlah" id="jumlah_edit_<?= $row['id_pembelian'] ?>" value="<?= $row['jumlah'] ?>">
                                    <input type="number" class="form-control" name="jumlah" id="jumlah_edit_<?= $row['id_pembelian'] ?>" value="<?= $row['jumlah'] ?>" oninput="hitungTotalEdit(<?= $row['id_pembelian'] ?>);">
                                </div>
                                <div class="col-md-4">
                                    <label for="harga" class="form-label">Harga</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp.</span>
                                    <input type="number" class="form-control" name="harga" id="harga_edit_<?= $row['id_pembelian'] ?>" value="<?= $row['harga'] ?>" oninput="hitungTotalEdit(<?= $row['id_pembelian'] ?>);">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="total" class="form-label">Total</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp.</span>
                                    <input type="number" class="form-control" name="total" id="total_edit_<?= $row['id_pembelian'] ?>" value="<?= $row['total'] ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <textarea name="keterangan" class="form-control"><?= $row['keterangan'] ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </form>
    </div>
</tr>
<?php
}
?>
</tbody>