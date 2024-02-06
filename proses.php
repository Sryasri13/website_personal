<?php
require_once 'config/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form pendaftaran dan gunakan htmlspecialchars
    $nim = htmlspecialchars($_POST['nim']);
    $nama = htmlspecialchars($_POST['nama']);
    $password = htmlspecialchars($_POST['password']);
    $status = htmlspecialchars($_POST['status']);

    // Hash password sebelum menyimpan ke database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Masukkan data ke dalam tabel mahasiswa
        $sql = $con->prepare("INSERT INTO mahasiswa (nim, nama, password, status) VALUES (?, ?, ?, ?)");
        $sql->bindParam(1, $nim, PDO::PARAM_STR);
        $sql->bindParam(2, $nama, PDO::PARAM_STR);
        $sql->bindParam(3, $hashed_password, PDO::PARAM_STR);
        $sql->bindParam(4, $status, PDO::PARAM_STR);
        $sql->execute();

        echo "<script>
            alert('Pendaftaran berhasil!');
            window.location.href = 'halaman_utama.php';
        </script>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
