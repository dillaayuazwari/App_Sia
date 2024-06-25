<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . "/appsia_/koneksi.php");

$koneksi = mysqli_connect("localhost", "root", "", "app_sia");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $jabatan = $_POST['jabatan'];
    $email = $_POST['email'];
    $hak_akses = $_POST['hak_akses'];

    if ($_GET["act"] == "insert") {
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $query = "INSERT INTO pengguna (username, password, nama_lengkap, jabatan, email, hak_akses) VALUES ('$username', '$password', '$nama_lengkap', '$jabatan', '$email', '$hak_akses')";
        $exec = mysqli_query($koneksi, $query);

        if ($exec) {
            $_SESSION['pesan'] = "Data pengguna berhasil ditambah";
        } else {
            $_SESSION['pesan'] = "Data pengguna gagal ditambah";
        }
    } elseif ($_GET['act'] == "update") {
        $user_id = $_GET['id'];
        $password = $_POST['password'];

        if (empty($password)) {
            $query = "UPDATE pengguna SET nama_lengkap = '$nama_lengkap', jabatan = '$jabatan', email = '$email', hak_akses = '$hak_akses' WHERE user_id = '$user_id'";
        } else {
            $password = password_hash($password, PASSWORD_BCRYPT);
            $query = "UPDATE pengguna SET password = '$password', nama_lengkap = '$nama_lengkap', jabatan = '$jabatan', email = '$email', hak_akses = '$hak_akses' WHERE user_id = '$user_id'";
        }
        $exec = mysqli_query($koneksi, $query);

        if ($exec) {
            $_SESSION['pesan'] = "Data pengguna berhasil diubah";
        } else {
            $_SESSION['pesan'] = "Data pengguna gagal diubah";
        }
    }
} elseif ($_GET['act'] == "delete") {
    $user_id = $_GET['id'];
    $query = "DELETE FROM pengguna WHERE user_id = '$user_id'";
    $exec = mysqli_query($koneksi, $query);

    if ($exec) {
        $_SESSION['pesan'] = "Data pengguna berhasil dihapus";
    } else {
        $_SESSION['pesan'] = "Data pengguna gagal dihapus";
    }
}

header('Location: ../../dashboard.php?modul=pengguna');
exit();
?>
