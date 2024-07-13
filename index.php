<!DOCTYPE html>
<html lang="en" id="home">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Font Awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
      integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />

    <!-- Font Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;600;700&display=swap" rel="stylesheet" />

    <!-- CSS -->
    <link rel="stylesheet" href="dist/css/style.css" />
    <title>kasirmee</title>

   <!--css manual-->
    <link rel="stylesheet" href="manual.css">
   
  </head>
  <body>
    <header>
      <div class="navbar">
        <div class="container">
          <div class="box-navbar " >
            <div class="logo">
              <h1>Kasirmee</h1>
            </div>
            <ul class="menu">
              <li><a href="#home">Home</a></li>
              <li><a href="#services">about us</a></li>
              <li><a href="#pantai">team</a></li>
              <li class="active"><a href="#daftar">daftar</a></li>
            </ul>
            <i class="fa-solid fa-bars menu-bar"></i>
          </div>
        </div>
      </div>

      <div class="hero">
        <div class="container">
          <div class="box-hero" >
            <div class="box">
              <h1>
                Selamat datang di <br />
                halaman website kasirmee
              </h1>
              <p>ini web kasir , kalau yang basah ma kasiram air</p>
             
            </div>
            <div class="box">
              <img src="asset/img/blur-buy-card-cash.jpg" style="border-radius: 35px;" alt="" />
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Services -->
    <div class="services" id="services">

      <div class="container">
      <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
        <div class="box-services" style="background-color: transparent; /* Warna latar belakang kontainer transparan */
    border: 1px solid #ccc; /* Border solid abu-abu */
    border-radius: 10px; /* Sudut bulat untuk kontainer */ ;" >
          <div class="box">
            <i class="fa-solid fa-coins"></i>
            <h4>mudah di gunakan</h4>
            <p></p>
          </div>
          <div class="box">
            <i class="fa-solid fa-certificate"></i>
            <h4>menarik</h4>
            <p></p>
          </div>
          <div class="box">
            <i class="fa-solid fa-people-roof"></i>
            <h4>Aman dan Ramah</h4>
            <p></p>
          </div>
        </div>
      </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <!-- Services -->

    <!-- Pantai -->
<div class="pantai" id="pantai">
  <div class="container">
  <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="box-pantai">
      <div class="box">
        <img src="assets/img/autumn-leaf-falling-revealing-intricate-leaf-vein-generated-by-ai_188544-9869.avif" alt="" />
        <h3>Gawang jati alam</h3>
        <p>Ketua</p>
        
      </div>
      <div class="box">
        <img src="assets/img/autumn-leaf-falling-revealing-intricate-leaf-vein-generated-by-ai_188544-9869.avif" alt="" />
        <h3>dito edhitya</h3>
        <p>Anggota</p>
        
      </div>
      <div class="box">
        <img src="assets/img/autumn-leaf-falling-revealing-intricate-leaf-vein-generated-by-ai_188544-9869.avif" alt="" />
        <h3>Aditya Reza I</h3>
        <p>Anggota</p>
       
      </div>
    </div>
  </div>
</div>
<!-- Pantai -->

    <!-- Daftar -->
    <div class="daftar" id="daftar">
      <div class="container">
      <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="box-daftar" style="background-image: url('asset/img/leaves-8413064_960_720.jpg');
    border-radius: 35px;
    padding: 20px; /* Mengurangi spasi internal di dalam kontainer gambar */
    text-align: center; /* Posisi teks menjadi tengah */
    max-width: 400px; /* Mengatur lebar maksimum kontainer */
    margin: auto; /* Untuk membuat kontainer berada di tengah */
">
          <h1>
            silahkan login untuk memulai <br />
          </h1>
          <div class="button-container" style="background-color: transparent; /* Warna latar belakang kontainer transparan */
    border: 1px solid #ccc; /* Border solid abu-abu */
    border-radius: 10px; /* Sudut bulat untuk kontainer */
    padding: 10px; /* Spasi internal di dalam kontainer */
    display: inline-block; /* Menyusun kontainer secara horizontal */
    margin-top: 6px; /* Spasi atas dari kontainer */
    width: 100%; /* Lebar maksimal sesuai konten */
    text-align: center; /* Posisi teks menjadi tengah */
">
    <p class="login-text" style="color: white; /* Warna teks menjadi putih */
    margin-bottom: 7px; /* Spasi bawah untuk memisahkan teks dan tombol */
    font-family: Georgia, 'Times New Roman', Times, serif;
"><b>login jika sudah<br> memiliki akun</b></p>
    <a href="login_admin.php" class="button" style="margin-top: 10px; /* Spasi atas untuk memisahkan tombol dari teks */
    padding: 10px 20px; /* Padding tombol */
  background-color: #28a745; /* Warna latar belakang tombol */
    color: white; /* Warna teks tombol */
    text-decoration: none; /* Hapus dekorasi teks */
    border-radius: 5px; /* Sudut bulat untuk tombol */
    border: none; /* Hapus border */
    cursor: pointer; /* Kursor menjadi pointer saat diarahkan */
    display: inline-block; /* Menyusun tombol secara horizontal */
    ">Login</a>
</div>

<div class="button-container" style="background-color: transparent; /* Warna latar belakang kontainer transparan */
    border: 1px solid #ccc; /* Border solid abu-abu */
    border-radius: 10px; /* Sudut bulat untuk kontainer */
    padding: 10px; /* Spasi internal di dalam kontainer */
    display: inline-block; /* Menyusun kontainer secara horizontal */
    margin-top: 6px; /* Spasi atas dari kontainer */
    width: 100%; /* Lebar maksimal sesuai konten */
    text-align: center; /* Posisi teks menjadi tengah */
">
    <p class="login-text"><b>regis jika belum <br>memiliki akun</b></p>
    <a href="register.php" class="button" style="padding: 10px 20px; /* Padding tombol */
    background-color: #28a745; /* Warna latar belakang tombol */
    color: white; /* Warna teks tombol */
    text-decoration: none; /* Hapus dekorasi teks */
    border-radius: 5px; /* Sudut bulat untuk tombol */
    border: none; /* Hapus border */
    cursor: pointer; /* Kursor menjadi pointer saat diarahkan */
    display: inline-block; /* Menyusun tombol secara horizontal */
    ">Register</a>
</div>



          
        </div>
      </div>
    </div>
    <!-- Daftar -->

    <!-- Footer -->
    <div class="footer">
      <div class="container">
        <div class="box-footer">
          
            <p>&copy; Copyright by <span>kasirmee</span> All Rights Reserved 2024</p>
          </div>
        </div>
      </div>
    </div>
    <!-- Footer -->

    <script src="dist/js/script.js"></script>
  </body>
</html>
