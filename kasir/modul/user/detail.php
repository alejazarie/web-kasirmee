<?php include 'comp/header.php'; ?>

<?php

if (isset($_POST['edit'])) {
    // Memastikan tidak ada input yang kosong
    if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['nama'])) {
        echo "<meta http-equiv='refresh' content='0'>";
        update_user();
    } else {
        // Jika ada input yang kosong, tampilkan pesan error
        echo '<div class="alert alert-danger" role="alert">
                  Harap lengkapi semua kolom yang diperlukan!
              </div>';
    }
}

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background: linear-gradient(to right,green,white); ;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-11 text-center">
                    <h1 class="m-0 text-dark">Profile <?php echo $key['nama']; ?></h1><br>
                </div><!-- /.col -->
                <div class="col-sm-11">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
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
                                        if ($key['level'] == "admin") {
                                            echo '<b><p style="color: green;">admin</p></b>';
                                        } else if ($key['level'] == "kasir") {
                                            echo '<b><p style="color: blue;">kasir</p></b>';
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Foto : </td>
                                    <td>
                                        <?php 
                                        if ($key['foto'] != '') {
                                            echo '<img src="../admin/img/'.$key['foto'].'" data-target="#view_image" data-toggle="modal" height="150">';
                                        } else {
                                            echo '<img src="img/user_logo.png" height="150">';
                                        }
                                        ?>

                                        <!-- modal img -->
                                        <div class="modal fade" id="view_image" tabindex="-1" role="dialog" aria-labelledby="view_image" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <center><img src="../admin/img/<?= $key['foto'];?>" height="512"></center>
                                            </div>
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
                                        <div class="modal fade" id="edit-profil<?= $key['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="edit-profil<?= $key['id'] ?>" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <b><p class="modal-title" id="edit-profil<?= $key['id'] ?>" style="text-align: center; font-size: 18px;">Edit Data Admin</p></b>
                                                    </div>
                                                    <!-- Modal Body -->
                                                    <div class="modal-body">
                                                        <form action="" method="POST" enctype="multipart/form-data">
                                                            <input type="hidden" value="<?= $key['id'] ?>" name="id">

                                                            <div class="form-group">
                                                                <label>Username</label>
                                                                <input type="text" class="form-control" value="<?= $key['username'];?>" id="exampleInputEmail1" name="username" aria-describedby="emailHelp" placeholder="Masukkan Username" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Password</label>
                                                                <input type="password" class="form-control" id="exampleInputEmail1" name="password" aria-describedby="emailHelp" placeholder="Masukkan password" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Nama User</label>
                                                                <input type="text" class="form-control" value="<?= $key['nama'];?>" id="exampleInputEmail1" name="nama" aria-describedby="emailHelp" placeholder="Masukkan nama" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Level User</label>
                                                                <input type="text" readonly="" class="form-control" value="<?= $key['level'];?>" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Foto User</label>
                                                                <br>
                                                                <?php 
                                                                if ($key['foto'] != '') {
                                                                    echo '<img src="../admin/img/'.$key['foto'].'" height="150">';
                                                                } else {
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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include 'comp/footer.php'; ?>
