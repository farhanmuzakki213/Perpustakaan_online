
<?php
$proses = isset($_GET["proses"]) ? $_GET["proses"] : "list";
switch ($proses) {
    case 'list':
?>
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">List Data Buku</h5>
                    <?php if ($_SESSION['level'] == 'admin') { ?>
                        <a href="index.php?p=databuku&proses=input" class="btn btn-outline-primary m-1 mb-3">Tambah Buku</a>
                    <?php } ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="example">
                            <thead>
                                <tr>
                                    <th scope="col" style="background-color: #86B6F6; color: white;">Id</th>
                                    <th scope="col" style="background-color: #86B6F6; color: white; width: 200px;">Judul</th>
                                    <th scope="col" style="background-color: #86B6F6; color: white; width: 200px;">Penerbit</th>
                                    <th scope="col" style="background-color: #86B6F6; color: white; width: 250px;">Pengarang</th>
                                    <th scope="col" style="background-color: #86B6F6; color: white;">Tgl_terbit</th>
                                    <?php if ($_SESSION['level'] == 'admin') { ?>
                                    <th scope="col" style="background-color: #86B6F6; color: white;">Aksi & Detail Buku</th>
                                    <?php } ?>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $tampil = mysqli_query($db, "SELECT * FROM kategori_buku JOIN buku ON kategori_buku.id=buku.id_kategori");
                                $no = 1;
                                while ($data = mysqli_fetch_array($tampil)) {
                                ?>
                                    <tr>
                                        <td><?php echo $data['id']; ?></td>
                                        <td><?php echo $data['judul']; ?></td>
                                        <td><?php echo $data['penerbit']; ?></td>
                                        <td><?php echo $data['pengarang']; ?></td>
                                        <td><?php echo $data['tgl_terbit']; ?></td>
                                        <?php if ($_SESSION['level'] == 'admin') { ?>
                                        <td>
                                            <a href="./proses_databuku.php?aksi=hapus&id=<?php echo $data['id'] ?>" onclick="return confirm('Yakin hapus data?')" class="btn btn-danger">Hapus</a>
                                            <a href="index.php?p=databuku&proses=edit&id=<?php echo $data['id'] ?>" class="btn btn-success">Edit</a>
                                            <a href="../index.php?p=daftarbuku&detail=detail&id=<?= $data['id'] ?>"><i class="ti ti-dots-vertical"></i></a>
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
            header('location:index.php?p=databuku');
            exit();
        }
    ?>
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h5 class="card-title fw-semibold mb-4">Tambah Buku</h5>
                        <a href="index.php?p=databuku" class="btn btn-success">Kembali</a>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form action="./proses_databuku.php?aksi=insert" method="post" enctype="multipart/form-data">

                                <div class="mb-3">
                                    <label for="kategori" class="form-label">Kategori</label>
                                    <select class="form-select" id="kategori" name="id_kategori">
                                        <option>-Pilih Kategori-</option>
                                        <?php
                                        $kategori = mysqli_query($db, "SELECT * FROM kategori_buku");
                                        while ($data_kategori = mysqli_fetch_array($kategori)) {
                                            echo "<option value=" . $data_kategori['id'] . ">" . $data_kategori['id'] . "-" . $data_kategori['kategori'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="judul" class="form-label">Judul</label>
                                    <input type="text" class="form-control" id="judul" name="judul" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="penerbit" class="form-label">Penerbit</label>
                                    <input type="text" class="form-control" id="penerbit" name="penerbit" required>
                                </div>

                                <div class="mb-3">
                                    <label for="pengarang" class="form-label">Pengarang</label>
                                    <input type="text" class="form-control" id="pengarang" name="pengarang" required>
                                </div>

                                <div class="mb-3">
                                    <label for="tgl" class="form-label">Tanggal Terbit</label>
                                    <div class="row">
                                        <div class="col-3">
                                            <select class="form-select" id="tgl" name="tgl_terbit">
                                                <option>-Tanggal-</option>
                                                <?php
                                                for ($i = 1; $i <= 31; $i++) {
                                                    echo "<option value=" . $i . ">" . $i . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="col-3">
                                            <select class="form-select" id="bln" name="bln">
                                                <option>-Bulan-</option>
                                                <?php
                                                $namaBln = [
                                                    1 => 'Januari',
                                                    'Februari',
                                                    'Maret',
                                                    'April',
                                                    'Mei',
                                                    'Juni',
                                                    'Juli',
                                                    'Agustus',
                                                    'September',
                                                    'Oktober',
                                                    'November',
                                                    'Desember'
                                                ];
                                                for ($i = 1; $i <= count($namaBln); $i++) {
                                                    echo "<option value='$i'>$namaBln[$i]</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="col-3">
                                            <select class="form-select" id="thn" name="thn">
                                                <option>-Tahun-</option>
                                                <?php
                                                for ($i = date('Y'); $i >= 1970; $i--) {
                                                    echo "<option value='$i'>$i</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>

                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5" required></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="jml_hal" class="form-label">Jumlah Halaman</label>
                                    <input type="number" class="form-control" id="jml_hal" name="jml_hal" rows="5" required/>
                                </div>

                                <div class="mb-3">
                                    <label for="bahasa" class="form-label">Bahasa</label>
                                    <input type="text" class="form-control" id="bahasa" name="bahasa" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="gambar" class="form-label">Upload Gambar</label>
                                    <input type="file" class="form-control" id="gambar" name="gambar">
                                </div>

                                <div class="mb-3">
                                    <label for="jml_buku" class="form-label">Jumlah Buku</label>
                                    <input type="number" class="form-control" id="jml_buku" name="jml_buku" rows="5" required/>
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
            header('location:index.php?p=databuku');
            exit();
        }
    ?>
    <?php
        $id_edit = isset($_GET['id']) ? $_GET['id'] : '';
        $ambil = mysqli_query($db, "SELECT * FROM buku WHERE id='$id_edit'");
        $data = mysqli_fetch_array($ambil);
        ?>
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h5 class="card-title fw-semibold mb-4">Edit Buku</h5>
                        <a href="index.php?p=databuku" class="btn btn-success">Kembali</a>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form action="./proses_databuku.php?aksi=update" method="post" enctype="multipart/form-data">
                                <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $data['id']; ?>" required>
                                <div class="mb-3">
                                    <label for="kategori" class="form-label">Kategori</label>
                                    <select class="form-select" id="kategori" name="id_kategori">
                                        <option>-Pilih Kategori-</option>
                                        <?php
                                            $kategori = mysqli_query($db, "SELECT * FROM kategori_buku");
                                            while ($data_kategori = mysqli_fetch_array($kategori)) {
                                                $selected = ($data_kategori['id'] == $data['id_kategori']) ? 'selected' : '';
                                                echo "<option value='" . $data_kategori['id'] . "' $selected>" . $data_kategori['kategori'] . "</option>";
                                            }
                                        ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="judul" class="form-label">Judul</label>
                                    <input type="text" class="form-control" id="judul" name="judul" value="<?php echo $data['judul']; ?>"required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="penerbit" class="form-label">Penerbit</label>
                                    <input type="text" class="form-control" id="penerbit" name="penerbit" value="<?php echo $data['penerbit']; ?>"required>
                                </div>

                                <div class="mb-3">
                                    <label for="pengarang" class="form-label">Pengarang</label>
                                    <input type="text" class="form-control" id="pengarang" name="pengarang" value="<?php echo $data['pengarang']; ?>"required>
                                </div>

                                <div class="mb-3">
                                    <label for="tgl" class="form-label">Tanggal Lahir</label>
                                    <div class="row">
                                        <div class="col-3">
                                            <select class="form-select" id="tgl" name="tgl_terbit">
                                                <option value="<?php echo $data['tgl_terbit']; ?>">-Tanggal-</option>
                                                <?php
                                                for ($i = 1; $i <= 31; $i++) {
                                                    $selected = ($i == date(
                                                        'd',
                                                        strtotime($data['tgl_terbit'])
                                                    )) ? 'selected' : '';
                                                    echo "<option value='$i' $selected>$i</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <select class="form-select" id="bln" name="bln">
                                                <option value="">-Bulan-</option>
                                                <?php
                                                $namaBln = [
                                                    1 => 'Januari',
                                                    'Februari',
                                                    'Maret',
                                                    'April',
                                                    'Mei',
                                                    'Juni',
                                                    'Juli',
                                                    'Agustus',
                                                    'September',
                                                    'Oktober',
                                                    'November',
                                                    'Desember'
                                                ];
                                                for ($i = 1; $i <= count($namaBln); $i++) {
                                                    $selected = ($i == date(
                                                        'n',
                                                        strtotime($data['tgl_terbit'])
                                                    )) ? 'selected' : '';
                                                    echo "<option value='$i' $selected>$namaBln[$i]</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="col-3">
                                            <select class="form-select" id="thn" name="thn">
                                                <option value="">-Tahun-</option>
                                                <?php
                                                for ($i = date('Y'); $i >= 1970; $i--) {
                                                    $selected = ($i == date(
                                                        'Y',
                                                        strtotime($data['tgl_terbit'])
                                                    )) ? 'selected' : '';
                                                    echo "<option value='$i' $selected>$i</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5" required><?php echo $data['deskripsi']; ?></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="jml_hal" class="form-label">Jumlah Halaman</label>
                                    <input type="number" class="form-control" id="jml_hal" name="jml_hal" rows="5" value="<?php echo $data['jml_hal']; ?>"required/>
                                </div>

                                <div class="mb-3">
                                    <label for="bahasa" class="form-label">Bahasa</label>
                                    <input type="text" class="form-control" id="bahasa" name="bahasa" value="<?php echo $data['bahasa']; ?>"required>
                                </div>

                                <div class="mb-3">
                                    <label for="gambar" class="form-label">Pilih Gambar</label>
                                    <input type="file" class="form-control" id="gambar" name="gambar">
                                </div>

                                <div class="mb-3">
                                    <label for="jml_buku" class="form-label">Jumlah Buku</label>
                                    <input type="number" class="form-control" id="jml_buku" name="jml_buku" rows="5" value="<?php echo $data['tersedia']?? ''; ?>"/>
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