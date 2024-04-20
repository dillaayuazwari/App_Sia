<div class="card mb-3">
    <div class="card-body">
        <form action="" method="post">
            <div class="row mb-3">
            <div class="col-md-6">
                <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" required>
            </div>
            <div class="col-md-6">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
            </div>
            <div class="col-md-6">
                <label for="telepon" class="form-label">Telepon</label>
                <input type="tel" class="form-control" id="telepon" name="telepon" required>
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
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
                        <th>Alamat</th>
                        <th>Telepon</th>
                        <th>Email</th>
                        <th><i class="bi bi-gear-fill"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>PT Sejahtera</td>
                        <td>jln. Raya No. 123</td>
                        <td>081234567890</td>
                        <td>sejahtera@example.com</td>
                        <td>
                            <a href="#editPelanggan" class="text-decoration-none" data-bs-toggle="modal">
                                <i class="bi bi-pencil-square text-success"></i>
                            </a>
                            <a href="" class="text-decoration-none">
                                <i class="bi bi-trash text-danger"></i>
                            </a>
                        </td>
                        <!-- Modal -->
                        <div class="modal fade" id="editPelanggan" tabindex="-1" arialabelledby="exampleModalLabel" aria-hidden="true">
                            <form action="" method="post">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5"
id="exampleModalLabel">Edit Data Pelanggan</h1>
                                            <button type="button" class="btn-close" data-bsdismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="nama_pelanggan" class="formlabel">Nama pelanggan</label>
                                                    <input type="text" class="form-control"
name="nama_pelanggan" value="PT Sejahtera">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="alamat" class="formlabel">Alamat</label>
                                                    <input type="text" class="form-control"
name="alamat" value="Jln. Raya No. 123">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="telepon" class="formlabel">Telepon</label>
                                                    <input type="number" class="form-control"
name="telepon" value="081234567890"> 
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="email" class="formlabel">Email</label>
                                                    <input type="text" class="form-control"
name="email" value="sejahtera@example.com">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                             <button type="button" class="btn btn-secondary" databs-dismiss="modal">Close</button>
                                             <button type="submit" class="btn btnprimary">Simpan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>CV Maju Bersama</td>
                                <td>Jln. Maju No. 45</td>
                                <td>085678901234</td>
                                <td>maju@example.com</td>
                                <td>
                                    <a href="#editPelanggan" class="text-decoration-none"
data-bs-toggle="modal">
                                        <i class="bi bi-pencil-square text-success"></i>
                                    </a>
                                    <a href="" class="text-decoration-none">
                                        <i class="bi bi-trash text-danger"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>