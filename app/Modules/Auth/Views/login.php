<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Login - KlinikOS 2.0</title>
  
  <!-- Favicons -->
  <link href="<?= base_url()?>NiceAdmin/assets/img/favicon.png" rel="icon">
  <link href="<?= base_url()?>NiceAdmin/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= base_url()?>NiceAdmin/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url()?>NiceAdmin/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?= base_url()?>NiceAdmin/assets/css/style.css" rel="stylesheet">

  <style>
    body {
      background: linear-gradient(135deg, #f5f7fb 0%, #e8ecf3 100%);
    }
    .card-login {
      border: none;
      border-radius: 20px;
      box-shadow: 0 15px 35px rgba(0,0,0,0.05);
      overflow: hidden;
    }
    .login-header {
      background: #4154f1;
      padding: 40px;
      color: white;
      text-align: center;
    }
    .login-header h5 {
      font-weight: 700;
      letter-spacing: 1px;
    }
    .btn-login {
      padding: 12px;
      font-weight: 600;
      border-radius: 10px;
      background: #4154f1;
      border: none;
      transition: all 0.3s;
    }
    .btn-login:hover {
      background: #2a3eb1;
      transform: translateY(-2px);
    }
    .form-control {
      padding: 12px 15px;
      border-radius: 10px;
      border: 1px solid #e0e6ed;
    }
    .form-control:focus {
      box-shadow: 0 0 0 0.25 margin rgba(65, 84, 241, 0.1);
      border-color: #4154f1;
    }
  </style>
</head>

<body>

  <main>
    <div class="container">
      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="<?= base_url() ?>" class="logo d-flex align-items-center w-auto">
                  <img src="<?= base_url()?>NiceAdmin/assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block">KlinikOS 2.0</span>
                </a>
              </div><!-- End Logo -->

              <div class="card card-login mb-3">
                <div class="card-body p-0">
                  <div class="login-header">
                    <h5 class="card-title text-center pb-0 fs-4 text-white">Selamat Datang</h5>
                    <p class="text-center small mb-0">Silakan login untuk mengakses Sistem KlinikOS</p>
                  </div>

                  <div class="p-4 pt-5">
                    <?php if(session()->getFlashdata('error')): ?>
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-octagon me-1"></i>
                        <?= session()->getFlashdata('error') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    <?php endif; ?>

                    <form class="row g-3 needs-validation" method="POST" action="<?= base_url('login/auth') ?>" novalidate>
                      <div class="col-12">
                        <label for="username" class="form-label">Username</label>
                        <div class="input-group has-validation">
                          <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-person"></i></span>
                          <input type="text" name="username" class="form-control" id="username" required>
                          <div class="invalid-feedback">Masukkan username Anda.</div>
                        </div>
                      </div>

                      <div class="col-12">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group has-validation">
                          <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-lock"></i></span>
                          <input type="password" name="password" class="form-control" id="password" required>
                          <div class="invalid-feedback">Masukkan password Anda.</div>
                        </div>
                      </div>

                      <div class="col-12">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                          <label class="form-check-label" for="rememberMe">Ingat saya</label>
                        </div>
                      </div>
                      <div class="col-12">
                        <button class="btn btn-primary w-100 btn-login" type="submit">Login</button>
                      </div>
                      <div class="col-12 text-center mt-4">
                        <p class="small mb-0 text-muted">Hanya untuk staf medis terdaftar</p>
                      </div>
                    </form>

                  </div>
                </div>
              </div>

              <div class="credits">
                Designed by <a href="#">KlinikOS Team</a>
              </div>

            </div>
          </div>
        </div>
      </section>
    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="<?= base_url()?>NiceAdmin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url()?>NiceAdmin/assets/js/main.js"></script>

</body>
</html>
