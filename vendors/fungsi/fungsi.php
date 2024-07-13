<?php

class log_app
{   

    public $koneksi;

    public function login()
    {
        $this->koneksi;
        $user = $_POST['user'];
        $pass = md5($_POST['pass']);

        // Gunakan parameter binding untuk mengamankan query
        $stmt = mysqli_prepare($this->koneksi, "SELECT * FROM tb_user WHERE username = ? AND password = ?");
        mysqli_stmt_bind_param($stmt, 'ss', $user, $pass);
        mysqli_stmt_execute($stmt);
        $login = mysqli_stmt_get_result($stmt);
        $cek = mysqli_num_rows($login);

        if ($cek > 0) {
            $key = mysqli_fetch_array($login);
            if ($key['level'] == "admin") {
                session_start();
                $_SESSION['idkaskit'] = $key['id'];
                $_SESSION['userkaskit'] = $key['username'];
                $_SESSION['passkaskit'] = $key['password'];
                $_SESSION['namakaskit'] = $key['nama'];
                $_SESSION['levelkaskit'] = $key['level'];
                $_SESSION['fotokaskit'] = $key['foto'];
                header("location: admin/index.php?m=awal");
            } else if ($key['level'] == "kasir") {
                session_start();
                $_SESSION['idkaskit'] = $key['id'];
                $_SESSION['userkaskit'] = $key['username'];
                $_SESSION['passkaskit'] = $key['password'];
                $_SESSION['namakaskit'] = $key['nama'];
                $_SESSION['levelkaskit'] = $key['level'];
                $_SESSION['fotokaskit'] = $key['foto'];
                header("location: kasir/index.php?m=awal");
            }
        } else {
            echo '<div class="alert alert-danger" role="alert">
 username atau password salah
</div>';
        }
    }

    public function sesi()
    {

    }
}

$proses = new log_app();
$proses->koneksi = mysqli_connect('localhost', 'root', '', 'kasir_zibran');

?>
