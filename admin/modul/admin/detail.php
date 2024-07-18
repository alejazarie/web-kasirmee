<?php include 'comp/header.php'; ?>
<?php
if (isset($_POST['edit'])) {
    // Validasi input kosong atau spasi
    if (empty(trim($_POST['username'])) || empty(trim($_POST['password'])) || empty(trim($_POST['nama'])) || empty(trim($_POST['level']))) {
        echo '<div id="notif" class="alert alert-danger alert-dismissible fade show" role="alert">
               <strong>Harap lengkapi semua field.</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>';
    } else {
        echo "<meta http-equiv='refresh' content='0'>";
        update_user();
    }
}
?>
<style>
/* CSS untuk notifikasi */
#notif {
    position: fixed; /* Tetap di posisi tetap di layar */
    top: 20px; /* Jarak dari atas */
    right: 500px; /* Jarak dari kanan */
    z-index: 9999; /* Mengatur tumpukan di atas elemen lain */
    width: 300px; /* Lebar notifikasi */
    border-radius: 5px; /* Sudut melengkung */
    box-shadow: 0 0 10px rgba(0,0,0,0.1); /* Bayangan */
    padding: 15px; /* Padding dalam notifikasi */
    background-color: #f8d7da; /* Warna latar belakang */
    color: #721c24; /* Warna teks */
    border: 1px solid #f5c6cb; /* Border */
}

#notif button.close {
    position: absolute; /* Menempatkan tombol close */
    top: 10px; /* Jarak dari atas */
    right: 5px; /* Jarak dari kanan */
    font-size: 20px; /* Ukuran font */
    color: inherit; /* Warna ikon close */
}
</style>

   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style=" background: linear-gradient(90deg, rgba(34,193,195,1) 0%, rgba(240,45,253,1) 100%);">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Detail <?= $key['nama']; ?></h1><br>

          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Detail <?= $key['nama'];?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->

        <div class="row">
        	<div class="col-sm-12">
        	<div class="table-responsive">
        		<table class="table table-borderless">
        			<tbody>
        				<tr>
        					<td>Nama : </td>
        					<td><?php echo $key['nama']; ?></td>
        				</tr>
        				<tr>
        					<td>Level User: </td>
        					<td>
        						<?php 

        						if ($key['level']=="admin") {
        							echo '<b><p style="color: green;">admin</p></b>';
        						}else if ($key['level']=="kasir") {
        							echo '<b><p style="color: blue;">kasir</p></b>';
        						}

        						 ?>
        					</td>
        					<tr>
        						<td>Foto : </td>
        						<td>
        							<?php 

        							if ($key['foto']!= '') {
        								echo '<img src="img/'.$key['foto'].'" data-target="#view_image" data-toggle="modal" height="150">';
        							}else{
        								echo '<img src="img/user_logo.png" height="150">';
        							}

        							 ?>

        							 <!-- modal img -->
        							          <div class="modal fade" id="view_image" tabindex="-1" role="dialog" aria-labelledby="view_image" aria-hidden="true">
            <div class="modal-dialog" role="document">
           
          <!--       <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <b><p class="modal-title" id="view_image" style="text-align: center; font-size: 18px;">Edit Data Admin</p></b>
                </div> -->
                <!-- Modal Body -->
              <!--   <div class="modal-body"> </div> -->
                <center><img src="img/<?= $key['foto'];?>" height="512"></center>
               
           
            </div>
        						</td>
        					</tr>
        					<tr>
        						<td>
        								<!-- Trigger modal edit -->
       				<div data-toggle="modal" data-target="#edit-profil<?= $key['id'] ?>">
                  <button type="button" class="btn btn-info datapotensi" data-toggle="tooltip" title="Edit">
                    <i class="fa fa-edit"></i>
                  </button>
                </div>
                <!-- Modal edit -->
                          <div class="modal fade" id="edit-profil<?= $key['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="edit-profil<?= $adm['id'] ?>" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <b><p class="modal-title" id="edit-profil<?= $adm['id'] ?>" style="text-align: center; font-size: 18px;">Edit Data Admin</p></b>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                 <form action="" method="POST" enctype="multipart/form-data">
                  <input type="hidden" value="<?= $key['id'] ?>" name="id">

  <div class="form-group">
    <label>Username</label>
    <input type="text" class="form-control" value="<?= $key['username'];?>" id="exampleInputEmail1" name="username" aria-describedby="emailHelp" placeholder="Masukkan Username">
   
  </div>
    <div class="form-group">
    <label>Password</label>
    <input type="password" class="form-control" id="exampleInputEmail1" name="password" aria-describedby="emailHelp" required placeholder="Masukkan password">
    
   
  </div>
    <div class="form-group">
    <label>Nama User</label>
    <input type="text" class="form-control" value="<?= $key['nama'];?>" id="exampleInputEmail1" name="nama" aria-describedby="emailHelp" placeholder="Masukkan nama">
   
  </div>
  <div class="form-group">
    <label>Level User</label>
    <input type="text" class="form-control" value="<?= $key['level']; ?>" id="exampleInputEmail1" name="level" aria-describedby="emailHelp" placeholder="Masukkan level" <?php if ($key['level'] == 'admin') echo 'readonly';?>>
</div>

   <div class="form-group">
    <label>Foto User</label>
    <br>
    <?php 

        							if ($key['foto']!= '') {
        								echo '<img src="img/'.$key['foto'].'" height="150">';
        							}else{
        								echo '<img src="img/user_logo.png" height="150">';
        							}

        							 ?>
   	 <input type="checkbox" name="ubahfoto" value="true">Klik jika ingin ubah foto <br>
  </div>

      <div class="form-group">
    <label>Masukkan Foto Baru</label>
    <input type="file" name="foto">
   
  </div>
  

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="edit" class="btn btn-primary">Save changes</button>
      </div>
        </form>
                </div>
              </div>
            </div>
        						</td>
        					</tr>
        				</tr>
        			</tbody>
        		</table>
        	</div>
        </div>

      </div> 
        <!-- /.row -->
        <!-- Main row -->
      
          </section>
              <!-- /.card-body -->
              
            <!-- /.card -->

            <!-- solid sales graph -->
           </div>

<?php include 'comp/footer.php'; ?>