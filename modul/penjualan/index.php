<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/appsia_/koneksi.php");

$koneksi = mysqli_connect("localhost", "root", "", "app_sia");
$query = "SELECT * FROM penjualan";
$exec = mysqli_query($koneksi, $query);
$no = 1;
?>
<div class="card mb-3">
    <div class="card-body">
        <form action="modul/penjualan/aksi_penjualan.php?act=insert" method="post">
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
                    <label for="barang" class="form-label">Barang</label>
                    <select name="barang" class="form-select">
                      <?php
                        $query_barang = "SELECT * FROM barang";
                        $result_barang = mysqli_query($koneksi, $query_barang);
                        while ($row_barang = mysqli_fetch_array($result_barang)) {
                        ?>
                            <option value="<?= $row_barang['barang_id'] ?>"><?= $row_barang['nama_barang'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="pelanggan" class="form-label">Pelanggan</label>
                    <select name="pelanggan" class="form-select">
                      <?php
                        $query_pelanggan = "SELECT * FROM pelanggan";
                        $result_pelanggan = mysqli_query($koneksi, $query_pelanggan);
                        while ($row_pelanggan = mysqli_fetch_array($result_pelanggan)) {
                        ?>
                            <option value="<?= $row_pelanggan['pelanggan_id'] ?>"><?= $row_pelanggan['nama_pelanggan'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input type="number" class="form-control" name="jumlah" id="jumlah" oninput="hitungTotal();" step="any">
                </div>
                <div class="col-md-3">
                    <label for="harga" class="form-label">Harga</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp.</span>
                        <input type="number" class="form-control" name="harga" id="harga" oninput="hitungTotal();" step="any">
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="total" class="form-label">Total</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp.</span>
                        <input type="number" class="form-control" name="total" id="total" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
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
        <h3>Data Penjualan</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Invoice</th>
                        <th>Tanggal</th>
                        <th>Nama Barang</th>
                        <th>Nama Pelanggan</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Total</th>
                        <th>Keterangan</th>
                        <th><i class="bi bi-gear-fill"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT a.penjualan_id, a.invoice_penjualan, a.tanggal_penjualan, b.nama_barang, c.nama_pelanggan, a.jumlah_penjualan, a.harga, a.total_penjualan, a.keterangan
                              FROM penjualan a
                              INNER JOIN barang b ON a.barang_id = b.barang_id
                              INNER JOIN pelanggan c ON a.pelanggan_id = c.pelanggan_id";
                    $result = mysqli_query($koneksi, $query);
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $row['invoice_penjualan'] ?></td>
                            <td><?= $row['tanggal_penjualan'] ?></td>
                            <td><?= $row['nama_barang'] ?></td>
                            <td><?= $row['nama_pelanggan'] ?></td>
                            <td><?= $row['jumlah_penjualan'] ?></td>
                            <td><?= "Rp. " . number_format($row['harga'], 2, ',', '.'); ?></td>
                            <td><?= "Rp. " . number_format($row['total_penjualan'], 2, ',', '.'); ?></td>
                            <td><?= $row['keterangan'] ?></td>
                            <td>
                                <a href="#editPenjualan<?= $row['penjualan_id'] ?>" class="text-decoration-none" data-bs-toggle="modal">
                                    <i class="bi bi-pencil-square text-success"></i>
                                </a>
                                <a href="modul/penjualan/aksi_penjualan.php?act=delete&id=<?= $row['penjualan_id']; ?>" class="text-decoration-none">
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

<!-- Modals for Editing Penjualan -->
<?php
$result = mysqli_query($koneksi, $query);
while ($row = mysqli_fetch_assoc($result)) {
?>
<div class="modal fade" id="editPenjualan<?= $row['penjualan_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="modul/penjualan/aksi_penjualan.php?act=update&id=<?= $row['penjualan_id']; ?>" method="post">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Penjualan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="invoice" class="form-label">Invoice</label>
                            <input type="text" class="form-control" name="invoice" value="<?= $row['invoice'] ?>">
                        </div>
                        <div class="col-md-4">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" value="<?= $row['tanggal'] ?>">
                        </div>
                        <div class="col-md-4">
                            <label for="barang" class="form-label">Barang</label>
                            <select name="barang_id" class="form-select">
                                <?php
                                $query_barang = "SELECT * FROM barang";
                                $result_barang = mysqli_query($koneksi, $query_barang);
                                while ($row_barang = mysqli_fetch_assoc($result_barang)) {
                                ?>
                                    <option value="<?= $row_barang['barang_id'] ?>" <?= $row_barang['barang_id'] == $row['barang_id'] ? 'selected' : '' ?>><?= $row_barang['nama_barang'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="pelanggan" class="form-label">Pelanggan</label>
                            <select name="pelanggan_id" class="form-select">
                                <?php
                                $query_pelanggan = "SELECT * FROM pelanggan";
                                $result_pelanggan = mysqli_query($koneksi, $query_pelanggan);
                                while ($row_pelanggan = mysqli_fetch_assoc($result_pelanggan)) {
                                ?>
                                    <option value="<?= $row_pelanggan['pelanggan_id'] ?>" <?= $row_pelanggan['pelanggan_id'] == $row['pelanggan_id'] ? 'selected' : '' ?>><?= $row_pelanggan['nama_pelanggan'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="jumlah" class="form-label">Jumlah</label>
                            <input type="number" class="form-control" name="jumlah" value="<?= $row['jumlah'] ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="harga" class="form-label">Harga</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp.</span>
                                <input type="number" class="form-control" name="harga" value="<?= $row['harga'] ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="total" class="form-label">Total</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp.</span>
                                <input type="number" class="form-control" name="total" value="<?= $row['total'] ?>" readonly>
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
<?php
}
?>

<!-- Include Bootstrap JS and other necessary libraries -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script>
function hitungTotal() {
    var jumlah = document.getElementById('jumlah').value;
    var harga = document.getElementById('harga').value;
    var total = document.getElementById('total');

    if (jumlah && harga) {
        total.value = jumlah * harga;
    } else {
        total.value = 0;
    }
}
</script>
