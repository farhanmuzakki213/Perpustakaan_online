
<?php
$proses = isset($_GET["proses"]) ? $_GET["proses"] : "list";
switch ($proses) {
    case 'list':
?>
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">List Data Anggota</h5>
                    <?php if ($_SESSION['level'] == 'admin') { ?>
                        <a href="index.php?p=dataanggota&proses=input" class="btn btn-outline-primary m-1 mb-3">Tambah Anggota</a>
                    <?php } ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="example">
                            <thead>
                                <tr>
                                    <th scope="col" style="background-color: #86B6F6; color: white;">Id</th>
                                    <th scope="col" style="background-color: #86B6F6; color: white;">Username</th>
                                    <th scope="col" style="background-color: #86B6F6; color: white;">Nama Anggota</th>
                                    <th scope="col" style="background-color: #86B6F6; color: white;">Alamat</th>
                                    <th scope="col" style="background-color: #86B6F6; color: white;">No Telp</th>
                                    <?php if ($_SESSION['level'] == 'admin') { ?>
                                    <th scope="col" style="background-color: #86B6F6; color: white;">Aksi</th>
                                    <?php } ?>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $tampil = mysqli_query($db, "SELECT * FROM user JOIN anggota ON user.id_user=anggota.id_user");
                                $no = 1;
                                while ($data = mysqli_fetch_array($tampil)) {
                                ?>
                                    <tr>
                                        <td><?php echo $data['id_a']; ?></td>
                                        <td><?php echo $data['username']; ?></td>
                                        <td><?php echo $data['nama']; ?></td>
                                        <td><?php echo $data['alamat']; ?></td>
                                        <td><?php echo $data['no_telp']; ?></td>
                                        <?php if ($_SESSION['level'] == 'admin') { ?>
                                        <td>
                                            <a href="./proses_dataanggota.php?aksi=hapus&id=<?php echo $data['id_a'] ?>" onclick="return confirm('Yakin hapus data?')" class="btn btn-danger">Hapus</a>
                                            <a href="index.php?p=dataanggota&proses=edit&id=<?php echo $data['id_a'] ?>" class="btn btn-success">Edit</a>
                                        </td>
                                        <?php } ?>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>

                        </table>
                    </div>
                </div>    
            </div>
        </div>
    </div>
    <?php
        break;
    case 'input':
        if ($_SESSION['level'] != 'admin') {
            header('location:index.php?p=dataanggota');
            exit();
        }
    ?>
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h5 class="card-title fw-semibold mb-4">Tambah Anggota</h5>
                        <a href="index.php?p=dataanggota" class="btn btn-success">Kembali</a>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form action="./proses_dataanggota.php?aksi=insert" method="post" enctype="multipart/form-data">

                            <div class="mb-3">
                                <label for="user" class="form-label">Username</label>
                                <select class="form-select" id="user" name="id_user">
                                    <option>-Pilih Username-</option>
                                    <?php
                                    $user = mysqli_query($db, "SELECT * FROM user");
                                    while ($data_user = mysqli_fetch_array($user)) {
                                        echo "<option value=" . $data_user['id_user'] . ">" . $data_user['id_user'] . "-" . $data_user['username'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Anggota</label>
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                </div>

                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea class="form-control" id="alamat" name="alamat" rows="5"></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="notelp" class="form-label">No Telp</label>
                                    <input type="number" class="form-control" id="notelp" name="notelp" rows="5"/>
                                </div>

                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                    <button type="reset" class="btn btn-danger" name="reset">Reset</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        break;
    case 'edit':
        if ($_SESSION['level'] != 'admin') {
            header('location:index.php?p=dataanggota');
            exit();
        }
    ?>
        <?php
        $id_edit = isset($_GET['id']) ? $_GET['id'] : '';
        $ambil = mysqli_query($db, "SELECT * FROM anggota WHERE id_a='$id_edit'");
        $data = mysqli_fetch_array($ambil);
        ?>
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h5 class="card-title fw-semibold mb-4">Edit Anggota</h5>
                            <a href="index.php?p=dataanggota" class="btn btn-success">Kembali</a>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <form action="./proses_dataanggota.php?aksi=update" method="post" enctype="multipart/form-data">
                                    
                                    <input type="hidden" class="form-control" id="id_a" name="id_a" value="<?php echo $data['id_a']; ?>" required>
                                    
                                    </div>

                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama Anggota</label>
                                        <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $data['nama']; ?>" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="alamat" class="form-label">Alamat</label>
                                        <textarea class="form-control" id="alamat" name="alamat" rows="5"><?php echo $data['alamat']; ?></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="notelp" class="form-label">No Telp</label>
                                        <input type="number" class="form-control" id="notelp" name="notelp" value="<?php echo $data['no_telp']; ?>" rows="5"/>
                                    </div>

                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                        <button type="reset" class="btn btn-danger" name="reset">Reset</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


<?php
        break;
}

?>