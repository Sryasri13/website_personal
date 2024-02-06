<?php
session_start();
require_once 'config/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matakuliah = htmlspecialchars($_POST['matakuliah']);
    $kelas = htmlspecialchars($_POST['kelas']);

    if (empty($matakuliah) || empty($kelas)) {
        echo "<script>
                    alert('Data tidak boleh kosong!');
                    window.location.href = 'halaman_utama.php';
            </script>";
    } else {
        try {
            // Check if the selected course and class combination already exists
            $sql = $con->prepare("SELECT COUNT(*) FROM krs2 WHERE kode_mk = (SELECT kode_mk FROM matakuliah WHERE nama_mk = ?) AND kelas = ?");
            $sql->bindParam(1, $matakuliah, PDO::PARAM_STR);
            $sql->bindParam(2, $kelas, PDO::PARAM_STR);
            $sql->execute();

            $count = $sql->fetchColumn();

            if ($count > 0) {
                echo "<script>
                        alert('Matakuliah Sudah Ada!');
                        window.location.href = 'halaman_utama.php';
                    </script>";
            } else {
                // If not duplicate, proceed with the insertion
                $sql = $con->prepare("INSERT INTO krs2 (kode_mk, nama_mk, sks, kelas) SELECT kode_mk, nama_mk, sks, ? AS kelas
                FROM matakuliah WHERE nama_mk = ?");
                $sql->bindParam(1, $kelas, PDO::PARAM_STR);
                $sql->bindParam(2, $matakuliah, PDO::PARAM_STR);
                $sql->execute();

                echo "<script>
                        alert('KRS berhasil disimpan!');
                        window.location.href = 'halaman_utama.php';
                    </script>";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
