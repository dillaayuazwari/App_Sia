<div class="card mb-3">
  <div class="card-body">
    <form action="modul/suplier/aksi_suplier.php?act=insert" method="post">
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
            <label for="telepon" class="form-label">telepon</label>
            <input type="text" class="form-control" name="telepon">
        </div>
        <div class="mb-3 col-md-6">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email">
        </div>
    </div>
    <hr>
    <div class="row">
       <div class="d-flex">
                <span class="me-auto text-gray">
                </span>
                <button type="reset" class="btn btn-secondary">Reset</button>
                <button type="submit" name="submit"  class="btn btn-primary">Simpan</button>
            </div>
        </form>  
    </div>
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
                        <th>telepon</th>
                        <th>Email</th>
                        <th><i class="bi bi-gear-fill"></i></th>
                    </tr>
                </thead>
                <tbody>
                     <!-- Data Supplier -->
            <?php
            include_once($_SERVER['DOCUMENT_ROOT'] . "/appsia_/koneksi.php");

            $koneksi = mysqli_connect("localhost", "root", "", "app_sia");
            $query = "SELECT * from supplier";
            $exec = mysqli_query($koneksi, $query);
            $no = 1; // Mengubah nomor dimulai dari 1
            while($data = mysqli_fetch_array($exec)){
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $data['nama_supplier'] ?></td>
                <td><?= $data['alamat'] ?></td>
                <td><?= $data['telepon'] ?></td>
                <td><?= $data['email'] ?></td>
                <td>
                    <a href="#editSupplier<?= $data['supplier_id'] ?>" class="text-decoration-none" data-bs-toggle="modal">
                        <i class="bi bi-pencil-square text-success"></i>
                    </a>
                    <a href="modul/suplier/aksi_suplier.php?act=delete&id=<?= $data['supplier_id'] ?>" class="text-decoration-none">
                        <i class="bi bi-trash text-danger"></i>
                    </a>
                </td>
            </tr>
            <!-- Modal Edit Supplier -->
            <div class="modal fade" id="editSupplier<?= $data['supplier_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <form action="modul/suplier/aksi_suplier.php?act=update&id=<?= $data['supplier_id'] ?>" method="post"> 
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Supplier</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label" for="nama_supplier">Nama Supplier</label>
                                    <input type="text" class="form-control" name="nama_supplier" value="<?= $data['nama_supplier'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="alamat">Alamat</label>
                                    <input type="text" class="form-control" name="alamat" value="<?= $data['alamat'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="telepon">telepon</label>
                                    <input type="text" class="form-control" name="telepon" value="<?= $data['telepon'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="text" class="form-control" name="email" value="<?= $data['email'] ?>">
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
            <?php
            }
            ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
