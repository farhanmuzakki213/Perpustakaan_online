
<?php
$proses = isset($_GET["proses"]) ? $_GET["proses"] : "list";
switch ($proses) {
    case 'list':
?>
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">List Data Peminjaman</h5>
                    <?php if ($_SESSION['level'] == 'admin') { ?>
                        <a href="index.php?p=peminjaman&proses=input" class="btn btn-outline-primary m-1 mb-3">Tambah Peminjaman</a>
                    <?php } ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="example">
                            <thead>
                                <tr>
                                    <th scope="col" style="background-color: #86B6F6; color: white;">Id</th>
                                    <th scope="col" style="background-color: #86B6F6; color: white;">Nama Buku</th>
                                    <th scope="col" style="background-color: #86B6F6; color: white;">Nama Anggota</th>
                                    <th scope="col" style="background-color: #86B6F6; color: white;">tanggal_pinjam</th>
                                    <th scope="col" style="background-color: #86B6F6; color: white;">tanggal_kembali</th>
                                    <th scope="col" style="background-color: #86B6F6; color: white;">Status</th>
                                    <?php if ($_SESSION['level'] == 'admin') { ?>
                                    <th scope="col" style="background-color: #86B6F6; color: white;">Aksi</th>
                                    <?php } ?>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $tampil = mysqli_query($db, "SELECT * FROM buku JOIN peminjaman ON buku.id=peminjaman.id_buku JOIN anggota ON peminjaman.id_anggota = anggota.id_a");
                                $no = 1;
                                while ($data = mysqli_fetch_array($tampil)) {
                                ?>
                                    <tr>
                                        <td><?php echo $data['id']; ?></td>
                                        <td><?php echo $data['judul']; ?></td>
                                        <td><?php echo $data['nama']; ?></td>
                                        <td><?php echo $data['tanggal_pinjam']; ?></td>
                                        <td><?php echo $data['tanggal_kembali']; ?></td>
                                        <td><?php echo $data['status1']; ?></td>
                                        <?php if ($_SESSION['level'] == 'admin') { ?>
                                        <td>
                                            <a href="./proses_peminjaman.php?aksi=hapus&id=<?php echo $data['id'] ?>" onclick="return confirm('Yakin hapus data?')" class="btn btn-danger">Hapus</a>
                                            <a href="index.php?p=peminjaman&proses=edit&id=<?php echo $data['id'] ?>" class="btn btn-success">Edit</a>
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
            header('location:index.php?p=peminjaman');
            exit();
        }
    ?>
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h5 class="card-title fw-semibold mb-4">Tambah Peminjam</h5>
                        <a href="index.php?p=peminjaman" class="btn btn-success">Kembali</a>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form action="./proses_peminjaman.php?aksi=insert" method="post" enctype="multipart/form-data">

                                <div class="mb-3">
                                    <label for="buku" class="form-label">Buku</label>
                                    <select class="form-select" id="buku" name="id_buku">
                                        <option>-Pilih Buku-</option>
                                        <?php
                                        $buku = mysqli_query($db, "SELECT * FROM buku");
                                        while ($data_buku = mysqli_fetch_array($buku)) {
                                            echo "<option value=" . $data_buku['id'] . ">" . $data_buku['id'] . " - " . $data_buku['judul'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="anggota" class="form-label">Anggota</label>
                                    <select class="form-select" id="anggota" name="id_anggota">
                                        <option>-Pilih Anggota-</option>
                                        <?php
                                        $anggota = mysqli_query($db, "SELECT * FROM anggota");
                                        while ($data_anggota = mysqli_fetch_array($anggota)) {
                                            echo "<option value=" . $data_anggota['id_a'] . ">" . $data_anggota['id_a'] . " - " . $data_anggota['nama'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="tgl" class="form-label">Tanggal Pinjam</label>
                                    <div class="row">
                                        <div class="col-3">
                                            <select class="form-select" id="tgl" name="tanggal_pinjam">
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
                                    <label for="tgl" class="form-label">Tanggal Kembali</label>
                                    <div class="row">
                                        <div class="col-3">
                                            <select class="form-select" id="tgl" name="tanggal_kembali">
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
                                    <label for="status" class="form-label">Status</label>
                                    <input type="text" class="form-control" id="status" name="status" rows="5"/>
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
            header('location:index.php?p=peminjaman');
            exit();
        }
    ?>
        <?php
        $id_edit = isset($_GET['id']) ? $_GET['id'] : '';
        $ambil = mysqli_query($db, "SELECT * FROM peminjaman WHERE id='$id_edit'");
        $data = mysqli_fetch_array($ambil);
        ?>
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h5 class="card-title fw-semibold mb-4">Edit Peminjaman</h5>
                            <a href="index.php?p=peminjaman" class="btn btn-success">Kembali</a>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <form action="./proses_peminjaman.php?aksi=update" method="post" enctype="multipart/form-data">
                                    
                                    <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $data['id']; ?>" required>

                                    <div class="mb-3">
                                        <label for="buku" class="form-label">Buku</label>
                                        <select class="form-select" id="buku" name="id_buku">
                                            <option>-Pilih Buku-</option>
                                            <?php
                                                $buku = mysqli_query($db, "SELECT * FROM buku");
                                                while ($data_buku = mysqli_fetch_array($buku)) {
                                                    $selected = ($data_buku['id'] == $data['id_buku']) ? 'selected' : '';
                                                    echo "<option value='" . $data_buku['id'] . "' $selected>" . $data_buku['judul'] . "</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="anggota" class="form-label">Anggota</label>
                                        <select class="form-select" id="anggota" name="id_anggota">
                                            <option>-Pilih Anggota-</option>
                                            <?php
                                                $Anggota = mysqli_query($db, "SELECT * FROM Anggota");
                                                while ($data_anggota = mysqli_fetch_array($Anggota)) {
                                                    $selected = ($data_anggota['id_a'] == $data['id_anggota']) ? 'selected' : '';
                                                    echo "<option value='" . $data_anggota['id_a'] . "' $selected>" . $data_anggota['nama'] . "</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                    <label for="tgl" class="form-label">Tanggal Lahir</label>
                                    <div class="row">
                                        <div class="col-3">
                                            <select class="form-select" id="tgl" name="tanggal_pinjam">
                                                <option value="<?php echo $data['tanggal_pinjam']; ?>">-Tanggal-</option>
                                                <?php
                                                for ($i = 1; $i <= 31; $i++) {
                                                    $selected = ($i == date(
                                                        'd',
                                                        strtotime($data['tanggal_pinjam'])
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
                                                        strtotime($data['tanggal_pinjam'])
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
                                                        strtotime($data['tanggal_pinjam'])
                                                    )) ? 'selected' : '';
                                                    echo "<option value='$i' $selected>$i</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="tgl" class="form-label">Tanggal Lahir</label>
                                    <div class="row">
                                        <div class="col-3">
                                            <select class="form-select" id="tgl" name="tanggal_kembali">
                                                <option value="<?php echo $data['tanggal_kembali']; ?>">-Tanggal-</option>
                                                <?php
                                                for ($i = 1; $i <= 31; $i++) {
                                                    $selected = ($i == date(
                                                        'd',
                                                        strtotime($data['tanggal_kembali'])
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
                                                        strtotime($data['tanggal_kembali'])
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
                                                        strtotime($data['tanggal_kembali'])
                                                    )) ? 'selected' : '';
                                                    echo "<option value='$i' $selected>$i</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <input type="text" class="form-control" id="status" name="status" rows="5" value="<?php echo $data['status1']?? ''; ?>"/>
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
    case 'user':
        $id_user = $_SESSION['id_user'];
        $id_buku = isset($_GET['id']) ? $_GET['id'] : '';
        $ambil = mysqli_query($db, "SELECT * FROM peminjaman WHERE id='$id_buku'");
        $data = mysqli_fetch_array($ambil);
        
    ?>
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h5 class="card-title fw-semibold mb-4">Ajukan Peminjaman</h5>
                        <a href="javascript:history.back(-1)" class="btn btn-success">Kembali</a>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form action="./admin/proses_peminjaman.php?aksi=ajukan" method="post" enctype="multipart/form-data">

                                <div class="mb-3" hidden>
                                    <label for="buku" class="form-label">Buku</label>
                                    <select class="form-select" id="buku" name="id_buku">
                                        <option>-Pilih Buku-</option>
                                        <?php
                                            $buku = mysqli_query($db, "SELECT * FROM buku");
                                            while ($data_buku = mysqli_fetch_array($buku)) {
                                                $selected = ($data_buku['id'] == $data['id_buku']) ? 'selected' : '';
                                                echo "<option value='" . $data_buku['id'] . "' $selected>" . $data_buku['judul'] . "</option>";
                                            }
                                        ?>
                                    </select>
                                </div>

                                <div class="mb-3" >
                                    <label for="anggota" class="form-label">Anggota</label>
                                    <select class="form-select" id="anggota" name="id_anggota">
                                        <option>-Pilih Anggota-</option>
                                        <?php
                                            $Anggota = mysqli_query($db, "SELECT * FROM user JOIN anggota ON user.id_user = anggota.id_user WHERE user.id_user = '$id_user'");
                                            while ($data_anggota = mysqli_fetch_array($Anggota)) {
                                                $selected = ($data_anggota['id_a'] == $data['id_anggota']) ? 'selected' : '';
                                                echo "<option value='" . $data_anggota['id_a'] . "' $selected>" . $data_anggota['nama'] . "</option>";
                                            }
                                        ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="tgl" class="form-label">Tanggal Pinjam</label>
                                    <div class="row">
                                        <div class="col-3">
                                            <select class="form-select" id="tgl" name="tanggal_pinjam">
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
                                    <label for="tgl" class="form-label">Tanggal Kembali</label>
                                    <div class="row">
                                        <div class="col-3">
                                            <select class="form-select" id="tgl" name="tanggal_kembali">
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