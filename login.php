<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login Mahasiswa</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
 body {
    background: linear-gradient(to right, #d3d3d3, #fff); /* Menggunakan perpaduan warna abu-abu muda ke putih */
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0;
}


.card {
    background-color: #fff;
    border: none;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.card-header {
    background-color: #fff;
    color: #fff;
    text-align: center;
    padding: 20px;
    border-radius: 10px 10px 0 0;
}

.card-body {
    padding: 20px;
}

.btn-primary {
    background: linear-gradient(to right, #fff, #fff);
    border: none;
    width: 100%;
    padding: 15px;
    border-radius: 5px;
    color: #000;
    cursor: pointer;
}

.btn-primary:hover {
    background: linear-gradient(to right, #000, #fff);
}

.card-footer {
    color: #444;
    text-align: center;
    padding: 10px;
    border-radius: 0 0 10px 10px;
}

    </style>
</head>

<body>
<div class="container mt-5">
    <div class="card mx-auto" style="max-width: 600px;">
        <div class="card-header bg-success">
            <h2 style="font-size: 3rem; color: #000;">Login Mahasiswa</h2>
        </div>
            <div class="card-body">
                <form action="ceklogin.php" method="post">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-user"></i>
                                </span>
                            </div>
                            <input type="text" id="nim" name="nim" class="form-control" placeholder="NIM" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </span>
                            </div>
                            <input type="password" id="password" name="password" class="form-control"
                                placeholder="Password" required>
                            <div class="input-group-append">
                                <span class="input-group-text password-toggle" onclick="togglePassword()">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block" style="font-size: 1.2rem;">Login</button>
                </form>
            </div>
            <div class="card-footer text-muted">
                <p>"silakan login."</p>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function togglePassword() {
            var passwordInput = document.getElementById("password");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        }
    </script>
</body>

</html>
