<?php
    $id_user = $_SESSION['id_user'];
    $email = $_SESSION['email'];
    $username = $_SESSION['username'];
    $level = $_SESSION['level'];
    $password = $_SESSION['password'];
    
    $ambil = mysqli_query($db, "SELECT * FROM user JOIN anggota ON user.id_user = anggota.id_user WHERE user.id_user = '$id_user'");
    $data_profile = mysqli_fetch_array($ambil);
    //print_r($_SESSION);

        ?>
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h5 class="card-title fw-semibold mb-4">My Profile</h5>
                            <a href="javascript:window.history.go(-1)" class="btn btn-success">Kembali</a>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="container rounded bg-white mt-5 mb-5">
                                    <div class="row">
                                        <div class="col-md-3 border-right">
                                            <div class="d-flex flex-column align-items-center text-center p-1 py-2"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="font-weight-bold"><?php echo $username; ?></span><span class="text-black-50"><?php echo $email ?></span><span> </span></div>
                                        </div>
                                        <div class="col-md-5 border-right">
                                        <?php if ($_SESSION['level'] == 'admin') { ?>
                                            <form action="../php/proses_myprofile.php?aksi=ubahprofile" method="post" enctype="multipart/form-data">
                                        <?php } ?> 
                                        <?php if ($_SESSION['level'] == 'user') { ?>
                                            <form action="./php/proses_myprofile.php?aksi=ubahprofile" method="post" enctype="multipart/form-data">
                                        <?php } ?>
                                                <div class="p-1 py-2">
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <h4 class="text-right">Profile Settings</h4>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <input type="hidden" class="form-control" id="id_a" name="id_a" value="<?php echo $data_profile['id_a']?? ''; ?>" >
                                                        <input type="hidden" class="form-control" id="id_user" name="id_user" value="<?php echo $id_user?? ''; ?>" >
                                                        <div class="col-md-12 mb-2">
                                                            <label for="nama"class="labels">Nama</label>
                                                            <input id="nama"  name="nama" type="text" class="form-control" placeholder="nama lengkap" value="<?php echo $data_profile['nama']?? ''; ?>">
                                                        </div>
                                                        <div class="col-md-12 mb-2">
                                                            <label for="alamat"class="labels">Alamat</label>
                                                            <textarea id="alamat"  name="alamat" type="text" class="form-control" placeholder="alamat" ><?php echo $data_profile['alamat']?? ''; ?></textarea>
                                                        </div>                                         
                                                        <div class="col-md-12 mb-2">
                                                            <label for="notelp"class="labels">No Telepon</label>
                                                            <input id="notelp"  name="notelp" type="text" class="form-control" placeholder="no telepon" value="<?php echo $data_profile['no_telp']?? ''; ?>">
                                                        </div>
                                                    </div>                                                
                                                    <div class="mt-5 text-center">
                                                        <button class="btn btn-primary profile-button" type="submit" name="submit">Save Profile</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-md-4">
                                            <form action="./php/proses_myprofile.php?aksi=ubahpass&id=<?php echo $id_user ?>" method="post" enctype="multipart/form-data">
                                                <div class="p-1 py-3">
                                                    
                                                    <div class="d-flex justify-content-between align-items-center experience">
                                                        <h5 class="text-right">Ubah Password</h5>
                                                    </div>
                                                    <input type="hidden" class="form-control" id="id_user" name="id_user" value="<?php echo $id_user ?>" required>
                                                    <input type="hidden" class="form-control" id="password" name="password" value="<?php echo $password ?>" required>
                                                    <div class="col-md-12 mt-4">
                                                        <label for="password_lama" class="labels">Password Lama</label>
                                                        <input type="password" class="form-control" placeholder="password lama" name="password_lama" id="password_lama">
                                                    </div>
                                                    <div class="col-md-12 mt-4">
                                                        <label for="password_baru" class="labels">Password baru</label>
                                                        <input type="password" class="form-control" placeholder="password baru" name="password_baru" id="password_baru">
                                                    </div>
                                                    <div class="col-md-12 mt-2">
                                                        <label for="password_ulang" class="labels">Ulang Password</label>
                                                        <input type="password" class="form-control" placeholder="ulang password" name="password_ulang" id="password_ulang">
                                                    </div>
                                                    <div class="mt-3 text-center">
                                                        <button class="btn btn-primary profile-button" type="submit" name="submit">Save Password</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>