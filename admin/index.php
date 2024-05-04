<?php
session_start();
$p = isset($_GET["p"]) ? $_GET["p"] : "dashboard";

if (!isset($_SESSION['login']) || $_SESSION['login'] == FALSE || $_SESSION['level'] != 'admin') {
    header('location:../index.php?p=login');
    exit();
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Perpustakaan</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/tekinfo.png" />
  <link rel="stylesheet" href="../assets/css/styles.min.css"/>
  
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between mt-3">
          <a href="./index.php" class="text-nowrap logo-img">
            <img src="../assets/images/logos/logo-ti.png" width="180" alt="" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav" class="mt-4">
            <li class="sidebar-item">
              <a class="sidebar-link" href="./index.php" aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="index.php?p=peminjaman" aria-expanded="false">
                <span>
                  <i class="ti ti-clipboard-plus"></i>
                </span>
                <span class="hide-menu">Peminjaman</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="index.php?p=pengembalian" aria-expanded="false">
                <span>
                  <i class="ti ti-clipboard-check"></i>
                </span>
                <span class="hide-menu">Pengembalian</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="index.php?p=dataanggota" aria-expanded="false">
                <span>
                  <i class="ti ti-users"></i>
                </span>
                <span class="hide-menu">Data Anggota</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="index.php?p=databuku" aria-expanded="false">
                <span>
                  <i class="ti ti-book"></i>
                </span>
                <span class="hide-menu">Daftar Buku</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="index.php?p=kategori" aria-expanded="false">
                <span>
                  <i class="ti ti-clipboard-text"></i>
                </span>
                <span class="hide-menu">Kategori</span>
              </a>
            </li>
          </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
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
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
            <li class="nav-item">
              <?php if (isset($_SESSION['level']) && $_SESSION['level'] == 'admin') { ?>
                    <li class="nav-item">
                        <a class="nav-link fs-4" href="../index.php" target="_blank"><i class="ti ti-eye fs-5"></i> View</a>
                    </li>
              <?php } ?>
            </li>
              <li class="nav-item dropdown">
              <?php
                if (isset($_SESSION['login'])) {
                  ?>
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="../assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
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
                    echo '<a class="btn btn-outline-primary mx-3 mt-2 d-block" href="../index.php?p=logout"><i class="ti ti-logout"></i> Logout</a>';
                    ?>                 
                  </div>
                </div>
                  <?php
                    }else {
                      echo '<a class="btn btn-outline-primary mx-3 mt-2 d-block" href="../index.php?p=login"><i class="ti ti-login"></i> Login</a>';
                    }
                  ?>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->
      <!-- Content Start -->
      <div class="container-fluid">
        <?php
          include '../koneksi.php';
          if ($p == "dashboard") include "./dashboard.php";
          if ($p == "peminjaman") include "./peminjaman.php";
          if ($p == "daftarbuku") include "../php/daftar_buku.php";
          if ($p == "profile") include "../php/my_profile.php";
          if ($p == "pengembalian") include "./pengembalian.php";
          if ($p == "dataanggota") include "./data_anggota.php";
          if ($p == "databuku") include "./data_buku.php";
          if ($p == "detailbuku") include "../php/detail_buku.php";
          if ($p == "kategori") include "./kategori.php";
        ?>
      </div>
      <!--  Content End -->
    </div>
  </div>
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/sidebarmenu.js"></script>
  <script src="../assets/js/app.min.js"></script>
  <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="../assets/js/dashboard.js"></script>
</body>

</html>