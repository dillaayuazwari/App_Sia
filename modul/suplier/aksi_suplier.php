<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . "/appsia_/koneksi.php");

$koneksi = mysqli_connect("localhost", "root", "", "app_sia");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_supplier = $_POST['nama_supplier'];
    $telepon = $_POST['telepon'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];

    if (isset($_GET["act"]) && $_GET["act"] == "insert") {
        $query = "INSERT INTO supplier (nama_supplier, telepon, alamat, email) VALUES (?, ?, ?, ?)";
        $stmt = $koneksi->prepare($query);
        $stmt->bind_param("ssss", $nama_supplier, $telepon, $alamat, $email);

        if ($stmt->execute()) {
            $_SESSION['pesan'] = "Data supplier berhasil ditambah";
        } else {
            $_SESSION['pesan'] = "Data supplier gagal ditambah: " . $stmt->error;
        }
    } elseif (isset($_GET['act']) && $_GET['act'] == "update") {
        $supplier_id = $_GET['id'];
        
        $query = "UPDATE supplier SET nama_supplier = ?, telepon = ?, alamat = ?, email = ? WHERE supplier_id = ?";
        $stmt = $koneksi->prepare($query);
        $stmt->bind_param("ssssi", $nama_supplier, $telepon, $alamat, $email, $supplier_id);

        if ($stmt->execute()) {
            $_SESSION['pesan'] = "Data supplier berhasil diubah";
        } else {
            $_SESSION['pesan'] = "Data supplier gagal diubah: " . $stmt->error;
        }
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['act']) && $_GET['act'] == "delete") {
    $supplier_id = $_GET['id'];
    $query = "DELETE FROM supplier WHERE supplier_id = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("i", $supplier_id);

    if ($stmt->execute()) {
        $_SESSION['pesan'] = "Data supplier berhasil dihapus";
    } else {
        $_SESSION['pesan'] = "Data supplier gagal dihapus: " . $stmt->error;
    }
}

$stmt->close();
mysqli_close($koneksi);

header('Location: ../../dashboard.php?modul=suplier');
exit();
?>
