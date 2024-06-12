<?php
session_start();
include_once('../../koneksi.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_supplier = $_POST['nama_supplier'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];
    $email = $_POST['email'];

    if ($_GET['act'] == "insert") {
        $query = "INSERT INTO supplier (nama_supplier, alamat, telepon, email) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, 'ssss', $nama_supplier, $alamat, $telepon, $email);
        $exec = mysqli_stmt_execute($stmt);

        if ($exec) {
            $_SESSION['pesan'] = "Data supplier telah ditambahkan";
            $_SESSION['status'] = "success";
        } else {
            $_SESSION['pesan'] = "Data supplier gagal ditambahkan";
            $_SESSION['status'] = "error";
        }
        mysqli_stmt_close($stmt);
        header('Location: ../../dashboard.php?modul=supplier');
        exit();
    } elseif ($_GET['act'] == "update") {
        $supplier_id = $_GET['supplier_id'];
        $query = "UPDATE supplier SET nama_supplier=?, alamat=?, telepon=?, email=? WHERE supplier_id=?";
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, 'ssssi', $nama_supplier, $alamat, $telepon, $email, $supplier_id);
        $exec = mysqli_stmt_execute($stmt);

        if ($exec) {
            $_SESSION['pesan'] = "Data supplier telah diubah";
            $_SESSION['status'] = "success";
        } else {
            $_SESSION['pesan'] = "Data supplier gagal diubah";
            $_SESSION['status'] = "error";
        }
        mysqli_stmt_close($stmt);
        header('Location: ../../dashboard.php?modul=supplier');
        exit();
    }
} else {
    if ($_GET['act'] == "delete") {
        $supplier_id = $_GET['supplier_id'];
        $query = "DELETE FROM supplier WHERE isupplier_id=?";
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, 'i', $supplier_id);
        $exec = mysqli_stmt_execute($stmt);

        if ($exec) {
            $_SESSION['pesan'] = "Data supplier telah dihapus";
            $_SESSION['status'] = "success";
        } else {
            $_SESSION['pesan'] = "Data supplier gagal dihapus";
            $_SESSION['status'] = "error";
        }
        mysqli_stmt_close($stmt);
        header('Location: ../../dashboard.php?modul=supplier');
        exit();
    } else {
        header('Location: ../../index.php');
        exit();
    }
}
