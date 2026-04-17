<?= $this->extend('Modules\\Shared\\Views\\layout') ?>

<?= $this->section('content') ?>
<div class="pagetitle">
  <h1>Pemeriksaan Medis (SOAP)</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
      <li class="breadcrumb-item">Dokter</li>
      <li class="breadcrumb-item active">SOAP Electronic Medical Record</li>
    </ol>
  </nav>
</div>

<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Panel Pemeriksaan Pasien</h5>
          <div class="alert alert-secondary alert-dismissible fade show" role="alert">
            <h6 class="alert-heading">Identitas Pasien: <strong>#P00123 - Budi Santoso</strong></h6>
            <i class="bi bi-info-circle me-1"></i>
            Usia: 45 Thn | Jenis Kelamin: Laki-laki | Alergi: Amoxicillin
          </div>
          
          <!-- Bordered Tabs -->
          <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-home" type="button" role="tab" aria-controls="home" aria-selected="true"><i class="bi bi-journal-text me-1"></i>SOAP & Diagnosis</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-profile" type="button" role="tab" aria-controls="profile" aria-selected="false"><i class="bi bi-prescription me-1"></i>Resep Obat (E-Prescribe)</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#bordered-contact" type="button" role="tab" aria-controls="contact" aria-selected="false"><i class="bi bi-clock-history me-1"></i>Riwayat Pemeriksaan</button>
            </li>
          </ul>

          <div class="tab-content pt-3" id="borderedTabContent">
            <div class="tab-pane fade show active" id="bordered-home" role="tabpanel" aria-labelledby="home-tab">
              <form>
                <div class="row mb-3">
                  <label for="inputSubjective" class="col-sm-2 col-form-label">Subjective (S)</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" style="height: 100px" placeholder="Keluhan utama pasien..."></textarea>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputObjective" class="col-sm-2 col-form-label">Objective (O)</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" style="height: 100px" placeholder="Hasil pemeriksaan fisik, tanda vital..."></textarea>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputAssessment" class="col-sm-2 col-form-label">Assessment (A)</label>
                  <div class="col-sm-10">
                    <select class="form-select mb-2" aria-label="ICD-10">
                      <option selected>Pilih Diagnosis ICD-10</option>
                      <option value="A00">A00 - Cholera</option>
                      <option value="B01">B01 - Varicella [chickenpox]</option>
                      <option value="C00">C00 - Malignant neoplasm of lip</option>
                      <option value="J00">J00 - Acute Nasopharyngitis (Common Cold)</option>
                    </select>
                    <textarea class="form-control" style="height: 60px" placeholder="Keterangan diagnosis tambahan..."></textarea>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputPlan" class="col-sm-2 col-form-label">Plan (P)</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" style="height: 100px" placeholder="Tindakan medis, edukasi, rujukan..."></textarea>
                  </div>
                </div>
              </form>
            </div>
            
            <div class="tab-pane fade" id="bordered-profile" role="tabpanel" aria-labelledby="profile-tab">
              <h6 class="card-title p-0 mb-2">Daftar Obat</h6>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Nama Obat</th>
                    <th>Jumlah</th>
                    <th>Aturan Pakai</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Paracetamol 500mg</td>
                    <td>10</td>
                    <td>3x sehari sesudah makan</td>
                    <td><button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button></td>
                  </tr>
                </tbody>
              </table>
              <button class="btn btn-sm btn-outline-primary mb-3"><i class="bi bi-plus-circle me-1"></i>Tambah Obat</button>
            </div>

            <div class="tab-pane fade" id="bordered-contact" role="tabpanel" aria-labelledby="contact-tab">
               <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  12 Jan 2024 - Poli Umum (Dr. Andi)
                  <span class="badge bg-primary rounded-pill">Lihat Rekam</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  05 Des 2023 - Poli Gigi (Drg. Sarah)
                  <span class="badge bg-primary rounded-pill">Lihat Rekam</span>
                </li>
              </ul>
            </div>
          </div>

          <div class="card-footer bg-white border-0 text-end">
            <button type="button" class="btn btn-success"><i class="bi bi-save me-1"></i>Simpan & Selesai</button>
            <button type="button" class="btn btn-outline-secondary">Tunda Pemeriksaan</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?= $this->endSection() ?>
