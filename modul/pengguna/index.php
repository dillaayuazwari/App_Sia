<div class="card">
    <div class="card-body">
        <form action="modul/pengguna/aksi_pengguna.php?act=insert" method="post">
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username">
                </div>
                <div class="mb-3 col-md-6">
                    <label for="password" class="form-label">Password</label>
                    <input type="text" class="form-control" name="password">
                </div>
                <div class="mb-3 col-md-6">
                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama_lengkap">
                </div>
                <div class="mb-3 col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" name="email">
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="hak_akses" class="form-label">Hak Akses</label>
                    <select class="form-select" name="hak_akses">
                        <option value="admin">Admin</option>
                        <option value="pimpinan">Pimpinan</option>
                        <option value="karyawan">Karyawan</option>
                    </select>
                </div>

                <div class="mb-3 col-md-6">
                    <label for="jabatan" class="form-label">Jabatan</label>
                    <select class="form-select" name="jabatan">
                        <option value="administrator">Administrator</option>
                        <option value="kasir">Kasir</option>
                        <option value="penjualan">Penjualan</option>
                    </select>
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
                    <div class="button-container">
                        <button type="reset" class="btn btn-secondary">Reset</button>
                        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<br>
<div class="card">
    <div class="card-header">
        <h3>Data Pengguna</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>Jabatan</th>
                        <th>Hak Akses</th>
                        <th><i class="bi bi-gear-fill"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM pengguna";
                    $exec = mysqli_query($koneksi, $query);
                    $no = 1;
                    while ($data = mysqli_fetch_array($exec)) {
                        $user_id = isset($data['user_id']) ? $data['user_id'] : null;
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $data['username'] ?></td>
                            <td><?= $data['nama_lengkap'] ?></td>
                            <td><?= $data['email'] ?></td>
                            <td><?= $data['jabatan'] ?></td>
                            <td><?= $data['hak_akses'] ?></td>
                            <td>
                                <?php if ($user_id) { ?>
                                    <a href="#editPengguna<?= $user_id ?>" class="text-decoration-none" data-bs-toggle="modal">
                                        <i class="bi bi-pencil-square text-success"></i>
                                    </a>
                                    <a href="modul/pengguna/aksi_pengguna.php?act=delete&id=<?= $user_id ?>" class="text-decoration-none">
                                        <i class="bi bi-trash text-danger"></i>
                                    </a>
                                <?php } ?>
                            </td>
                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="editPengguna<?= $user_id ?>" tabindex="-1" aria-labelledby="editPenggunaLabel" aria-hidden="true">
                            <form action="modul/pengguna/aksi_pengguna.php?act=update&id=<?= $user_id ?>" method="post">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Pengguna</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                                <input type="text" class="form-control" name="nama_lengkap" value="<?= $data['nama_lengkap']; ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password</label>
                                                <input type="text" class="form-control" name="password">
                                                <span class="form-text text-muted">Kosongkan jika tidak ingin mengganti password</span>
                                            </div>
                                            <div class="mb-3">
                                                <label for="jabatan" class="form-label">Jabatan</label>
                                                <input type="text" class="form-control" name="jabatan" value="<?= $data['jabatan']; ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="text" class="form-control" name="email" value="<?= $data['email']; ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="hak_akses" class="form-label">Hak Akses</label>
                                                <input type="text" class="form-control" name="hak_akses" value="<?= $data['hak_akses']; ?>">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>