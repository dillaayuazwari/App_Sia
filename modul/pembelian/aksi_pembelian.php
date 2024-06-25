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
        $supplier = $_POST['supplier'];
        $jumlah = $_POST['jumlah'];
        $harga = $_POST['harga'];
        $total = $jumlah * $harga;
        $keterangan = $_POST['keterangan'];

        $query = "INSERT INTO pembelian (invoice_pembelian, tanggal_pembelian, supplier_id, jumlah_pembelian, harga_pembelian, total_pembelian, keterangan)
                  VALUES ('$invoice', '$tanggal', '$supplier', '$jumlah', '$harga', '$total', '$keterangan')";

        if (mysqli_query($koneksi, $query)) {
            $_SESSION['pesan'] = "Data pembelian berhasil ditambahkan.";
        } else {
            $_SESSION['pesan'] = "Error: " . $query . "<br>" . mysqli_error($koneksi);
        }
        header("location:../../dashboard.php?modul=pembelian");
        break;

    case 'update':
        $id = $_GET['id'];
        $invoice = $_POST['invoice_pembelian'];
        $tanggal = $_POST['tanggal_pembelian'];
        $supplier = $_POST['supplier_id'];
        $jumlah = $_POST['jumlah_pembelian'];
        $harga = $_POST['harga_pembelian'];
        $total = $jumlah * $harga;
        $keterangan = $_POST['keterangan'];

        $query = "UPDATE pembelian SET invoice_pembelian='$invoice', tanggal_pembelian='$tanggal', supplier_id='$supplier', jumlah_pembelian='$jumlah', harga_pembelian='$harga', total_pembelian='$total', keterangan='$keterangan'
                  WHERE pembelian_id='$id'";

        if (mysqli_query($koneksi, $query)) {
            $_SESSION['pesan'] = "Data pembelian berhasil diperbarui.";
        } else {
            $_SESSION['pesan'] = "Error: " . $query . "<br>" . mysqli_error($koneksi);
        }
        header("location:../../dashboard.php?modul=pembelian");
        break;

    case 'delete':
        $id = $_GET['id'];
        $query = "DELETE FROM pembelian WHERE pembelian_id='$id'";

        if (mysqli_query($koneksi, $query)) {
            $_SESSION['pesan'] = "Data pembelian berhasil dihapus.";
        } else {
            $_SESSION['pesan'] = "Error: " . $query . "<br>" . mysqli_error($koneksi);
        }
        header("location:../../dashboard.php?modul=pembelian");
        break;

    default:
        header("location:../../dashboard.php?modul=pembelian");
        break;
}

mysqli_close($koneksi);
?>
