
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <h3 class="fw-semibold mb-4">Daftar Buku</h3>
    <?php
    $detail = isset($_GET['detail']) ? $_GET['detail'] : 'home';
    switch ($detail) {
        case 'home':
            $data = mysqli_query($db, "SELECT * FROM kategori_buku JOIN buku ON kategori_buku.id=buku.id_kategori");
            while ($data_buku = mysqli_fetch_array($data)) {
            $img = !empty($data_buku['gambar']) ? $data_buku['gambar'] : 'default.png';
        ?>
                <div class="col-md-3">
                    <div class="card">
                        <img src="./assets/images/upload/<?= $img ?>" style="height: 300px;"  class="card-img-top" alt="...">
                        <div class="card-body" style="height: 170px;">
                            <p class="card-text mb-1 fs-2"><?= $data_buku['pengarang']?></p>
                            <h6 class=" mb-3"><?= $data_buku['judul']?></h6>
                            <p class="card-text fs-2">Kategori: <?= $data_buku['kategori']?></p>
                        </div>
                        <a href="index.php?p=daftarbuku&detail=detail&id=<?= $data_buku['id'] ?>" class="btn btn-primary">Details</a>
                    </div>
                </div>
                <?php
                }
                break;
            case 'detail':
                $ambil_buku = mysqli_query($db, "SELECT * FROM buku WHERE id='$_GET[id]'");
                $data_detail = mysqli_fetch_array($ambil_buku);
                $img = !empty($data_detail['gambar']) ? $data_detail['gambar'] : 'default.png';
                ?>
                </div>
                <div class="row">
                    <div class="col-lg-4 mt-3">
                        <div class="card">
                            <div class="card-body">
                                <img src="./assets/images/upload/<?= $img ?>" class="card-img-top" alt="...">
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                    <div class="row">

                                    <a href="#" class="btn btn-outline-success m-1">Download E-Book</a>
                                    <a href="./index.php?p=peminjaman&proses=user&id=<?php echo $data_detail['id'] ?>" class="btn btn-outline-dark m-1">Ajukan Peminjaman</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        
                        <p class="card-text mb-1"><?= $data_detail['pengarang']?></p>
                        <h5 class="card-title mb-4 fw-semibold"><?= $data_detail['judul']?></h5>
                        <div class="card">
                            <div class="card-body" style="text-align: justify;">
                                <h4 class="card-title mb-2 semibold">Deskripsi</h4>
                                <p class="card-text mb-1"><?= $data_detail['deskripsi']?></p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="card-text fw-semibold">Jumlah Halaman</div>
                                        <div class="card-text fw-light"><?= $data_detail['jml_hal']?></div></br>
                                        
                                        <div class="card-text fw-semibold">Tanggal Terbit</div>
                                        <div class="card-text fw-light"><?= $data_detail['tgl_terbit']?></div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card-text fw-semibold">Penerbit</div>
                                        <div class="card-text fw-light"><?= $data_detail['penerbit']?></div></br>
                                        
                                        <div class="card-text fw-semibold">Bahasa</div>
                                        <div class="card-text fw-light"><?= $data_detail['bahasa']?></div>
                                    </div>
                                </div>                                    
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <button type="submit" name="toggle_favorite" class="btn <?= $isFavorite ? 'btn-danger' :'btn-outline-danger' ?> m-1">
                            <i class="<?= $isFavorite ? 'ti ti-bookmark-filled' : 'ti ti-bookmark' ?> fs-6"></i>
                        </button>
                        <script>
                            $(document).ready(function () {
                                $('#toggleFavorite').on('click', function () {
                                    $.ajax({
                                        type: 'POST',
                                        url: 'proses_bookmark.php',
                                        data: { buku_id: <?= $data_detail['id'] ?> },
                                        success: function (response) {
                                            // Handle response
                                            console.log(response);

                                            // Perbarui ikon tombol berdasarkan respons
                                            if (response === 'added') {
                                                $('#toggleFavorite').html('<i class="ti ti-bookmark-filled"></i> Added to Favorites').addClass('btn-danger').removeClass('btn-outline-danger');
                                            } else if (response === 'removed') {
                                                $('#toggleFavorite').html('<i class="ti ti-bookmark"></i> Add to Favorites').addClass('btn-outline-danger').removeClass('btn-danger');
                                            } else {
                                                // Tampilkan pesan error jika respons tidak dikenali
                                                console.error('Unknown response: ' + response);
                                            }
                                        }
                                    });
                                });
                            });
                        </script>
                    </div>
                    <a href="javascript:history.back(-1)" class="btn btn-primary">Back</a>
                </div>
                
                
                <?php
                break;
        }
        ?>
        </div>
    </div>
</div>