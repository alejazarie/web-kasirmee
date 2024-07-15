<?php 

// koneksi
$koneksi = mysqli_connect('localhost', 'root', '', 'kasir_zibran');  



// summon admin

function summon_admin()
{
	global $koneksi;
	$id = $_SESSION['idkaskit'];
	return mysqli_query($koneksi, "SELECT * FROM tb_user WHERE id ='$id'");
}

// -------------------------------------USER SECTION--------------------------------------------------------------------
// select user by admin

function select_laporan()
{
	global $koneksi;
	return mysqli_query($koneksi, "SELECT * FROM laporan_penjualan");
}


// Insert user

function insert_user()
{
	global $koneksi;
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	$nama = $_POST['nama'];
	$level = $_POST['level'];
	$foto = $_FILES['foto']['name'];

	// cek username
	$cek = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username ='$username'");
	$row = mysqli_fetch_row($cek);

	if ($row) {
		echo "username  '%".$username."%' sudah ada";
	}else if($foto != ""){
		
		$allowed_ext = array('png','jpg');
		$x = explode(".", $foto);
		$ekstensi = strtolower(end($x));
		$file_tmp = $_FILES['foto']['tmp_name'];
		$angka_acak = rand(1,999);
   		$nama_file_baru = $angka_acak.'-'.$foto;
   		    if (in_array($ekstensi, $allowed_ext) 	=== true) {
      			move_uploaded_file($file_tmp, 'img/'.$nama_file_baru);
      			$result = mysqli_query($koneksi, "INSERT INTO tb_user SET username='$username', password='$password', nama='$nama', level='$level', foto='$nama_file_baru'");
      			
    }



	
	}else if($foto==""){
		return mysqli_query($koneksi, "INSERT INTO tb_user SET username='$username', password='$password', nama='$nama', level='$level'");
	}
}

// delete user

function delete_user()
{
	global $koneksi;
	$id = $_POST['id'];
	$cekimg = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE id='$id'");
	$row = mysqli_fetch_array($cekimg);

	// hapus gambar
	$foto = $row['foto'];
	unlink("img/$foto");
	return mysqli_query($koneksi, "DELETE FROM tb_user WHERE id='$id'");
}


function update_user()
{
    global $koneksi;
    $id = mysqli_real_escape_string($koneksi, $_POST['id']);
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, md5($_POST['password'])); // Gunakan md5 atau fungsi hash lainnya sesuai kebutuhan
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    
    // Validasi input tidak boleh kosong
    if (empty($username) || empty($password) || empty($nama)) {
        $_SESSION['message'] = "Please fill out this field.";
        $_SESSION['message_type'] = "danger";
        return false; // Atau berikan pesan error jika perlu
    }
    
    // Untuk foto, pastikan file upload di-handle dengan benar
    if (!empty($_FILES['foto']['name'])) {
        $foto = $_FILES['foto']['name'];
        $file_tmp = $_FILES['foto']['tmp_name'];

        // Proses upload foto
        $allowed_ext = array('png', 'jpg');
        $x = explode(".", $foto);
        $ekstensi = strtolower(end($x));
        $angka_acak = rand(1, 999);
        $nama_file_baru = $angka_acak . '-' . $foto;

        if (in_array($ekstensi, $allowed_ext)) {
            move_uploaded_file($file_tmp, '../admin/img/' . $nama_file_baru);
        }

        // Query untuk mengupdate data dengan foto baru
        $query = "UPDATE tb_user SET username='$username', password='$password', nama='$nama', foto='$nama_file_baru' WHERE id='$id'";
    } else {
        // Query untuk mengupdate data tanpa mengubah foto
        $query = "UPDATE tb_user SET username='$username', password='$password', nama='$nama' WHERE id='$id'";
    }

    // Eksekusi query
    $result = mysqli_query($koneksi, $query);

    // Cek apakah berhasil atau tidak
    if ($result) {
        // Jika ada foto lama, hapus foto lama dari direktori
        if (!empty($_POST['ubahfoto'])) {
            $unlink = mysqli_query($koneksi, "SELECT foto FROM tb_user WHERE id='$id'");
            $row = mysqli_fetch_array($unlink);
            $hapus_foto = $row['foto'];
            if (!empty($hapus_foto)) {
                unlink("../admin/img/$hapus_foto");
            }
        }
        return true; // Berhasil update
    } else {
        return false; // Gagal update
    }
}



// ---------------------------------------------------TRANSAKSI SECTION----------------------------------------------------------
function insert_transaksi()
{
	global $koneksi;
	$kdproduk = $_POST['kdproduk'];
	$nm_produk = $_POST['nm_produk'];
	$kategori = $_POST['kategori'];
	$total = $_POST['harga'];

	$tanggal = $_POST['tanggal'];
	$jam = $_POST['jam'];
	$kasir = $_POST['kasir'];

	//validasi

	$select  = mysqli_query($koneksi, "SELECT * FROM transaksi_temp WHERE kdproduk = '$kdproduk'");
	$row = mysqli_fetch_row($select);

	if ($row) {
		echo '<script>alert("Produk sudah ada dalam pesanan")</script>';
	}else{
		// insert into transaksi temp
		$query1 =  mysqli_query($koneksi, "INSERT INTO transaksi_temp SET kdproduk='$kdproduk', nm_produk='$nm_produk', kategori='$kategori', jumlah_beli=1, total='$total'");
		// query 2 to insert into transaction report
		$query_2 = mysqli_query($koneksi, "INSERT INTO laporan_penjualan SET kdproduk='$kdproduk', nm_produk='$nm_produk', kategori='$kategori', jumlah_beli=1, total='$total', tanggal='$tanggal', jam='$jam', kasir='$kasir'");
	}

	

}

function update_transaksi_1()
{
    global $koneksi;
    $id = $_POST['id'];
    $kdproduk = $_POST['kdproduk'];
    $jumlah_beli = isset($_POST['jumlah_beli']) ? $_POST['jumlah_beli'] : 0; // Tetapkan nilai default jika tidak ada input

    // Ambil data harga dan stok dari tabel produk
    $select_produk = mysqli_query($koneksi, "SELECT harga, stok FROM tb_produk WHERE kdproduk='$kdproduk'");
    $produk_data = mysqli_fetch_assoc($select_produk);
    $harga_asli = $produk_data['harga'];
    $stok_produk = $produk_data['stok'];

    // Validasi stok cukup untuk update
    if ($jumlah_beli > $stok_produk) {
        echo '<script>alert("Stok tidak mencukupi untuk jumlah beli tersebut.")</script>';
        return;
    }

    // Hitung total harga baru berdasarkan jumlah beli baru
    $harga_baru = $jumlah_beli * $harga_asli;

    // Update jumlah beli dan total harga di transaksi_temp
    $update_transaksi = mysqli_query($koneksi, "UPDATE transaksi_temp SET jumlah_beli='$jumlah_beli', total='$harga_baru' WHERE id='$id'");

    if (!$update_transaksi) {
        echo "Error updating transaksi_temp: " . mysqli_error($koneksi);
        return;
    }

    // Refresh halaman setelah berhasil update
    echo "<meta http-equiv='refresh' content='0'>";
}

// url
function url()
{
	return $url = "//localhost/web-kasir/vendors/";
}

function rupiah($angka){
	$hasil = "Rp. ". number_format($angka,2,',','.');
	return $hasil;
}

 ?>
