<?php include 'comp/header.php'; ?>
<?php
if (isset($_POST['simpan'])) {
    $kategori = trim($_POST['kategori']); // Menghapus spasi di awal dan akhir

    // Validasi jika Nama Kategori kosong
    if (empty($kategori)) {
        echo '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                Nama Kategori tidak boleh kosong!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
    } elseif (strlen(trim($_POST['kategori'])) === 0) {
        echo '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                Kategori tidak boleh hanya berisi spasi!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
    } else {
        insert_kategori();
    }
}

if (isset($_POST['hapus'])) {
    if (hapus_kategori()) {
        echo '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                Kategori berhasil dihapus.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
    } else {
        echo '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                Gagal menghapus kategori. Silakan coba lagi.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
    }
}


?>

  <div class="content-wrapper" style=" background: linear-gradient(90deg, rgba(34,193,195,1) 0%, rgba(240,45,253,1) 100%);">
    <!-- Content Header (Page header) -->
    <div class="content-header" style="background: url('asset\img/hb.jpg');">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">MENU KATEGORI</h1>
          </div><!-- /.col -->
         
          <!-- /.col -->
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
        		<div class="well">
        			<!-- button trigger modal -->
        			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
					  Tambah data
					</button>

					<!-- Modal -->
					<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah data kategori</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="POST" enctype="multipart/form-data">

  <div class="form-group">
    <label>Nama Kategori</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="kategori">
  
  </div>
   

  

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="simpan" class="btn btn-primary">Save changes</button>
      </div>
        </form>
    </div>
  </div>
</div>

</div>
        	</div>	
        </div>

      

       

       <div class="row">
        <div class="col-sm-12">
          <div class="well">
             <div class="table-responsive table--no-card m-b-30">
                <table class="table table-borderless table-striped table-earning">
                  <thead>
                    <tr>
                        <th>NO</th> 
                    
                        <th>Kategori</th>
                        
                           
                                                
                    </tr>
                  </thead>
                <tbody>     
                    <?php 
                     $i = 1;
                     include 'paging.php';
                      

                     ?>

                             
                </tbody>
                    </table>
                                    
                        </div>
          </div>
          <center><ul class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link" <?php if($halaman > 1){ echo "href='?m=kategori&s=title&halaman=$previous'"; } ?>>Previous</a>
                </li>
                <?php 
                for($x=1;$x<=$total_halaman;$x++){
                    ?> 
                    <li class="page-item"><a class="page-link" href="?m=kategori&s=title&halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
                    <?php
                }
                ?>              
                <li class="page-item">
                    <a  class="page-link" <?php if($halaman < $total_halaman) { echo "href='?m=kategori&s=title&halaman=$next'"; } ?>>Next</a>
                </li>
            </ul>
              </center> 
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