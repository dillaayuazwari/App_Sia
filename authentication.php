<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once('koneksi.php');
    session_start();

    $username = $_POST['username'];
    $password = $_POST['password'];

    $koneksi = new mysqli("localhost", "root", "", "app_sia");
    if ($koneksi->connect_error) {
        die("Koneksi database gagal: " . $koneksi->connect_error);
    }

    $query = "SELECT * FROM pengguna WHERE username='$username'";
    $result = $koneksi->query($query);
    $row = $result->fetch_assoc();
    
    if ($result->num_rows > 0) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $row['username'];
            $_SESSION['nama_lengkap'] = $row['nama_lengkap'];
            $_SESSION['jabatan'] = $row['jabatan'];
            $_SESSION['hak_akses'] = $row['hak_akses'];
            header('location: dashboard.php');
        } else {
            $_SESSION['pesan'] = "Username atau password tidak valid!!!";
            header('location:index.php');
        }
    } else {
        $_SESSION['pesan'] = "Username atau password tidak valid!!!";
        header('location:index.php');
    }
} else {
    header('location:index.php');
}
?>