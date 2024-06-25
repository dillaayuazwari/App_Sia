<?php
include_once "../../koneksi.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_GET['act']) && $_GET['act'] == "insert") {
        $nama_pelanggan = $_POST['nama_pelanggan'];
        $email = $_POST['email'];
        $telepon = $_POST['telepon'];
        $alamat = $_POST['alamat'];

        $koneksi = mysqli_connect("localhost", "root", "", "app_sia");
        $query = "INSERT INTO pelanggan (nama_pelanggan, email, telepon, alamat) VALUES (?, ?, ?, ?)";
        $stmt = $koneksi->prepare($query);
        $stmt->bind_param("ssss", $nama_pelanggan, $email, $telepon, $alamat);

        if ($stmt->execute()) {
            $_SESSION['pesan'] = "Data pelanggan telah ditambahkan";
        } else {
            $_SESSION['error'] = "Data pelanggan gagal ditambahkan: " . $stmt->error;
        }

        $stmt->close();
        header('Location: ../../dashboard.php?modul=pelanggan');
        exit();
    } elseif (isset($_GET['act']) && $_GET['act'] == "update") {
        $pelanggan_id = $_GET['id'];
        $nama_pelanggan = $_POST['nama_pelanggan'];
        $email = $_POST['email'];
        $telepon = $_POST['telepon'];
        $alamat = $_POST['alamat'];

        $koneksi = mysqli_connect("localhost", "root", "", "app_sia");
        $query = "UPDATE pelanggan SET nama_pelanggan = ?, email = ?, telepon = ?, alamat = ? WHERE pelanggan_id = ?";
        $stmt = $koneksi->prepare($query);
        $stmt->bind_param("ssssi", $nama_pelanggan, $email, $telepon, $alamat, $pelanggan_id);

        if ($stmt->execute()) {
            $_SESSION['pesan'] = "Data pelanggan telah diubah";
        } else {
            $_SESSION['error'] = "Data pelanggan gagal diubah: " . $stmt->error;
        }

        $stmt->close();
        header('Location: ../../dashboard.php?modul=pelanggan');
        exit();
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['act']) && $_GET['act'] == "delete") {
    $id = $_GET['id'];

    $koneksi = mysqli_connect("localhost", "root", "", "app_sia");
    $query = "DELETE FROM pelanggan WHERE pelanggan_id = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $_SESSION['pesan'] = "Data pelanggan telah dihapus";
    } else {
        $_SESSION['error'] = "Data pelanggan gagal dihapus: " . $stmt->error;
    }

    $stmt->close();
    header('Location: ../../dashboard.php?modul=pelanggan');
    exit();
}

mysqli_close($koneksi);
?>
