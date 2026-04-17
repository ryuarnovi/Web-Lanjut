<?= $this->extend('Modules\\Shared\\Views\\layout') ?>

<?= $this->section('content') ?>
<div class="pagetitle">
  <h1>Billing & Pembayaran Omnichannel</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
      <li class="breadcrumb-item">Kasir</li>
      <li class="breadcrumb-item active">Tagihan</li>
    </ol>
  </nav>
</div>

<section class="section">
  <div class="row">
    <div class="col-lg-8">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Rincian Invoice <span class="badge bg-secondary">#INV-0422001</span></h5>
          
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Layanan/Obat</th>
                <th>Qty</th>
                <th>Subtotal</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Konsultasi Poli Umum</td>
                <td>1</td>
                <td>Rp 50,000</td>
              </tr>
              <tr>
                <td>Pemeriksaan GDS (Gula Darah)</td>
                <td>1</td>
                <td>Rp 25,000</td>
              </tr>
              <tr>
                <td>Paracetamol 500mg</td>
                <td>10</td>
                <td>Rp 5,000</td>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <th colspan="2" class="text-end">Total Biaya:</th>
                <th>Rp 80,000</th>
              </tr>
            </tfoot>
          </table>
          
          <div class="d-flex justify-content-between align-items-center mt-4">
             <div class="p-3 border rounded bg-light">
                <h6 class="fw-bold mb-1"><i class="bi bi-qr-code me-1"></i>QRIS Dinamis</h6>
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=80000" alt="QRIS" class="img-fluid border shadow-sm">
             </div>
             <div class="text-end">
                <button class="btn btn-outline-primary mb-2 mt-2 w-100"><i class="bi bi-wallet2 me-1"></i>Midtrans Integration</button>
                <button class="btn btn-outline-dark mb-2 w-100"><i class="bi bi-currency-bitcoin me-1"></i>Web3 Crypto (ETH/SOL)</button>
             </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Eksekusi Pembayaran</h5>
                <form>
                  <div class="mb-3">
                    <label class="form-label">Metode</label>
                    <select class="form-select">
                      <option selected>Pilih Metode Bayar</option>
                      <option value="Tunai">Tunai</option>
                      <option value="Debit">Debit/Kredit</option>
                      <option value="E-Wallet">E-Wallet (OVO/GOPAY)</option>
                      <option value="QRIS">QRIS Dinamis</option>
                      <option value="Crypto">Web3 Crypto</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Diterima (Rp)</label>
                    <input type="number" class="form-control" placeholder="100000">
                  </div>
                  <div class="alert alert-warning mb-3">
                     Kembalian: <strong>Rp 20.000</strong>
                  </div>
                  <button type="button" class="btn btn-success w-100"><i class="bi bi-printer me-1"></i>Bayar & Cetak Struk</button>
                </form>
            </div>
        </div>
    </div>
  </div>
</section>
<?= $this->endSection() ?>
