<?php
include_once "../../koneksi.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_GET['act'])) { // Periksa apakah 'act' ada dalam URL query string
        if ($_GET['act'] == "insert" || $_GET['act'] == "update") {
            $username = $_POST['username'];
            $nama_lengkap = $_POST['nama_lengkap'];
            $jabatan = isset($_POST['jabatan']) ? $_POST['jabatan'] : '';
            $email = $_POST['email'];

            // Periksa apakah 'hak_akses' ada dalam $_POST sebelum mengaksesnya
            $hak_akses = isset($_POST['hak_akses']) ? $_POST['hak_akses'] : '';

            // Jika password diisi, hash password baru
            if (!empty($_POST['password'])) {
                $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
                $password_query = ", password = ?";
            } else {
                $password_query = "";
            }

            // Prepared statement untuk mencegah SQL injection
            $query = "INSERT INTO pengguna (username, password, nama_lengkap, email, jabatan, hak_akses) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($koneksi, $query);
            mysqli_stmt_bind_param($stmt, 'ssssss', $username, $password, $nama_lengkap, $email, $jabatan, $hak_akses);

            // Eksekusi pernyataan persiapan
            $exc = mysqli_stmt_execute($stmt);

            if ($exc) {
                $_SESSION['pesan'] = "Data pengguna berhasil ditambah/ubah";
            } else {
                $_SESSION['pesan'] = "Data pengguna gagal ditambah/ubah: " . mysqli_error($koneksi);
            }

            mysqli_stmt_close($stmt);
        }
    }

    // Redirect ke halaman dashboard setelah operasi berhasil atau gagal
    header('location:../../dashboard.php?modul=pengguna');
} else {
    if (isset($_GET['act'])) { // Periksa apakah 'act' ada dalam URL query string
        if ($_GET['act'] == "delete") {
            $id = $_GET['id'];

            // Prepared statement untuk mencegah SQL injection
            $query = "DELETE FROM pengguna WHERE user_id = ?";
            $stmt = mysqli_prepare($koneksi, $query);
            mysqli_stmt_bind_param($stmt, 'i', $id);
            $exc = mysqli_stmt_execute($stmt);

            if ($exc) {
                $_SESSION['pesan'] = "Data pengguna berhasil dihapus";
            } else {
                $_SESSION['pesan'] = "Data pengguna gagal dihapus: " . mysqli_error($koneksi);
            }

            mysqli_stmt_close($stmt);

            // Redirect ke halaman dashboard setelah operasi berhasil atau gagal
            header('location:../../dashboard.php?modul=pengguna');
        }
    } else {
        // Redirect ke halaman index jika tidak ada aksi yang sesuai
        header('location:../../index.php');
    }
}
