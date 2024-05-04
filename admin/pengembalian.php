
<?php
$proses = isset($_GET["proses"]) ? $_GET["proses"] : "list";
switch ($proses) {
    case 'list':
?>
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">List Data pengembalian</h5>
                    <?php if ($_SESSION['level'] == 'admin') { ?>
                        <a href="index.php?p=pengembalian&proses=input" class="btn btn-outline-primary m-1 mb-3">Tambah pengembalian</a>
                    <?php } ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="example">
                            <thead>
                                <tr>
                                    <th scope="col" style="background-color: #86B6F6; color: white;">Id</th>
                                    <th scope="col" style="background-color: #86B6F6; color: white;">Tanggal_pengembalian</th>
                                    <th scope="col" style="background-color: #86B6F6; color: white;">Nama_peminjam</th>
                                    <th scope="col" style="background-color: #86B6F6; color: white;">Denda</th>
                                    <th scope="col" style="background-color: #86B6F6; color: white;">Status</th>
                                    <?php if ($_SESSION['level'] == 'admin') { ?>
                                    <th scope="col" style="background-color: #86B6F6; color: white;">Aksi</th>
                                    <?php } ?>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $tampil = mysqli_query($db, "SELECT * FROM pengembalian JOIN peminjaman ON pengembalian.id_peminjaman=peminjaman.id JOIN anggota ON peminjaman.id_anggota = anggota.id_a");
                                $no = 1;
                                while ($data = mysqli_fetch_array($tampil)) {
                                ?>
                                    <tr>
                                        <td><?php echo $data['id_pm']; ?></td>
                                        <td><?php echo $data['tanggal_pinjam']; ?></td>
                                        <td><?php echo $data['nama']; ?></td>
                                        <td><?php echo $data['denda']; ?></td>
                                        <td><?php echo $data['status2']; ?></td>
                                        <?php if ($_SESSION['level'] == 'admin') { ?>
                                        <td>
                                            <a href="./proses_pengembalian.php?aksi=hapus&id=<?php echo $data['id_pm'] ?>" onclick="return confirm('Yakin hapus data?')" class="btn btn-danger">Hapus</a>
                                            <a href="index.php?p=pengembalian&proses=edit&id=<?php echo $data['id_pm'] ?>" class="btn btn-success">Edit</a>
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
            header('location:index.php?p=pengembalian');
            exit();
        }
    ?>
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h5 class="card-title fw-semibold mb-4">Tambah pengembalian</h5>
                        <a href="index.php?p=pengembalian" class="btn btn-success">Kembali</a>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form action="./proses_pengembalian.php?aksi=insert" method="post" enctype="multipart/form-data">

                                <div class="mb-3">
                                    <label for="tgl" class="form-label">Tanggal Pengembalian</label>
                                    <div class="row">
                                        <div class="col-3">
                                            <select class="form-select" id="tgl" name="tanggal_pengembalian">
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
                                    <label for="peminjaman" class="form-label">Id Peminjaman</label>
                                    <select class="form-select" id="peminjaman" name="id_peminjaman">
                                        <option>-Pilih Id Peminjaman-</option>
                                        <?php
                                        $peminjaman = mysqli_query($db, "SELECT * FROM peminjaman");
                                        while ($data_peminjaman = mysqli_fetch_array($peminjaman)) {
                                            echo "<option value=" . $data_peminjaman['id'] . ">" . $data_peminjaman['id'] ."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="denda" class="form-label">denda</label>
                                    <input type="number" class="form-control" id="denda" name="denda" rows="5"/>
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
            header('location:index.php?p=pengembalian');
            exit();
        }
    ?>
        <?php
        $id_edit = isset($_GET['id']) ? $_GET['id'] : '';
        $ambil = mysqli_query($db, "SELECT * FROM pengembalian WHERE id_pm='$id_edit'");
        $data = mysqli_fetch_array($ambil);
        ?>
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h5 class="card-title fw-semibold mb-4">Edit pengembalian</h5>
                            <a href="index.php?p=pengembalian" class="btn btn-success">Kembali</a>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <form action="./proses_pengembalian.php?aksi=update" method="post" enctype="multipart/form-data">
                                    
                                    <input type="hidden" class="form-control" id="id_pm" name="id_pm" value="<?php echo $data['id_pm']; ?>" required>

                                    <div class="mb-3">
                                        <label for="tgl" class="form-label">Tanggal Peminjaman</label>
                                    <div class="row">
                                        <div class="col-3">
                                            <select class="form-select" id="tgl" name="tanggal_pengembalian">
                                                <option value="<?php echo $data['tanggal_pengembalian']; ?>">-Tanggal-</option>
                                                <?php
                                                for ($i = 1; $i <= 31; $i++) {
                                                    $selected = ($i == date(
                                                        'd',
                                                        strtotime($data['tanggal_pengembalian'])
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
                                                        strtotime($data['tanggal_pengembalian'])
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
                                                        strtotime($data['tanggal_pengembalian'])
                                                    )) ? 'selected' : '';
                                                    echo "<option value='$i' $selected>$i</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                    <div class="mb-3" hidden>
                                        <label for="peminjaman" class="form-label">Id Peminjaman</label>
                                        <select class="form-select" id="peminjaman" name="id_peminjaman">
                                            <option>-Pilih Id Peminjaman-</option>
                                            <?php
                                                $peminjaman = mysqli_query($db, "SELECT * FROM peminjaman JOIN anggota on peminjaman.id_anggota = anggota.id_a");
                                                while ($data_peminjaman = mysqli_fetch_array($peminjaman)) {
                                                    $selected = ($data_peminjaman['id'] == $data['id_peminjaman']) ? 'selected' : '';
                                                    echo "<option value='" . $data_peminjaman['id'] . "' $selected>" . $data_peminjaman['id'].'-'. $data_peminjaman['nama'] . "</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                                
                                    <div class="mb-3">
                                        <label for="denda" class="form-label">denda</label>
                                        <input type="number" class="form-control" id="denda" name="denda" rows="5" value="<?php echo $data['denda']?? ''; ?>"/>
                                    </div>

                                    <div class="mb-3">
                                        <label for="status2" class="form-label">Status</label>
                                        <input type="text" class="form-control" id="status2" name="status2" rows="5" value="<?php echo $data['status2']?? ''; ?>"/>
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