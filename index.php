<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Perpustakaan</title>
  <link rel="shortcut icon" type="image/png" href="./assets/images/logos/tekinfo.png" />
  <link rel="stylesheet" href="./assets/css/styles.min.css"/>
  <link rel="stylesheet" href="./assets/css/styles2.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"/>
  

</head>

<body>
  <?php
    session_start();
    $p = isset($_GET["p"]) ? $_GET["p"] : "home";

    // Tambahkan pengecekan khusus untuk halaman selain login, register, dan index
    if ($p != "login" && $p != "register" && $p != "index" && $p != "home" && !isset($_SESSION['login'])) {
        echo "<script>alert('Anda harus login terlebih dahulu!');</script>";
        echo "<script>location='index.php?p=login';</script>";
        exit;
    }
    // proses logout
    if ($p == "logout") {
        // hapus session
        session_destroy();

        // redirect ke halaman login
        echo "<script>location='index.php?p=login';</script>";
        exit;
    }
  ?>
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">          
          <div class="brand-logo d-flex align-items-center justify-content-between mt-3">
            <a href="./index.php" class="text-nowrap logo-img">
              <img src="./assets/images/logos/logo-ti.png" width="180" alt="" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
              <i class="ti ti-x fs-8"></i>
            </div>
          </div>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                <li>
                    <a class="nav-link fs-4 " href="./index.php?p=home">
                    <span>
                    <i class="ti ti-home"></i>
                    </span>
                    <span class="hide-menu">Home</span></a>
                </li>
                <li>
                    <a class="nav-link fs-4" href="./index.php?p=daftarbuku">
                    <span>
                      <i class="ti ti-book"></i>
                    </span>
                    <span class="hide-menu">Daftar Buku</span>
                    </a>
                </li>
                <li >
                    <a class="nav-link fs-4" href="./index.php?p=bookmark">
                    <span>
                      <i class="ti ti-bookmark"></i>
                    </span>
                    <span class="hide-menu">BookMark</span>
                    </a>
                </li>
              <?php if (isset($_SESSION['level']) && $_SESSION['level'] == 'admin') { ?>
                <li class="nav-item">
                    <a class="nav-link fs-4" href="./admin/index.php" target="_blank"><i class="ti ti-edit fs-5"></i> Admin</a>
                </li>
              <?php } 
              ?>
              <li class="nav-item dropdown">
                <?php
                if (isset($_SESSION['login'])) {
                  
                  ?>
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="./assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="index.php?p=profile" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">My Profile</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-mail fs-6"></i>
                      <p class="mb-0 fs-3">My Account</p>
                    </a>
                    <?php
                    echo '<a class="btn btn-outline-primary mx-3 mt-2 d-block" href="index.php?p=logout"><i class="ti ti-logout"></i> Logout</a>';
                    ?>                 
                  </div>
                </div>
                <?php
                          }else {
                            echo '<a class="btn btn-outline-primary mx-3 mt-2 d-block" href="index.php?p=login"><i class="ti ti-login"></i> Login</a>';
                        }
                      ?>
              </li>
            </ul>
            <ul class="navbar-nav">
              <li class="nav-item d-block d-xl-none">
                <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                  <i class="ti ti-menu-2"></i>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                  <i class="ti ti-bell-ringing"></i>
                  <div class="notification bg-primary rounded-circle"></div>
                </a>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->
      <!-- Content Start -->
      <?php
          include 'koneksi.php';
          if ($p == "home" || $p == "index") include "./php/home.php";
          if ($p == "profile") include "./php/my_profile.php";          
          if ($p == "peminjaman") include "./admin/peminjaman.php";
          if ($p == "daftarbuku") include "./php/daftar_buku.php";
          if ($p == "bookmark") include "./php/bookmark.php";
          if ($p == "login") include "./login.php";
          if ($p == "register") include "./register.php";
        ?>
      <!--  Content End -->
    </div>
  <script src="./assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="./assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="./assets/js/sidebarmenu.js"></script>
  <script src="./assets/js/app.min.js"></script>
  <script src="./assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="./assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="./assets/js/dashboard.js"></script>
  <script src="./assets/js/daftar_buku.js"></script>
</body>

</html>