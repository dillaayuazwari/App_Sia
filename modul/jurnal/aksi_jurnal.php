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
        $jenis_invoice = $_POST['jenis-invoice'];
        $tanggal = $_POST['tanggal'];
        $akun_id = $_POST['nama-akun'];
        $nominal = $_POST['nominal'];
        $type = $_POST['type'];
        $keterangan = $_POST['keterangan'];

        $query = "INSERT INTO jurnal (invoice, jenis_invoice, tanggal, akun_id, nominal, type, keterangan)
                  VALUES ('$invoice', '$jenis_invoice', '$tanggal', '$akun_id', '$nominal', '$type', '$keterangan')";

        if (mysqli_query($koneksi, $query)) {
            $_SESSION['pesan'] = "Data jurnal berhasil ditambahkan.";
        } else {
            $_SESSION['pesan'] = "Error: " . $query . "<br>" . mysqli_error($koneksi);
        }
        header("location:../../dashboard.php?modul=jurnal");
        break;

    case 'update':
        $id = $_GET['id'];
        $invoice = $_POST['invoice'];
        $jenis_invoice = $_POST['jenis-invoice'];
        $tanggal = $_POST['tanggal'];
        $akun_id = $_POST['nama-akun'];
        $nominal = $_POST['nominal'];
        $type = $_POST['type'];
        $keterangan = $_POST['keterangan'];

        $query = "UPDATE jurnal SET invoice='$invoice', jenis_invoice='$jenis_invoice', tanggal='$tanggal', akun_id='$akun_id', nominal='$nominal', type='$type', keterangan='$keterangan'
                  WHERE jurnal_id='$id'";

        if (mysqli_query($koneksi, $query)) {
            $_SESSION['pesan'] = "Data jurnal berhasil diperbarui.";
        } else {
            $_SESSION['pesan'] = "Error: " . $query . "<br>" . mysqli_error($koneksi);
        }
        header("location:../../dashboard.php?modul=jurnal");
        break;

    case 'delete':
        $id = $_GET['id'];
        $query = "DELETE FROM jurnal WHERE jurnal_id='$id'";

        if (mysqli_query($koneksi, $query)) {
            $_SESSION['pesan'] = "Data jurnal berhasil dihapus.";
        } else {
            $_SESSION['pesan'] = "Error: " . $query . "<br>" . mysqli_error($koneksi);
        }
        header("location:../../dashboard.php?modul=jurnal");
        break;

    default:
        header("location:../../dashboard.php?modul=jurnal");
        break;
}

mysqli_close($koneksi);
?>
