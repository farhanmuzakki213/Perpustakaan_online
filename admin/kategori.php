
<?php
$proses = isset($_GET["proses"]) ? $_GET["proses"] : "list";
switch ($proses) {
    case 'list':
?>
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Kategori Buku</h5>
                    <?php if ($_SESSION['level'] == 'admin') { ?>
                        <a href="index.php?p=kategori&proses=input" class="btn btn-outline-primary m-1 mb-3">Tambah Kategori</a>
                    <?php } ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="example">
                            <thead>
                                <tr>
                                    <th scope="col" style="background-color: #86B6F6; color: white;">No</th>
                                    <th scope="col" style="background-color: #86B6F6; color: white;">Kategori</th>
                                    <th scope="col" style="background-color: #86B6F6; color: white;">Keterangan</th>
                                    <?php if ($_SESSION['level'] == 'admin') { ?>
                                    <th scope="col" style="background-color: #86B6F6; color: white;">Aksi</th>
                                    <?php } ?>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $tampil = mysqli_query($db, "SELECT * FROM kategori_buku ");
                                $no = 1;
                                while ($data = mysqli_fetch_array($tampil)) {
                                ?>
                                    <tr>
                                        <td><?php echo $data['id']; ?></td>
                                        <td><?php echo $data['kategori']; ?></td>
                                        <td><?php echo $data['keterangan']; ?></td>
                                        <?php if ($_SESSION['level'] == 'admin') { ?>
                                        <td>
                                            <a href="./proses_kategori.php?aksi=hapus&id=<?php echo $data['id'] ?>" onclick="return confirm('Yakin hapus data?')" class="btn btn-danger">Hapus</a>
                                            <a href="index.php?p=kategori&proses=edit&id=<?php echo $data['id'] ?>" class="btn btn-success">Edit</a>
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
            header('location:index.php?p=kategori');
            exit();
        }
    ?>
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h5 class="card-title fw-semibold mb-4">Forms</h5>
                        <a href="index.php?p=kategori" class="btn btn-success">Kembali</a>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form action="./proses_kategori.php?aksi=insert" method="post" enctype="multipart/form-data">

                                <div class="mb-3">
                                    <label for="kategori" class="form-label">Kategori</label>
                                    <input type="text" class="form-control" id="kategori" name="kategori" required>
                                </div>

                                <div class="mb-3">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <textarea class="form-control" id="keterangan" name="keterangan" rows="5"></textarea>
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
            header('location:index.php?p=kategori');
            exit();
        }
    ?>
        <?php
        $id_edit = isset($_GET['id']) ? $_GET['id'] : '';
        $ambil = mysqli_query($db, "SELECT * FROM kategori_buku WHERE id='$id_edit'");
        $data = mysqli_fetch_array($ambil);
        ?>
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h5 class="card-title fw-semibold mb-4">Forms</h5>
                            <a href="index.php?p=kategori" class="btn btn-success">Kembali</a>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <form action="./proses_kategori.php?aksi=update" method="post" enctype="multipart/form-data">
                                    
                                    <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $data['id']; ?>" required>
                                    

                                    <div class="mb-3">
                                        <label for="kategori" class="form-label">Kategori</label>
                                        <input type="text" class="form-control" id="kategori" name="kategori" value="<?php echo $data['kategori']; ?>"required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="keterangan" class="form-label">Keterangan</label>
                                        <textarea class="form-control" id="keterangan" name="keterangan" rows="5"><?php echo $data['keterangan']; ?></textarea>
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