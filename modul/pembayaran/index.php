<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/appsia_/koneksi.php");

$koneksi = mysqli_connect("localhost", "root", "", "app_sia");
$query = "SELECT * FROM pembayaran";
$exec = mysqli_query($koneksi, $query);
$no = 1;
?>

<div class="card mb-3">
    <div class="card-body">
        <form action="modul/pembayaran/aksi_pembayaran.php?act=insert" method="post">
        <div class="row mb-3">
                <div class="col-md-6">
                    <label for="invoice" class="form-label">Invoice</label>
                    <input type="text" class="form-control" name="invoice_pembayaran">
                </div>
                <div class="col-md-6">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" name="tanggal_pembayaran">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="total" class="form-label">Total</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp.</span>
                        <input type="number" class="form-control" name="total_pembayaran">
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <input type="text" class="form-control" name="keterangan">
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
        <h3>Data Pembayaran</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Invoice Pembayaran</th>
                        <th>Tanggal Pembayaran</th>
                        <th>Jumlah Pembayaran</th>
                        <th>Keterangan</th>
                        <th><i class="bi bi-gear-fill"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($data = mysqli_fetch_array($exec)) { ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $data['invoice_pembayaran'] ?></td>
                        <td><?= $data['tanggal_pembayaran'] ?></td>
                        <td><?= $data['total_pembayaran'] ?></td>
                        <td><?= $data['keterangan'] ?></td>
                        <td>
                            <a href="#editPembayaran<?= $data['pembayaran_id'] ?>" class="text-decoration-none" data-bs-toggle="modal">
                                <i class="bi bi-pencil-square text-success"></i>
                            </a>
                            <a href="modul/pembayaran/aksi_pembayaran.php?act=delete&id=<?= $data['pembayaran_id'] ?>" class="text-decoration-none">
                                <i class="bi bi-trash text-danger"></i>
                            </a>
                        </td>
                    </tr>
                    <!-- Modal Edit Pembayaran -->
                    <div class="modal fade" id="editPembayaran<?= $data['pembayaran_id'] ?>" tabindex="-1" aria-labelledby="editPembayaranLabel" aria-hidden="true">
                        <form action="modul/pembayaran/aksi_pembayaran.php?act=update&id=<?= $data['pembayaran_id'] ?>" method="post">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editPembayaranLabel">Edit Pembayaran</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="invoice_pembayaran" class="form-label">Invoice Pembayaran</label>
                                            <input type="text" class="form-control" name="invoice_pembayaran" value="<?= $data['invoice_pembayaran'] ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="tanggal_pembayaran" class="form-label">Tanggal Pembayaran</label>
                                            <input type="date" class="form-control" name="tanggal_pembayaran" value="<?= $data['tanggal_pembayaran'] ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="total_pembayaran" class="form-label">Jumlah Pembayaran</label>
                                            <input type="number" class="form-control" name="total_pembayaran" value="<?= $data['total_pembayaran'] ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="keterangan" class="form-label">Keterangan</label>
                                            <textarea class="form-control" name="keterangan" rows="3"><?= $data['keterangan'] ?></textarea>
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
