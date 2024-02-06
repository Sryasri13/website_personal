<!DOCTYPE html>
<html>
<head>
    <title>Form Pendaftaran Mahasiswa</title>
</head>
<body>
    <h2>Form Pendaftaran Mahasiswa</h2>
    <form action="proses.php" method="post">
        <label for="nim">NIM:</label>
        <input type="text" id="nim" name="nim" required><br>

        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="Aktif">Aktif</option>
            <option value="Pasif">Pasif</option>
        </select><br>

        <input type="submit" value="Daftar">
    </form>
</body>
</html>
