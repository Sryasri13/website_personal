<?php
require_once 'config/koneksi.php';
$kode_mk = $_GET['kode_mk'];

//delete
$delete = $con->prepare("DELETE FROM krs2 WHERE kode_mk = ?");
$delete->bindParam(1, $kode_mk); // Change $ID to $mk
$delete->execute();

echo "<script>
        alert('Buku Berhasil dihapus');
        window.location.href = 'halaman_utama.php';
</script>";
?>
