<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . "/appsia_/koneksi.php");

$koneksi = mysqli_connect("localhost", "root", "", "app_sia");

if (!$koneksi) {
    die("Connection failed: " . mysqli_connect_error());
}

$act = $_GET['act'];

switch ($act) {
    case 'insert':
        $invoice = $_POST['invoice'];
        $tanggal = $_POST['tanggal'];
        $barang_id = $_POST['barang'];
        $pelanggan_id = $_POST['pelanggan'];
        $jumlah = $_POST['jumlah'];
        $harga = $_POST['harga'];
        $total = $jumlah * $harga;
        $keterangan = $_POST['keterangan'];

        $query = "INSERT INTO penjualan (invoice_penjualan, tanggal_penjualan, barang_id, pelanggan_id, jumlah_penjualan, harga, total_penjualan, keterangan)
                  VALUES ('$invoice', '$tanggal', '$barang_id', '$pelanggan_id', '$jumlah', '$harga', '$total', '$keterangan')";

        if (mysqli_query($koneksi, $query)) {
            $_SESSION['pesan'] = "Data penjualan berhasil ditambahkan.";
        } else {
            $_SESSION['pesan'] = "Error: " . $query . "<br>" . mysqli_error($koneksi);
        }
        header("location:../../dashboard.php?modul=penjualan");
        break;

    case 'update':
        $id = $_GET['id'];
        $invoice = $_POST['invoice'];
        $tanggal = $_POST['tanggal'];
        $barang_id = $_POST['barang_id'];
        $pelanggan_id = $_POST['pelanggan_id'];
        $jumlah = $_POST['jumlah'];
        $harga = $_POST['harga'];
        $total = $jumlah * $harga;
        $keterangan = $_POST['keterangan'];

        $query = "UPDATE penjualan SET invoice_penjualan='$invoice', tanggal_penjualan='$tanggal', barang_id='$barang_id', pelanggan_id='$pelanggan_id', jumlah_penjualan='$jumlah', harga='$harga', total_penjualan='$total', keterangan='$keterangan'
                  WHERE penjualan_id='$id'";

        if (mysqli_query($koneksi, $query)) {
            $_SESSION['pesan'] = "Data penjualan berhasil diperbarui.";
        } else {
            $_SESSION['pesan'] = "Error: " . $query . "<br>" . mysqli_error($koneksi);
        }
        header("location:../../dashboard.php?modul=penjualan");
        break;

    case 'delete':
        $id = $_GET['id'];
        $query = "DELETE FROM penjualan WHERE penjualan_id='$id'";

        if (mysqli_query($koneksi, $query)) {
            $_SESSION['pesan'] = "Data penjualan berhasil dihapus.";
        } else {
            $_SESSION['pesan'] = "Error: " . $query . "<br>" . mysqli_error($koneksi);
        }
        header("location:../../dashboard.php?modul=penjualan");
        break;

    default:
        header("location:../../dashboard.php?modul=penjualan");
        break;
}

mysqli_close($koneksi);
?>
