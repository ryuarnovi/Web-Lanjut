<?= $this->extend('Modules\\Shared\\Views\\layout') ?>

<?= $this->section('content') ?>
<div class="pagetitle">
  <h1>Pendaftaran Pasien Baru</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
      <li class="breadcrumb-item">Resepsionis</li>
      <li class="breadcrumb-item active">Pendaftaran</li>
    </ol>
  </nav>
</div>

<section class="section">
  <div class="row">
    <div class="col-lg-8">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Formulir Pendaftaran Pasien</h5>

          <!-- General Form Elements -->
          <form>
            <div class="row mb-3">
              <label for="inputText" class="col-sm-3 col-form-label">Nama Lengkap</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" placeholder="Masukkan nama sesuai KTP">
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputEmail" class="col-sm-3 col-form-label">NIK (No. KTP)</label>
              <div class="col-sm-9">
                <input type="number" class="form-control" placeholder="16 digit nomor induk kependudukan">
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputPassword" class="col-sm-3 col-form-label">Tanggal Lahir</label>
              <div class="col-sm-9">
                <input type="date" class="form-control">
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
              <div class="col-sm-9">
                <select class="form-select" aria-label="Default select example">
                  <option selected>Pilih Jenis Kelamin</option>
                  <option value="L">Laki-laki</option>
                  <option value="P">Perempuan</option>
                </select>
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputNumber" class="col-sm-3 col-form-label">Unggah Foto KTP</label>
              <div class="col-sm-9">
                <input class="form-control" type="file" id="formFile">
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputPassword" class="col-sm-3 col-form-label">Alamat Lengkap</label>
              <div class="col-sm-9">
                <textarea class="form-control" style="height: 100px"></textarea>
              </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Poli Tujuan</label>
                <div class="col-sm-9">
                  <select class="form-select" aria-label="Poli">
                    <option selected>Pilih Poli</option>
                    <option value="Umum">Poli Umum</option>
                    <option value="Gigi">Poli Gigi</option>
                    <option value="Anak">Poli Anak</option>
                  </select>
                </div>
              </div>

            <div class="row mb-3">
              <div class="col-sm-9 offset-sm-3">
                <button type="submit" class="btn btn-primary">Daftarkan & Ambil Antrean</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
              </div>
            </div>

          </form><!-- End General Form Elements -->

        </div>
      </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Informasi Antrean</h5>
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <i class="bi bi-info-circle me-1"></i>
                    Antrean terisi saat ini: <strong>45 Pasien</strong>
                </div>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-1"></i>
                    Poli Umum tersedia untuk pendaftaran.
                </div>
            </div>
        </div>
    </div>
  </div>
</section>
<?= $this->endSection() ?>
