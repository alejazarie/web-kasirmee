<?php
// Tangkap data dari form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Gunakan hash atau enkripsi sesuai kebutuhan aplikasi Anda
    $nama = $_POST['nama'];
    $level = $_POST['level'];

    // Koneksi ke database
    $servername = "localhost";
    $dbusername = "root"; // Ganti dengan username database Anda
    $dbpassword = ""; // Ganti dengan password database Anda
    $dbname = "kasir_zibran";

    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Query untuk mengecek apakah username sudah ada pada level admin atau kasir
    $check_sql = "SELECT * FROM tb_user WHERE username = ? AND (level = 'admin' OR level = 'kasir')";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $username);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows > 0) {
        // Username sudah digunakan untuk level admin atau kasir
        $notification_message = "Username sudah digunakan.";
        $notification_class = "alert alert-warning alert-dismissible fade show";
    } else {
        // Username belum digunakan, lanjutkan untuk INSERT ke database
        $sql = "INSERT INTO tb_user (username, password, nama, level) VALUES (?, ?, ?, ?)";

        // Initialize a statement object
        $stmt = $conn->prepare($sql);

        // Bind parameters to the SQL query
        $stmt->bind_param("ssss", $username, $password, $nama, $level);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect with success flag
            header("Location: register.php?success=true");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Admin/Kasir</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <style>
        body {
          
            color: white;
        }
        .container {
            max-width: 500px;
            margin-top: 50px; /* Mengurangi margin-top agar lebih dekat dengan form */
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: transparent;
            padding: 20px;
        }
        .form-control {
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid #ccc;
            color: white;
            padding: 8px;
        }
        .btn-primary {
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid #ccc;
            color: white;
            padding: 8px;
        }
        .alert {
            position: relative;
            margin-top: 20px; /* Jarak notifikasi dari form */
        }
        .notification .close {
            position: absolute;
            top: 5px;
            right: 10px;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php
        // Menampilkan notifikasi jika username sudah digunakan
        if (isset($notification_message)) {
            echo '<div class="' . $notification_class . '">';
            echo $notification_message;
            echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
            echo '<span aria-hidden="true">&times;</span>';
            echo '</button>';
            echo '</div>';
        }
        ?>
        <?php
        // Menampilkan notifikasi jika success flag ada
        if (isset($_GET['success']) && $_GET['success'] == 'true') {
            echo '<div class="alert alert-success" role="alert">Data berhasil disimpan.</div>';
        }
        ?>
        <h2>Registrasi Admin/Kasir Baru</h2>
        <form action="register.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" name="username" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <div class="form-group">
                <label>Nama User</label>
                <input type="text" class="form-control" name="nama" required>
            </div>
            <div class="form-group">
                <label>Level</label>
                <select name="level" class="form-control" required>
                    <option value="admin">Admin</option>
                    <option value="kasir">Kasir</option>
                </select>
            </div>
            <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
            <br>
            <a href="index.php" class="btn btn-secondary mt-3">Kembali ke Halaman Utama</a>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script>
        // Script untuk menutup notifikasi dengan tombol close
        $(document).ready(function(){
            $(".alert .close").click(function(){
                $(this).parent().fadeOut("slow");
            });
        });
    </script>
</body>
</html>
