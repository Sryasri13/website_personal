<?php
session_start();
require_once 'config/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Hapus data sesi sebelumnya (jika ada)
    session_unset();

    // Ambil data dari form login dan gunakan htmlspecialchars
    $nim = htmlspecialchars($_POST['nim']);
    $password = htmlspecialchars($_POST['password']);

    if (empty($nim) || empty($password)) {
        echo "<script>
                    alert('Data tidak boleh kosong!');
                    window.location.href = 'login.php';
            </script>";
    } else {
        try {
            // Validasi login dengan menggunakan prepared statement
            $sql = $con->prepare("SELECT * FROM mahasiswa WHERE nim=? AND status = 'Aktif'");
            $sql->bindParam(1, $nim, PDO::PARAM_STR);
            $sql->execute();

            // Periksa apakah query menghasilkan data
            $jml = $sql->rowCount();

            if ($jml > 0) {
                // Ambil data pengguna
                $row = $sql->fetch(PDO::FETCH_ASSOC);

                // Periksa password setelah mengambil baris data
                if (password_verify($password, $row['password'])) {
                    // Login berhasil
                    $_SESSION['nim'] = $row['nim'];
                    $_SESSION['status'] = $row['status'];
                    echo "<script>
                        alert('Login berhasil');
                        window.location.href = 'halaman_utama.php';
                    </script>";
                } else {
                    // Password tidak cocok
                    echo "<script>
                        alert('Login gagal. Pastikan NIM dan password benar.');
                        window.location.href = 'login.php';
                    </script>";
                }
            } else {
                // Data tidak ditemukan atau mahasiswa tidak aktif
                echo "<script>
                    alert('ANDA BUKAN MAHASISWA AKTIF!');
                    window.location.href = 'login.php';
                </script>";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
