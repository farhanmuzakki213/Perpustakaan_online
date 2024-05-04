<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      margin: 0;
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
      background: #f8f9fa;
      height: 100%;
    }
    
    .page-wrapper {
      position: relative;
      overflow: hidden;
      background: url('./assets/images/logos/bg-login.jpg') center/cover no-repeat fixed; 
    }
    


  </style>
</head>
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
data-sidebar-position="fixed" data-header-position="fixed">
<div
class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
<div class="d-flex align-items-center justify-content-center w-100">
  <div class="row justify-content-center w-100">
    <div class="col-md-8 col-lg-3 col-lg-3">
      <div class="card mb-0">
        <div class="card-body">
          <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
            <img src="./assets/images/logos/tekinfo.png" width="180" alt="">
          </a>
          <p class="text-center">E-PERPUSTAKAAN</p>
          <form method="post" action="cek_login.php">
            <div class="mb-3">
              <label for="inputUsername" class="form-label">Username</label>
              <input type="text" class="form-control" id="inputUsername" placeholder="Username" name="username">
            </div>
            <div class="mb-4">
              <label for="InputPassword" class="form-label">Password</label>
              <input type="password" class="form-control" id="InputPassword" placeholder="Password" name="password">
            </div>
            <div class="d-flex align-items-center justify-content-between mb-4">
              <div class="form-check">
                <input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked" checked>
                <label class="form-check-label text-dark" for="flexCheckChecked">
                  Remeber this Device
                </label>
              </div>
              <a class="text-primary fw-bold" href="./index.html">Forgot Password ?</a>
            </div>
            <button class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" type="submit" name="submit" >Sign In</button>
            <div class="d-flex align-items-center justify-content-center">
              <p class="fs-4 mb-0 fw-bold">New User?</p>
              <a class="text-primary fw-bold ms-2" href="index.php?p=register">Create an account</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>

