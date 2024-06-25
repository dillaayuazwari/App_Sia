<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . "/appsia_/koneksi.php");

$koneksi = mysqli_connect("localhost", "root", "", "app_sia");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_akun = $_POST['nama_akun'];
    $jenis_akun = $_POST['jenis_akun'];
    $type_saldo = $_POST['type_saldo'];

    if ($_GET['act'] == "insert") {
        $query = "INSERT INTO akun (nama_akun, jenis_akun, type_saldo) VALUES ('$nama_akun', '$jenis_akun', '$type_saldo')";
        $exec = mysqli_query($koneksi, $query);

        if ($exec) {
            $_SESSION['pesan'] = "Data akun telah ditambahkan";
        } else {
            $_SESSION['pesan'] = "Data akun gagal ditambahkan: " . mysqli_error($koneksi);
        }
        header('location:../../dashboard.php?modul=akun');
    } elseif ($_GET['act'] == "update") {
        $id = $_GET['id'];
        $query = "UPDATE akun SET nama_akun='$nama_akun', jenis_akun='$jenis_akun', type_saldo='$type_saldo' WHERE akun_id='$id'";
        $exec = mysqli_query($koneksi, $query);

        if ($exec) {
            $_SESSION['pesan'] = "Data akun telah diubah";
        } else {
            $_SESSION['pesan'] = "Data akun gagal diubah: " . mysqli_error($koneksi);
        }
        header('location:../../dashboard.php?modul=akun');
    }
} elseif ($_GET['act'] == "delete") {
    $id = $_GET['id'];
    $query = "DELETE FROM akun WHERE akun_id='$id'";
    $exec = mysqli_query($koneksi, $query);

    if ($exec) {
        $_SESSION['pesan'] = "Data akun telah dihapus";
    } else {
        $_SESSION['pesan'] = "Data akun gagal dihapus: " . mysqli_error($koneksi);
    }
    header('location:../../dashboard.php?modul=akun');
} else {
    header('location:../../index.php');
}
?>
