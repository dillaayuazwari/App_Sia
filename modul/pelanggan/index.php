<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/appsia_/koneksi.php");

$koneksi = mysqli_connect("localhost", "root", "", "app_sia");
$query = "SELECT * FROM pelanggan";
$exec = mysqli_query($koneksi, $query);
$no = 1;
?>
<div class="card mb-3">
    <div class="card-body">
        <form action="modul/pelanggan/aksi_pelanggan.php?act=insert" method="post">
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                    <input type="text" class="form-control" name="nama_pelanggan" required>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="email" class="form-label">Email Pelanggan</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="telepon" class="form-label">Telepon Pelanggan</label>
                    <input type="text" class="form-control" name="telepon" required>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="alamat" class="form-label">Alamat Pelanggan</label>
                    <textarea class="form-control" name="alamat" required></textarea>
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
        <h3>Data Pelanggan</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Pelanggan</th>
                        <th>Email Pelanggan</th>
                        <th>Telepon Pelanggan</th>
                        <th>Alamat Pelanggan</th>
                        <th><i class="bi bi-gear-fill"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($data = mysqli_fetch_array($exec)) { ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $data['nama_pelanggan'] ?></td>
                        <td><?= $data['email'] ?></td>
                        <td><?= $data['telepon'] ?></td>
                        <td><?= $data['alamat'] ?></td>
                        <td>
                            <a href="#editPelanggan<?= $data['pelanggan_id'] ?>" class="text-decoration-none" data-bs-toggle="modal">
                                <i class="bi bi-pencil-square text-success"></i>
                            </a>
                            <a href="modul/pelanggan/aksi_pelanggan.php?act=delete&id=<?= $data['pelanggan_id'] ?>" class="text-decoration-none">
                                <i class="bi bi-trash text-danger"></i>
                            </a>
                        </td>
                    </tr>
                    <!-- Modal Edit Pelanggan -->
                    <div class="modal fade" id="editPelanggan<?= $data['pelanggan_id'] ?>" tabindex="-1" aria-labelledby="editPelangganLabel" aria-hidden="true">
                        <form action="modul/pelanggan/aksi_pelanggan.php?act=update&id=<?= $data['pelanggan_id'] ?>" method="post">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editPelangganLabel">Edit Pelanggan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="nama_pelanggan" class="form-label">Nama_pelanggan Pelanggan</label>
                                            <input type="text" class="form-control" name="nama_pelanggan" value="<?= $data['nama_pelanggan'] ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email Pelanggan</label>
                                            <input type="email" class="form-control" name="email" value="<?= $data['email'] ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="telepon" class="form-label">Telepon Pelanggan</label>
                                            <input type="text" class="form-control" name="telepon" value="<?= $data['telepon'] ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="alamat" class="form-label">Alamat Pelanggan</label>
                                            <textarea class="form-control" name="alamat" required><?= $data['alamat'] ?></textarea>
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
