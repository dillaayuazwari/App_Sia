<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . "/appsia_/koneksi.php");

$koneksi = mysqli_connect("localhost", "root", "", "app_sia");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_GET['act'] == "insert") {
        $invoice_pembayaran = $_POST['invoice_pembayaran'];
        $tanggal_pembayaran = $_POST['tanggal_pembayaran'];
        $total_pembayaran = $_POST['total_pembayaran'];
        $keterangan = $_POST['keterangan'];

        $query = "INSERT INTO pembayaran (invoice_pembayaran, tanggal_pembayaran, total_pembayaran, keterangan) VALUES (?, ?, ?, ?)";
        $stmt = $koneksi->prepare($query);
        $stmt->bind_param("ssis", $invoice_pembayaran, $tanggal_pembayaran, $total_pembayaran, $keterangan);

        if ($stmt->execute()) {
            $_SESSION['pesan'] = "Data pembayaran berhasil ditambah";
        } else {
            $_SESSION['pesan'] = "Data pembayaran gagal ditambah: " . $stmt->error;
        }
    } elseif ($_GET['act'] == "update") {
        $pembayaran_id = $_GET['id'];
        $invoice_pembayaran = $_POST['invoice_pembayaran'];
        $tanggal_pembayaran = $_POST['tanggal_pembayaran'];
        $total_pembayaran = $_POST['total_pembayaran'];
        $keterangan = $_POST['keterangan'];

        $query = "UPDATE pembayaran SET invoice_pembayaran = ?, tanggal_pembayaran = ?, total_pembayaran = ?, keterangan = ? WHERE pembayaran_id = ?";
        $stmt = $koneksi->prepare($query);
        $stmt->bind_param("ssisi", $invoice_pembayaran, $tanggal_pembayaran, $total_pembayaran, $keterangan, $pembayaran_id);

        if ($stmt->execute()) {
            $_SESSION['pesan'] = "Data pembayaran berhasil diubah";
        } else {
            $_SESSION['pesan'] = "Data pembayaran gagal diubah: " . $stmt->error;
        }
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['act']) && $_GET['act'] == "delete") {
    $pembayaran_id = $_GET['id'];
    $query = "DELETE FROM pembayaran WHERE pembayaran_id = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("i", $pembayaran_id);

    if ($stmt->execute()) {
        $_SESSION['pesan'] = "Data pembayaran berhasil dihapus";
    } else {
        $_SESSION['pesan'] = "Data pembayaran gagal dihapus: " . $stmt->error;
    }
}

$stmt->close();
mysqli_close($koneksi);

header('Location: ../../dashboard.php?modul=pembayaran');
exit();
?>
