<div class="container mt-5">
    <?php
    if (isset($_SESSION['pesan'])) {
        $message = $_SESSION['pesan'];
        $status = $_SESSION['status'];

        echo "<script type='text/javascript'>
                window.onload = function() {
                    var status = '$status';
                    var message = '$message';
                    if (status === 'success') {
                        alert('Success: ' + message);
                    } else {
                        alert('Error: ' + message);
                    }
                }
            </script>";

        // Hapus pesan setelah ditampilkan
        unset($_SESSION['pesan']);
        unset($_SESSION['status']);
    }
    ?>
    <div class="card mb-3">
        <div class="card-body">
            <form action="modul/supplier/aksi_supplier.php?act=insert" method="post">
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="nama_supplier" class="form-label">Nama Supplier</label>
                        <input type="text" class="form-control" name="nama_supplier">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" name="alamat">
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="telepon" class="form-label">Telepon</label>
                        <input type="text" class="form-control" name="telepon">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" name="email">
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
    <div class="card">
        <div class="card-header">
            <h3>Data Supplier</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Supplier</th>
                            <th>Alamat</th>
                            <th>Telepon</th>
                            <th>Email</th>
                            <th><i class="bi bi-gear-fill"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM supplier";
                        $exec = mysqli_query($koneksi, $query);
                        $no = 1;
                        while ($data = mysqli_fetch_array($exec)) {
                            // Pastikan id ada dalam data
                            $supplier_id = isset($data['supplier_id']) ? $data['supplier_id'] : null;
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= htmlspecialchars($data['nama_supplier']) ?></td>
                                <td><?= htmlspecialchars($data['alamat']) ?></td>
                                <td><?= htmlspecialchars($data['telepon']) ?></td>
                                <td><?= htmlspecialchars($data['email']) ?></td>
                                <td>
                                    <?php if ($supplier_id) { ?>
                                        <a href="#editSupplier<?= $supplier_id ?>" class="text-decoration-none" data-bs-toggle="modal">
                                            <i class="bi bi-pencil-square text-success"></i>
                                        </a>
                                        <a href="modul/supplier/aksi_supplier.php?act=delete&id=<?= $supplier_id ?>" class="text-decoration-none">
                                            <i class="bi bi-trash text-danger"></i>
                                        </a>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php if ($supplier_id) { ?>
                                <!-- Modal Edit Supplier -->
                                <div class="modal fade" id="editSupplier<?= $supplier_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Supplier</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="modul/supplier/aksi_supplier.php?act=update&id=<?= $id ?>" method="post">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="nama_supplier">Nama Supplier</label>
                                                        <input type="text" class="form-control" name="nama_supplier" value="<?= htmlspecialchars($data['nama_supplier']) ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="alamat">Alamat</label>
                                                        <input type="text" class="form-control" name="alamat" value="<?= htmlspecialchars($data['alamat']) ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="telepon">Telepon</label>
                                                        <input type="text" class="form-control" name="telepon" value="<?= htmlspecialchars($data['telepon']) ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="email">Email</label>
                                                        <input type="text" class="form-control" name="email" value="<?= htmlspecialchars($data['email']) ?>">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div