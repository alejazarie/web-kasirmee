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
function select_user()
{
    global $koneksi;
    if (isset($_POST['go'])) {
        $cari = $_POST['cari'];
        return mysqli_query($koneksi, "SELECT * FROM tb_user WHERE nama LIKE '%".$cari."%'");
    }else{
        return mysqli_query($koneksi, "SELECT * FROM tb_user");
    }
    
}

function select_user_2()
{
    global $koneksi;
    $query =  mysqli_query($koneksi, "SELECT count(id) AS jadmin FROM tb_user ORDER BY id DESC");
    $key = mysqli_fetch_array($query);
    echo $key['jadmin'];
}


// Insert user

function insert_user()
{
	global $koneksi;

	// Ambil nilai dari form
	$username = mysqli_real_escape_string($koneksi, $_POST['username']);
	$password = md5($_POST['password']);
	$nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
	$level = mysqli_real_escape_string($koneksi, $_POST['level']);
	$foto = $_FILES['foto']['name'];

	// Periksa jika username kosong atau hanya berisi spasi
	if (empty(trim($username))) {
		echo '<script>alert("Username tidak boleh kosong atau hanya berisi spasi")</script>';
		return false;
	}

	// Validasi foto jika ada
	if ($foto != "") {
		$allowed_ext = array('png', 'jpg');
		$x = explode(".", $foto);
		$ekstensi = strtolower(end($x));
		$file_tmp = $_FILES['foto']['tmp_name'];
		$angka_acak = rand(1, 999);
		$nama_file_baru = $angka_acak . '-' . $foto;

		if (in_array($ekstensi, $allowed_ext)) {
			move_uploaded_file($file_tmp, 'img/' . $nama_file_baru);
			$query = "INSERT INTO tb_user (username, password, nama, level, foto) VALUES ('$username', '$password', '$nama', '$level', '$nama_file_baru')";
		} else {
			echo '<script>alert("Ekstensi file tidak diizinkan")</script>';
			return false;
		}
	} else {
		// Jika tidak ada foto
		$query = "INSERT INTO tb_user (username, password, nama, level) VALUES ('$username', '$password', '$nama', '$level')";
	}

	// Eksekusi query
	if (mysqli_query($koneksi, $query)) {
		echo '<script>alert("Data user berhasil disimpan")</script>';
		return true;
	} else {
		echo "Error: " . mysqli_error($koneksi);
		return false;
	}
}

// delete user

function delete_user()
{
	global $koneksi;
	$id = $_POST['id'];
	$cekimg = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE id='$id'");
	$row = mysqli_fetch_array($cekimg);
	return mysqli_query($koneksi, "DELETE FROM tb_user WHERE id='$id'");
}

