<?= $this->extend('Modules\\Shared\\Views\\layout') ?>

<?= $this->section('content') ?>
<div class="mb-6">
  <h1 class="text-2xl font-bold text-klinik-dark">Billing & Pembayaran Omnichannel</h1>
  <nav>
    <ol class="breadcrumb">
      <li><a href="<?= base_url() ?>">Home</a></li>
      <li>Kasir</li>
      <li class="active">Tagihan</li>
    </ol>
  </nav>
</div>

<section class="grid grid-cols-1 lg:grid-cols-3 gap-6">
  <div class="lg:col-span-2">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title flex items-center gap-2">Rincian Invoice <span class="badge badge-secondary ml-1">#INV-0422001</span></h5>
        
        <div class="overflow-x-auto border border-slate-200 rounded-lg mb-6">
          <table class="tw-table m-0">
            <thead class="bg-slate-50">
              <tr>
                <th>Layanan/Obat</th>
                <th>Qty</th>
                <th class="text-right">Subtotal</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
              <tr>
                <td class="font-medium text-slate-700">Konsultasi Poli Umum</td>
                <td>1</td>
                <td class="text-right">Rp 50,000</td>
              </tr>
              <tr>
                <td class="font-medium text-slate-700">Pemeriksaan GDS (Gula Darah)</td>
                <td>1</td>
                <td class="text-right">Rp 25,000</td>
              </tr>
              <tr>
                <td class="font-medium text-slate-700">Paracetamol 500mg</td>
                <td>10</td>
                <td class="text-right">Rp 5,000</td>
              </tr>
            </tbody>
            <tfoot class="bg-slate-50 font-bold text-slate-800">
              <tr>
                <td colspan="2" class="text-right py-4 px-4 border-t border-slate-200">Total Biaya:</td>
                <td class="text-right py-4 px-4 border-t border-slate-200 text-lg text-klinik-primary">Rp 80,000</td>
              </tr>
            </tfoot>
          </table>
        </div>
        
        <div class="flex flex-col md:flex-row justify-between items-center gap-6 p-4 bg-slate-50 rounded-xl border border-slate-200">
           <div class="flex items-center gap-4">
              <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=80000" alt="QRIS" class="w-24 h-24 rounded-lg shadow-sm bg-white p-1 border border-slate-200">
              <div>
                <h6 class="font-bold text-slate-800 flex items-center gap-1">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-klinik-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" /></svg>
                  QRIS Dinamis
                </h6>
                <p class="text-sm text-slate-500 m-0 mt-1">Scan untuk bayar otomatis</p>
              </div>
           </div>
           <div class="flex flex-col gap-2 w-full md:w-auto">
              <button class="btn btn-outline-primary justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>
                Midtrans Integration
              </button>
              <button class="btn btn-outline-dark justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                Web3 Crypto (ETH/SOL)
              </button>
           </div>
        </div>
      </div>
    </div>
  </div>

  <div>
      <div class="card">
          <div class="card-body">
              <h5 class="card-title">Eksekusi Pembayaran</h5>
              <form class="space-y-4">
                <div>
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
                <div>
                  <label class="form-label">Diterima (Rp)</label>
                  <input type="number" class="form-input" placeholder="100000">
                </div>
                
                <div class="alert alert-warning py-3">
                   <div class="flex justify-between items-center text-sm">
                     <span>Kembalian:</span>
                     <span class="font-bold text-lg text-amber-700">Rp 20.000</span>
                   </div>
                </div>
                
                <button type="button" class="btn btn-success w-full justify-center py-2.5 text-base shadow-md shadow-green-200">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
                  Bayar & Cetak Struk
                </button>
              </form>
          </div>
      </div>
  </div>
</section>
<?= $this->endSection() ?>
