<?php
session_start();
include '../../koneksi.php';
$koneksi = mysqli_connect("localhost", "root", "", "app_sia");

$act = $_GET['act'];

if ($act == 'insert') {
    $nama_barang = $_POST['nama_barang'];
    $harga_beli = $_POST['harga_beli'];
    $harga_jual = $_POST['harga_jual'];
    $stok = $_POST['stok'];

    $query = "INSERT INTO barang (nama_barang, harga_beli, harga_jual, stok) VALUES ('$nama_barang', '$harga_beli', '$harga_jual', '$stok')";
    mysqli_query($koneksi, $query);

    $_SESSION['pesan'] = "Data berhasil disimpan";
    header("location:../../dashboard.php?modul=barang");
} elseif ($act == 'update') {
    $id = $_GET['id'];
    $nama_barang = $_POST['nama_barang'];
    $harga_beli = $_POST['harga_beli'];
    $harga_jual = $_POST['harga_jual'];
    $stok = $_POST['stok'];

    $query = "UPDATE barang SET nama_barang = '$nama_barang', harga_beli = '$harga_beli', harga_jual = '$harga_jual', stok = '$stok' WHERE barang_id = '$id'";
    mysqli_query($koneksi, $query);

    $_SESSION['pesan'] = "Data berhasil diubah";
    header("location:../../dashboard.php?modul=barang");
} elseif ($act == 'delete') {
    $id = $_GET['id'];
    $query = "DELETE FROM barang WHERE barang_id = '$id'";
    mysqli_query($koneksi, $query);

    $_SESSION['pesan'] = "Data berhasil dihapus";
    header("location:../../dashboard.php?modul=barang");
}
?>