// update user
function update_user()
{
    global $koneksi;
    $id = mysqli_real_escape_string($koneksi, $_POST['id']);
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = md5(mysqli_real_escape_string($koneksi, $_POST['password']));
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $foto = $_FILES['foto']['name'];

    // Validasi input kosong atau spasi
    if (empty(trim($username)) || empty(trim($_POST['password'])) || empty(trim($nama))) {
        return false; // Mengembalikan false jika ada input yang kosong setelah di-trim
    }

    // Hapus foto yang lama jika ada penggantian foto
    $unlink = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE id='$id'");
    $row = mysqli_fetch_array($unlink);
    $hapus_foto = $row['foto'];

    // Update data
    if (isset($_POST['ubahfoto'])) {
        if ($row['foto'] == "") {
            // Tambahkan foto baru jika tidak ada foto sebelumnya
            if ($foto != "") {
                $allowed_ext = array('png', 'jpg');
                $x = explode(".", $foto);
                $ekstensi = strtolower(end($x));
                $file_tmp = $_FILES['foto']['tmp_name'];
                $angka_acak = rand(1, 999);
                $nama_file_baru = $angka_acak . '-' . $foto;
                if (in_array($ekstensi, $allowed_ext) === true) {
                    move_uploaded_file($file_tmp, 'img/' . $nama_file_baru);
                    $result =  mysqli_query($koneksi, "UPDATE tb_user SET username='$username', password='$password', nama='$nama', foto='$nama_file_baru' WHERE id='$id'");
                    return $result;
                }
            }
        } else {
            // Ganti foto dan hapus foto lama jika ada foto sebelumnya
            if ($foto != "") {
                $allowed_ext = array('png', 'jpg');
                $x = explode(".", $foto);
                $ekstensi = strtolower(end($x));
                $file_tmp = $_FILES['foto']['tmp_name'];
                $angka_acak = rand(1, 999);
                $nama_file_baru = $angka_acak . '-' . $foto;
                if (in_array($ekstensi, $allowed_ext) === true) {
                    move_uploaded_file($file_tmp, 'img/' . $nama_file_baru);
                    $result =  mysqli_query($koneksi, "UPDATE tb_user SET username='$username', password='$password', nama='$nama', foto='$nama_file_baru' WHERE id='$id'");
                    if ($result) {
                        unlink("img/$hapus_foto"); // Hapus foto lama setelah berhasil update
                    }
                    return $result;
                }
            }
        }
    }

    // Jika tidak ada penggantian foto, hanya update username, password, dan nama
    return mysqli_query($koneksi, "UPDATE tb_user SET username='$username', password='$password', nama='$nama' WHERE id='$id'");
}

// ---------------------------------------------------RAK SECTION---------------------------------\\

function insert_rak()
{
	global $koneksi;
	$kdrak = $_POST['kdrak'];
	$namarak = $_POST['namarak'];
	return mysqli_query($koneksi, "INSERT INTO tb_rak SET kdrak='$kdrak', namarak='$namarak'"); 
}

function delete_rak()
{
	global $koneksi;
	$id = $_POST['id'];
	return mysqli_query($koneksi, "DELETE FROM tb_rak WHERE id='$id'");

}

function update_rak()
{
	global $koneksi;
	$id = $_POST['id'];
	$kdrak = $_POST['kdrak'];
	$namarak = $_POST['namarak'];
	return mysqli_query($koneksi, "UPDATE tb_rak SET kdrak='$kdrak', namarak='$namarak' WHERE id='$id'");
}


// ----------------------------------------------SUPPLIER SECTION---------------------------------------------------------------\\

function insert_supplier()
{
	global $koneksi;
	$kdspl = $_POST['kdspl'];
	$namaspl = $_POST['namaspl'];
	$alamatspl = $_POST['alamatspl'];
	$kontakspl = $_POST['kontakspl'];
	return mysqli_query($koneksi, "INSERT INTO tb_supplier SET kdspl='$kdspl', namaspl='$namaspl', alamatspl='$alamatspl', kontakspl='$kontakspl'");
}

function hapus_supplier()
{
	global $koneksi;
	$id = $_POST['id'];
	return mysqli_query($koneksi, "DELETE FROM tb_supplier WHERE id='$id'");
}

function update_supplier()
{
	global $koneksi;
	$id = $_POST['id'];
	$kdspl = $_POST['kdspl'];
	$namaspl = $_POST['namaspl'];
	$alamatspl = $_POST['alamatspl'];
	$kontakspl = $_POST['kontakspl'];
	return mysqli_query($koneksi, "UPDATE tb_supplier SET kdspl='$kdspl', namaspl='$namaspl', alamatspl='$alamatspl', kontakspl='$kontakspl' WHERE id='$id'");
}

// ------------------------------------------------------------PRODUK SECTION----------------------------------------------------\\

