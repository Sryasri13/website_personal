<?php
session_start();
require_once 'config/koneksi.php';

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['nim'])) {
    header("Location: login.php");
    exit();
}

// Ambil informasi mahasiswa dari database berdasarkan NIM dan status aktif
$nim = $_SESSION['nim'];

try {
    // Ambil informasi mahasiswa dari tabel mahasiswa
    $sql_mahasiswa = $con->prepare("SELECT * FROM mahasiswa WHERE nim=? AND status = 1");
    $sql_mahasiswa->bindParam(1, $nim, PDO::PARAM_STR);
    $sql_mahasiswa->execute();

    $mahasiswa = $sql_mahasiswa->fetch(PDO::FETCH_ASSOC);

    // Periksa apakah data mahasiswa ditemukan
    if (!$mahasiswa) {
        echo "Data mahasiswa tidak ditemukan.";
        exit();
    }

    // Ambil informasi semester aktif dari tabel semester
    $sql_semester_aktif = $con->prepare("SELECT tahun, semester FROM semester ORDER BY tahun DESC LIMIT 1");
    $sql_semester_aktif->execute();
    $semester_aktif = $sql_semester_aktif->fetch(PDO::FETCH_ASSOC);

    // Periksa apakah data semester aktif ditemukan
    if (!$semester_aktif) {
        echo "Data semester aktif tidak ditemukan.";
        exit();
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Utama KRS</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom Styles -->
    <style>
        body {
            padding-top: 70px;
            background-color: #f2f2f2;
        }

        #main-content {
            z-index: 1;
        }

        .table-bordered {
            background-color: #ffffff; /* Warna latar belakang abu-abu putih untuk tabel */
        }

        .table-bordered thead th {
            background-color: #d1d1d1; /* Warna latar belakang abu-abu untuk judul kolom */
        }
      
        

       
    </style>
</head>

    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Home</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div id="main-content" class="col-sm-6 col-sm-offset-3 col-md-8 col-md-offset-2">
        <!-- Welcome Message -->
        <div class="text-center" style="margin-top: 20px;">
            <h1>
                <i class="fas fa-graduation-cap fa-lg" style="color: #000000;"></i>
                Selamat Datang di Halaman Utama KRS
            </h1>
        </div>

        <!-- Data Mahasiswa Card -->
        <div class="card mt-4 card-bg-custom">
            <div class="card-body">
                <form class="student-info">
                    <h3 class="card-title">Data Mahasiswa</h3>
                    <div style="margin-top: 20px;">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="nim">NIM:</label>
                                    <input type="text" id="nim" name="nim" class="form-control" value="<?php echo isset($mahasiswa['nim']) ? $mahasiswa['nim'] : ''; ?>" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="nama">Nama:</label>
                                    <input type="text" id="nama" name="nama" class="form-control" value="<?php echo isset($mahasiswa['nama']) ? $mahasiswa['nama'] : ''; ?>" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="tahun">Tahun:</label>
                                    <input type="text" id="tahun" name="tahun" class="form-control" value="<?php echo isset($semester_aktif['tahun']) ? $semester_aktif['tahun'] : ''; ?>" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="semester">Semester:</label>
                                    <input type="text" id="semester" name="semester" class="form-control" value="<?php echo isset($semester_aktif['semester']) ? $semester_aktif['semester'] : ''; ?>" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Form KRS Card -->
        <div class="card mt-8 card-bg-broken-white">
            <div class="card-body">
                <h3 class="card-title text-dark">Form KRS</h3>
                <form action="krs_save.php" method="post">
                    <div class="form-group">
                        <label for="matakuliah" class="form-label text-dark">Daftar Mata Kuliah:</label>
                        <select id="matakuliah" name="matakuliah" class="form-control" required>
                            <?php
                            $x = $con->query("SELECT * FROM matakuliah WHERE semester %2 = 1");
                            while ($row = $x->fetch()) {
                                echo "<option value='{$row['nama_mk']}'>{$row['nama_mk']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kelas" class="form-label text-dark">Kelas:</label>
                        <select id="kelas" name="kelas" class="form-control" required>
                            <?php
                            $x = $con->query("SELECT * FROM kelas");
                            while ($row = $x->fetch()) {
                                echo "<option value='{$row['kelas']}'>{$row['kelas']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-custom-width mx-auto">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

       <!-- Pengambilan KRS Table -->
<div class="card mt-3">
    <div class="card-body">
        <h3 class="mt-2 text-dark">Pengambilan KRS</h3>
        <div class="table-responsive"> <!-- Agar tabel responsif di perangkat kecil -->
            <table class="table table-bordered table-hover">
                <thead class="bg-success text-white">
                    <tr>
                        <th class="align-middle">Kode Mata Kuliah</th>
                        <th class="align-middle">Nama Mata Kuliah</th>
                        <th class="align-middle">SKS</th>
                        <th class="align-middle">Kelas</th>
                        <th class="align-middle">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Mengasumsikan ada tabel 'pengambilan_krs'
                    $sql_krs = $con->query("SELECT * FROM krs2");
                    while ($row_krs = $sql_krs->fetch()) {
                        echo "<tr>
                            <td class='align-middle'>{$row_krs['kode_mk']}</td>
                            <td class='align-middle'>{$row_krs['nama_mk']}</td>
                            <td class='align-middle'>{$row_krs['sks']}</td>
                            <td class='align-middle'>{$row_krs['kelas']}</td>
                            <td class='align-middle'>
                                <a href='delete.php?kode_mk={$row_krs['kode_mk']}' class='btn btn-success' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data?\")'>
                                    <i class='fas fa-trash'></i> Hapus
                                </a>
                            </td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

    <!-- jQuery dan Bootstrap JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>

</html>
