

<?php include 'comp/header.php'; ?> 
<?php 

error_reporting(0);

  date_default_timezone_set("Asia/Jakarta");
  $tanggalSekarang = date("Y-m-d");
  $jamSekarang = date("h:i a");


if (isset($_POST['simpan'])) {
  insert_transaksi();
} 

if (isset($_POST['simpan_transaksi'])) {
    echo "<meta http-equiv='refresh' content='0'>";    
  update_transaksi_1();
}

if (isset($_GET['print'])) {
  header("location: print.php");
}
  
global $koneksi;
$select_2 = mysqli_query($koneksi, "SELECT * FROM transaksi_temp");
$row = mysqli_fetch_array($select_2);


?>
  <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper" style="background: linear-gradient(to right,green,white); ">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-11 text-center"> <!-- Menggunakan class text-center untuk membuat tulisan di tengah -->
    <h1 class="m-0 text-dark">Halaman Kasir</h1>
</div><!-- /.col -->

          <div class="col-sm-11">
            <ol class="breadcrumb float-sm-right">

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
            <div class="well">
              <!-- button trigger modal -->
          

     

          <!-- search -->
          

          <!-- end -->
          <!-- Modal -->
         <!--  <div class="modal fade" id="modal_produk" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="" method="POST">
        <label>Cari Nama Produk</label>
        <input type="text" name="cari">
        <button type="submit" class="btn btn-primary" data-target="#modal_produk" name="go">Cari</button>
      </form>
        


 <table width="100%" class="table table-hover"  id="example">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Produk</th>
                                        <th>Nama Produk</th>
                                        <th>Kategori</th>
                                        <th>Harga</th>
                                        
                                        <th>Stok</th>
                                      
                                    </tr>
                                </thead>
                                <tbody>
                    <?php

                    $data = mysqli_query ($koneksi, " SELECT  *
                                            from 
                                            tb_produk
                                            order by id ASC");
                      $no = 1;

                     
                      foreach ($data as $sa):
                        
                      
                    ?>
                  <tr id="tb_produk" data-kdproduk="<?= $sa['kdproduk'];?>" data-nm_produk="<?= $sa['nm_produk'];?>" data-kategori="<?= $sa['kategori'];?>"  data-harga="<?= $sa['harga'];?>">
                    <td>
                      <?php echo $no++; ?>
                    </td>
                    <td>
                      <?php echo $sa['kdproduk']; ?>
                    </td>
                    <td>
                      <?php echo $sa['nm_produk']; ?>
                    </td>
                    <td>
                      <?php echo $sa['kategori']; ?>
                    </td>

                     <td>
                      <?php echo $sa['harga']; ?>
                    </td>
                  
                  </tr>
                  <?php
                    endforeach;
                  ?>
                            </table>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="simpan" class="btn btn-primary">Save changes</button>
      </div>
       
    </div>
  </div>
</div>
            </div>
          </div>  
        </div>

        <br>
 -->
        <!-- form pesanan keranjang -->
            <form action="" method="POST">
            <input type="text" autofocus="" required="" name="cari">
            <button type="submit" name="go" class="btn btn-primary">Cari Produk</button>
          </form>
      <form action="" method="POST" class="mb-2">
        <div class="container-fluid">
          <table class="table table-responsive table-striped">
         <tr>
            <th>Kode Produk</th>
           <th>Nama Produk</th>
           <th>Kategori</th>
           <th>Harga</th>

           <th>Aksi</th>


         </tr>
 <?php 
        global $koneksi;
        if (isset($_POST['go'])) {
          $cari = $_POST['cari'];
           $select_c = mysqli_query($koneksi, "SELECT * FROM tb_produk WHERE nm_produk LIKE '%".$cari."%'");
        }else{

        }

        foreach ($select_c as $res):
       
           ?>
         <tr>
          <td>  
                      <?php echo $res['kdproduk']; ?>
                        <input type="hidden" readonly="" class="" required="" name="kdproduk" value="<?=$res['kdproduk'];?>" class="" placeholder="Kode Produk">
                    </td>
                    <td>
                      <?php echo $res['nm_produk']; ?>
                       <input type="hidden" readonly="" class="" required="" name="nm_produk" value="<?=$res['nm_produk'];?>" class="" placeholder="Kode Produk">
                    </td>
                    <td>
                      <?php echo $res['kategori']; ?>
                       <input type="hidden" readonly="" class="" required="" name="kategori" value="<?=$res['kategori'];?>" class="" placeholder="Kode Produk">
                    </td>

                     <td>
                      <?php echo $res['harga']; ?>
                       <input type="hidden" readonly="" class="" required="" name="harga" value="<?=$res['harga'];?>" class="" placeholder="Kode Produk">
                        <input type="hidden" name="tanggal" value="<?= $tanggalSekarang;?>">
                        <input type="hidden" name="jam" value="<?= $jamSekarang; ?>">
                        <input type="hidden" name="kasir" value="<?= $key['nama']; ?>">
       
                    </td>


                    <td><button type="" name="simpan" class="btn btn-primary"><i class="fa fa-plus"></i></button></td>
           <?php endforeach; ?>
         </tr>



       </table>
        </div>
       
      </form>
      <!-- END FORM PESANAN -->
      
      <div class="table-responsive table--no-card m-b-30">
  <table class="table table-borderless table-striped table-earning">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Produk</th>
        <th>Jumlah Beli</th>
        <th>Harga</th>
        <th>Total</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      $i = 1;
      global $koneksi;
      $select = mysqli_query($koneksi, "SELECT * FROM transaksi_temp");
      foreach ($select as $krj):
        // Ambil data harga dari produk dari tabel tb_produk
        $select_produk = mysqli_query($koneksi, "SELECT harga FROM tb_produk WHERE kdproduk='" . $krj['kdproduk'] . "'");
        $produk_data = mysqli_fetch_assoc($select_produk);
        $harga_asli = $produk_data['harga'];
      ?>
      <tr>
        <td><?= $i++; ?></td>
        <td><?= $krj['nm_produk']; ?></td>
        <td>
          <form action="" method="POST">
            <input type="hidden" name="id" value="<?= $krj['id']; ?>">
            <input type="hidden" name="kdproduk" value="<?= $krj['kdproduk']; ?>">
            <input type="number" name="jumlah_beli" value="<?= $krj['jumlah_beli']; ?>" min="1" required>
        </td>
        <td>Rp<?= number_format($harga_asli, 0, ',', '.'); ?></td> <!-- Tampilkan harga asli dari produk dengan format Rp -->
        <td>Rp<?= number_format($krj['total'], 0, ',', '.'); ?></td> <!-- Tampilkan total dengan format Rp -->
        <td>
          <input type="hidden" name="harga" value="<?= $harga_asli; ?>"> <!-- Simpan harga asli sebagai nilai -->
          <button type="submit" name="simpan_transaksi" class="btn btn-primary"><i class="fa fa-edit"></i> Update</button>
          </form>
          <a href="fungsi/delete.php?id=<?= $krj['id']; ?>" class="btn btn-danger delete-btn" data-id="<?= $krj['id']; ?>"><i class="fa fa-trash"></i> Delete</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>



<script>
// Script untuk handle delete tanpa refresh
document.querySelectorAll('.delete-btn').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        if (confirm('Apakah Anda yakin ingin menghapus item ini?')) {
            let id = this.getAttribute('data-id');
            fetch(`fungsi/delete.php?id=${id}`, { method: 'GET' })
                .then(response => {
                    if (response.ok) {
                        window.location.replace(window.location.href);
                    } else {
                        alert('Gagal menghapus item. Silakan coba lagi.');
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    });
});
</script>



                        <br>
                   <?php 
if (isset($_POST['bayar_submit'])) {
  $total = $_POST['total'];
  $bayar = $_POST['bayar'];

  if (!is_numeric($bayar)) {
      echo '<div class="alert alert-danger" role="alert">Masukkan angka untuk kolom bayar!</div>';
  } else {
      // kembalian + hitung
      if ($bayar < $total) {
          $kurang = $total - $bayar;
          echo '<div class="alert alert-danger" role="alert">Uang Anda kurang ' . number_format($kurang, 0, ',', '.') . ' !</div>';
      } else {
          $kembalian = $bayar - $total;
      }
  }
}

?>

                          <form action="" method="POST">
                          <label>total</label>
                          <?php 
                          global $koneksi;
                          $query = mysqli_query($koneksi, "SELECT sum(total) as jtotal FROM transaksi_temp");
                          $r = mysqli_fetch_array($query);
                           ?>
                          <input type="text" name="total" value="<?= $r['jtotal']; ?>" readonly="">
                          <label>bayar</label>
                          <input type="text" name="bayar" pattern="[0-9]+" title="Masukkan angka saja" required>
                          <button type="submit" class="btn btn-success" required name="bayar_submit">bayar</button>
                          <label>kembalian</label>
                          <input type="text" name="kembalian" value="<?= $kembalian; ?>" readonly="">

                        </form>

                        <!-- Print -->

                          <form action="fungsi/print.php" target="_BLANK" method="POST">
                             
                          
                          <input type="hidden" name="total" value="<?= $total; ?>" readonly="">
                        
                          <input type="hidden" name="bayar" value="<?= $bayar;?>">
                         
                        
                          <input type="hidden" name="kembalian" readonly="" value="<?= $kembalian; ?>">

                          <input type="hidden" name="kasir" value="<?= $key['nama']; ?>">


                          


                          <table class="table-responsive">
                            <tr>
                              
                              <td><a href="index.php"><button type="submit" name="print" class="btn btn-primary" <?php

                               if (empty(isset($_POST['bayar']))) {
                                echo "disabled";
                              }else if(isset($_POST['bayar'])){
                                $total = $_POST['total'];
                                $bayar = $_POST['bayar'];

                                if ($bayar < $total) {
                                  echo "disabled";
                                }
                              }

                               ?>

                              >Print Data</button></a></td>
                            </tr>
                          </table>
                          </form>


                        <!-- END Print -->
          </div>
        </div>
        <?php  ?>
      </div> 
        <!-- /.row -->
        <!-- Main row -->
      
          </section>

              <!-- /.card-body -->
              
            <!-- /.card -->

            <!-- solid sales graph -->
           </div>
      
<?php include 'comp/footer.php'; ?>