function insert_produk()
{
    global $koneksi;

    // Pastikan semua data yang diperlukan ada di dalam $_POST
    if (isset($_POST['kdproduk'], $_POST['nm_produk'], $_POST['kategori'], $_POST['stok'], $_POST['harga'])) {
        $kdproduk = $_POST['kdproduk'];
        $nm_produk = $_POST['nm_produk'];
        $kategori = $_POST['kategori'];
        $stok = $_POST['stok'];
        $harga = $_POST['harga'];

        // Validasi tidak boleh kosong atau hanya spasi
        if (empty(trim($kdproduk)) || empty(trim($nm_produk)) || empty(trim($kategori)) || empty(trim($stok)) || empty(trim($harga))) {
            echo '<script>alert("Semua kolom harus diisi.");</script>';
            return false;
        }

        // Validasi nama produk harus unik
        $query_check = "SELECT * FROM tb_produk WHERE nm_produk = ?";
        $stmt_check = mysqli_prepare($koneksi, $query_check);
        mysqli_stmt_bind_param($stmt_check, 's', $nm_produk);
        mysqli_stmt_execute($stmt_check);
        mysqli_stmt_store_result($stmt_check);

        if (mysqli_stmt_num_rows($stmt_check) > 0) {
            echo '<script>alert("Nama produk sudah ada dalam database.");</script>';
            return false;
        }

        // Gunakan parameterized query untuk insert
        $query_insert = "INSERT INTO tb_produk (kdproduk, nm_produk, kategori, stok, harga) VALUES (?, ?, ?, ?, ?)";
        $stmt_insert = mysqli_prepare($koneksi, $query_insert);
        mysqli_stmt_bind_param($stmt_insert, 'sssid', $kdproduk, $nm_produk, $kategori, $stok, $harga);
        
        // Eksekusi statement insert
        $result = mysqli_stmt_execute($stmt_insert);

        // Periksa hasil eksekusi
        if ($result) {
            echo '<script>alert("Produk berhasil ditambahkan.");</script>';
            return true;
        } else {
            echo '<script>alert("Gagal menambahkan produk.");</script>';
            return false;
        }
    } else {
        echo '<script>alert("Semua kolom harus diisi.");</script>';
        return false;
    }
}


//edit 13/07/04
function update_produk()
{
    global $koneksi;
    $id = $_POST['id'];
    $kdproduk = trim($_POST['kdproduk']); // Menghapus spasi di awal dan akhir string
    $nm_produk = trim($_POST['nm_produk']);
    $kategori = trim($_POST['kategori']);
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];

    // Validasi input
    if (empty($kdproduk) || empty($nm_produk)) {
        // Jika ada kolom yang kosong
        echo '<script>alert("Semua kolom harus diisi.");</script>';
        return false; // Menghentikan proses lebih lanjut jika validasi tidak terpenuhi
    } elseif (!is_numeric($stok) || !is_numeric($harga)) {
        // Jika stok/harga bukan angka
        echo '<script>alert("Stok dan harga harus berupa angka.");</script>';
        return false; // Menghentikan proses lebih lanjut jika validasi tidak terpenuhi
    }

    // Gunakan parameterized query untuk menghindari SQL injection
    $query = "UPDATE tb_produk SET kdproduk=?, nm_produk=?, kategori=?, stok=?, harga=? WHERE id=?";
    $stmt = mysqli_prepare($koneksi, $query);

    // Bind parameter ke statement
    mysqli_stmt_bind_param($stmt, 'sssidi', $kdproduk, $nm_produk, $kategori, $stok, $harga, $id);

    // Eksekusi statement
    $result = mysqli_stmt_execute($stmt);

    // Periksa apakah update berhasil
    if ($result) {
        // Redirect atau munculkan pesan berhasil
        echo '<script>alert("Produk berhasil diperbarui.");</script>';
        return true;
    } else {
        // Munculkan pesan gagal
        echo '<script>alert("Gagal memperbarui produk.");</script>';
        return false;
   }
}


function delete_produk()
{
    global $koneksi;
    $id = $_POST['id']; // Anda dapat mengganti ini sesuai dengan cara Anda mengirimkan id dari form

    // Gunakan parameterized query untuk menghindari SQL injection
    $query = "DELETE FROM tb_produk WHERE id=?";
    $stmt = mysqli_prepare($koneksi, $query);

    // Bind parameter ke statement
    mysqli_stmt_bind_param($stmt, 'i', $id);

    // Eksekusi statement
    $result = mysqli_stmt_execute($stmt);

    // Periksa apakah delete berhasil
    if ($result) {
        return true;
    } else {
        return false;
    }
}

