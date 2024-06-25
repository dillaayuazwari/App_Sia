<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/appsia_/koneksi.php");

$koneksi = mysqli_connect("localhost", "root", "", "app_sia");
$query = "SELECT * FROM jurnal";
$exec = mysqli_query($koneksi, $query);
$no = 1;
?>
<div class="card mb-3">
    <div class="card-body">
        <form action="modul/jurnal/aksi_jurnal.php?act=insert" method="post">
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="invoice" class="form-label">Invoice</label>
                    <input type="text" class="form-control" name="invoice">
                </div>
                <div class="col-md-4">
                    <label for="jenis-invoice" class="form-label">Jenis Invoice</label>
                    <select name="jenis-invoice" class="form-select">
                        <option value="pembayaran">Pembayaran</option>
                        <option value="penjualan">Penjualan</option>
                        <option value="pembelian">Pembelian</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" name="tanggal">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="nama-akun" class="form-label">Nama Akun</label>
                    <select name="nama-akun" class="form-select">
                        <?php
                        $query_akun = "SELECT * FROM akun";
                        $result_akun = mysqli_query($koneksi, $query_akun);
                        while ($row_akun = mysqli_fetch_array($result_akun)) {
                            echo '<option value="' . $row_akun['akun_id'] . '">' . $row_akun['nama_akun'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="nominal" class="form-label">Nominal</label>
                    <input type="number" class="form-control" name="nominal" id="nominal" step="any">
                </div>
                <div class="col-md-3">
                    <label for="type" class="form-label">Type</label>
                    <select name="type" class="form-select">
                        <option value="debit">Debit</option>
                        <option value="kredit">Kredit</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <textarea name="keterangan" class="form-control"></textarea>
                </div>
            </div>
            <hr class="text-secondary">
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
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3>Data Jurnal</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Invoice</th>
                        <th>Jenis Invoice</th>
                        <th>Tanggal</th>
                        <th>Nama Akun</th>
                        <th>Nominal</th>
                        <th>Type</th>
                        <th>Keterangan</th>
                        <th><i class="bi bi-gear-fill"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT a.jurnal_id, a.invoice, a.jenis_invoice, a.tanggal, b.nama_akun, a.nominal, a.type, a.keterangan
                              FROM jurnal a
                              INNER JOIN akun b ON a.akun_id = b.akun_id";
                    $result = mysqli_query($koneksi, $query);
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $row['invoice'] ?></td>
                            <td><?= $row['jenis_invoice'] ?></td>
                            <td><?= $row['tanggal'] ?></td>
                            <td><?= $row['nama_akun'] ?></td>
                            <td><?= "Rp. " . number_format($row['nominal'], 2, ',', '.'); ?></td>
                            <td><?= ucfirst($row['type']) ?></td>
                            <td><?= $row['keterangan'] ?></td>
                            <td>
                                <a href="#editJurnal<?= $row['jurnal_id'] ?>" class="text-decoration-none" data-bs-toggle="modal">
                                    <i class="bi bi-pencil-square text-success"></i>
                                </a>
                                <a href="modul/jurnal/aksi_jurnal.php?act=delete&id=<?= $row['jurnal_id']; ?>" class="text-decoration-none">
                                    <i class="bi bi-trash text-danger"></i>
                                </a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modals for Editing Jurnal -->
<?php
$result = mysqli_query($koneksi, $query);
while ($row = mysqli_fetch_assoc($result)) {
?>
    <div class="modal fade" id="editJurnal<?= $row['jurnal_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form action="modul/jurnal/aksi_jurnal.php?act=update&id=<?= $row['jurnal_id']; ?>" method="post">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Jurnal</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="invoice" class="form-label">Invoice</label>
                                <input type="text" class="form-control" name="invoice" value="<?= $row['invoice'] ?>">
                            </div>
                            <div class="col-md-4">
                                <label for="jenis-invoice" class="form-label">Jenis Invoice</label>
                                <select name="jenis-invoice" class="form-select">
                                    <option value="pembayaran" <?= $row['jenis_invoice'] == 'pembayaran' ? 'selected' : '' ?>>Pembayaran</option>
                                    <option value="penjualan" <?= $row['jenis_invoice'] == 'penjualan' ? 'selected' : '' ?>>Penjualan</option>
                                    <option value="pembelian" <?= $row['jenis_invoice'] == 'pembelian' ? 'selected' : '' ?>>Pembelian</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" name="tanggal" value="<?= $row['tanggal'] ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="nama-akun" class="form-label">Nama Akun</label>
                                <select name="nama-akun" class="form-select">
                                    <?php
                                    $query_akun = "SELECT * FROM akun";
                                    $result_akun = mysqli_query($koneksi, $query_akun);
                                    while ($row_akun = mysqli_fetch_assoc($result_akun)) {
                                        $selected = ($row_akun['akun_id'] == $row['akun_id']) ? 'selected' : '';
                                        echo '<option value="' . $row_akun['akun_id'] . '" ' . $selected . '>' . $row_akun['nama_akun'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="nominal" class="form-label">Nominal</label>
                                <input type="number" class="form-control" name="nominal" value="<?= $row['nominal'] ?>">
                            </div>
                            <div class="col-md-3">
                                <label for="type" class="form-label">Type</label>
                                <select name="type" class="form-select">
                                    <option value="debit" <?= $row['type'] == 'debit' ? 'selected' : '' ?>>Debit</option>
                                    <option value="kredit" <?= $row['type'] == 'kredit' ? 'selected' : '' ?>>Kredit</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <textarea name="keterangan" class="form-control"><?= $row['keterangan'] ?></textarea>
                            </div>
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
