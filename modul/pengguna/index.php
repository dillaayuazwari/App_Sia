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
        </row>
        <div class="row">
            <div class="mb-3 col-md-6">
                <label for="level" class="form-label"> Level</label>
                <input type="text" class="form-control" name="level">
            </div>
            <div class="mb-3 col-md-6">
                <label for="email" class="form-label"> Email</label>
                <input type="text" class="form-control" name="email">
            </div>
        </div>
        <hr>
         <div class="row">
            <div class="d-flex">
                <span class="me-auto text-gray">
                    <?php
                    if(isset($_SESSION['pesan'])){
                        echo $_SESSION['pesan'];
                        unset($_SESSION['pesan']);
                    }
                    ?>
                    </span>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                    <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
    </div>
</div>
        <div class="card">
            <div class="card-header">
                <h3>Data Pengguna</h3>
            </div>
            <div class="card -body" >
                <div class= "table- responsive" >
                    <table class="table table -striped">
                        <thead>
                            <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>Level</th>
                            <th>Email</th>
                            <th><i class="bi bi-gear-fill "></i></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
$query = "SELECT * FROM pengguna";
$exec = mysqli_query($koneksi, $query);
$no = 0;
while ($data = mysqli_fetch_array($exec)) {
   $no++; 
?>
<tr>
    <td><?= $no;?></td>
    <td><?= $data['username'] ?></td>
    <td><?= $data['nama_lengkap'] ?></td>
    <td><?= $data['email'] ?></td>
    <td><?= $data['jabatan'] ?></td>
    <td><?= $data['hak_akses'] ?></td>
    <td>
        <a href="#editPengguna<?= $data['id'] ?>" class="text-decoration-none" data-bs-toggle="modal">
            <i class="bi bi-pencil-square text-success"></i>
        </a>
        <a href="modul/pengguna/aksi_pengguna.php?act=delete&id=<?= $data['id'] ?>" class="text-decoration-none">
            <i class="bi bi-trash text-danger"></i>
        </a>
    </td>
<!-- Modal -->
<div class="modal fade" id="editPengguna<?= $data['id'] ?>" tabindex="-1" aria-labelledby="editPenggunaLabel"
    aria-hidden="true">
    <form action="modul/pengguna/aksi_pengguna.php?act=update&id=<?= $data['id'] ?>" method="post">
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
</tr>
<?php
}
?>
</tbody>