function select_produk()
{
    global $koneksi;
    $query = mysqli_query($koneksi, "SELECT COUNT(id) AS jumlah_produk FROM tb_produk");
    $row = mysqli_fetch_assoc($query);
    return $row['jumlah_produk'];
}

// ------------------------------------------------KATEGORI SECTION---------------------------------------------------------------\\\

function insert_kategori()
{
    global $koneksi;
    $kategori = trim($_POST['kategori']); // Menghapus spasi di awal dan akhir

    // Validasi: Pastikan kategori tidak kosong
    if (empty($kategori)) {
        return false; // Kembali false jika kategori kosong
    }

    // Sanitasi input untuk mencegah SQL injection
    $kategori = mysqli_real_escape_string($koneksi, $kategori);

    // Melakukan query INSERT
    return mysqli_query($koneksi, "INSERT INTO tb_kat SET kategori='$kategori'");
}

function hapus_kategori()
{
	global $koneksi;
	$id = $_POST['id'];
	return mysqli_query($koneksi, "DELETE FROM tb_kat WHERE id='$id'");
}

function update_kategori()
{
    global $koneksi;
    $id = mysqli_real_escape_string($koneksi, $_POST['id']);
    $kategori = mysqli_real_escape_string($koneksi, $_POST['kategori']);

    return mysqli_query($koneksi, "UPDATE tb_kat SET kategori='$kategori' WHERE id='$id'");
}


// ---------------------------------------------------PRODUK MASUK SECTION----------------------------------------------------------\\

function produk_masuk()
{
	global $koneksi;
	$noinv = $_POST['noinv'];
	$tanggal = $_POST['tanggal'];
	$jam = $_POST['jam'];
	$kdproduk = $_POST['kdproduk'];
	$nm_produk = $_POST['nm_produk'];
	$kategori = $_POST['kategori'];
	$stok = $_POST['stok'];
	$jml_masuk = $_POST['jml_masuk'];
	$admin = $_POST['admin'];

	// Tambah Stok Tabel Produk

	$tambah_stok = $jml_masuk + $stok;

	$query = mysqli_query($koneksi, "UPDATE tb_produk SET stok='$tambah_stok' WHERE kdproduk='$kdproduk'");

	$query_insert = mysqli_query($koneksi, "INSERT INTO tb_prod_masuk SET noinv='$noinv', tanggal='$tanggal', jam='$jam', kdproduk='$kdproduk', nm_produk='$nm_produk', kategori='$kategori', stok='$stok', jml_masuk='$jml_masuk', admin='$admin'");

	if ($query_insert) {
		echo '<script>window.history.back()</script>';
	}


}

// -----------------------------------------CALL TRANSACTION-------------------------------------------------------------------------\\
function jumlah_saldo()
{
	global $koneksi;
	$jumlah = mysqli_query($koneksi, "SELECT sum(total) as jtotal from laporan_penjualan");
	$row = mysqli_fetch_array($jumlah);
	echo rupiah($row['jtotal']);
}
function jumlah_terjual()
{
	global $koneksi;
	$jumlah = mysqli_query($koneksi, "SELECT sum(jumlah_beli) as jbeli from laporan_penjualan");
	$row = mysqli_fetch_array($jumlah);
	echo $row['jbeli'];

}

// ---------------------------------------------lOGISTIK SECTON-----------------------------------------------------------------\\
function delete_pro_masuk()
{
	global $koneksi;
	$id = $_POST['id'];
	return mysqli_query($koneksi, "DELETE FROM tb_prod_masuk WHERE id='$id'");
}

// Hapus laporan
function hapus_laporan()
{
	global $koneksi;
	return mysqli_query($koneksi, "DELETE FROM laporan_penjualan");
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
