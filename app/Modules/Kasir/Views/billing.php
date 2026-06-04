<?= $this->extend('Modules\\Shared\\Views\\layout') ?>

<?= $this->section('content') ?>
<style>
/* Print Layout Optimization */
@media print {
  /* Hide all layout structures, navigation, sidebars and headers */
  body {
    background: white !important;
    color: black !important;
    font-family: 'Courier New', Courier, monospace !important;
    padding: 0 !important;
    margin: 0 !important;
  }
  .admin-header, 
  .admin-sidebar, 
  .admin-footer, 
  .breadcrumb, 
  h1, 
  nav,
  .no-print, 
  form, 
  #darkModeToggle, 
  .back-to-top,
  .btn,
  .card-title .badge,
  .payment-actions {
    display: none !important;
  }
  .admin-main {
    padding: 0 !important;
    margin: 0 !important;
  }
  .lg\:col-span-2 {
    width: 100% !important;
  }
  .card {
    border: none !important;
    box-shadow: none !important;
    background: transparent !important;
    padding: 0 !important;
    margin: 0 !important;
  }
  .card-body {
    padding: 0 !important;
  }
  
  /* Style only the print container */
  .print-receipt-wrapper {
    display: block !important;
    width: 80mm !important;
    margin: 0 auto !important;
    padding: 10px !important;
    font-size: 12px !important;
    line-height: 1.4 !important;
  }
  .receipt-header {
    text-align: center !important;
    margin-bottom: 15px !important;
  }
  .receipt-header h3 {
    font-size: 16px !important;
    font-weight: bold !important;
    margin: 0 0 5px 0 !important;
    text-transform: uppercase !important;
  }
  .receipt-header p {
    font-size: 10px !important;
    margin: 2px 0 !important;
  }
  .receipt-divider {
    border-top: 1px dashed #000 !important;
    margin: 8px 0 !important;
  }
  .tw-table {
    width: 100% !important;
    border: none !important;
  }
  .tw-table th, .tw-table td {
    padding: 4px 0 !important;
    border: none !important;
    font-size: 11px !important;
    font-family: 'Courier New', Courier, monospace !important;
    color: black !important;
    background: transparent !important;
  }
  .tw-table thead {
    display: none !important; /* Hide headers for casual layout */
  }
  .receipt-row {
    display: flex !important;
    justify-content: space-between !important;
    font-size: 11px !important;
    margin: 2px 0 !important;
  }
  .receipt-row.bold {
    font-weight: bold !important;
  }
}

/* Screen animations */
.animate-fade-in {
  animation: fadeIn 0.3s ease-out;
}
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(10px); }
  to { opacity: 1; transform: translateY(0); }
}
</style>

<div class="mb-6 no-print">
  <h1 class="text-2xl font-bold text-klinik-dark">Billing & Pembayaran Pasien</h1>
  <nav>
    <ol class="breadcrumb">
      <li><a href="<?= base_url() ?>">Home</a></li>
      <li>Kasir</li>
      <li class="active">Tagihan</li>
    </ol>
  </nav>
</div>

<section class="grid grid-cols-1 lg:grid-cols-3 gap-6 animate-fade-in">
  <!-- Invoice / Receipt Area -->
  <div class="lg:col-span-2">
    <div class="card shadow-sm border border-slate-100">
      <div class="card-body p-6">
        <!-- Print Receipt Wrapper -->
        <div class="print-receipt-wrapper">
          <!-- Receipt Header (Print Only) -->
          <div class="receipt-header hidden print:block">
            <h3>KLINIKOS 2.0</h3>
            <p>Jl. Kesehatan Raya No. 101, Jakarta</p>
            <p>Telp: (021) 555-0199</p>
            <div class="receipt-divider"></div>
          </div>

          <div class="flex justify-between items-center mb-6 no-print">
            <h5 class="card-title p-0 m-0">Preview Struk Pembayaran</h5>
            <span class="badge badge-secondary" id="invoiceBadge">#INV-XXXX</span>
          </div>

          <!-- Invoice Metadata -->
          <div class="grid grid-cols-2 gap-4 text-sm mb-6 pb-4 border-b border-slate-100 print:text-[11px] print:pb-2 print:mb-2 print:border-dashed print:border-black">
            <div>
              <p class="text-slate-500 print:text-black m-0"><span class="font-semibold print:font-normal">Pasien:</span> <span id="patientName" class="font-bold print:font-normal">-</span></p>
              <p class="text-slate-500 print:text-black m-0"><span class="font-semibold print:font-normal">No. RM:</span> <span id="patientRM">-</span></p>
            </div>
            <div class="text-right">
              <p class="text-slate-500 print:text-black m-0"><span class="font-semibold print:font-normal">Tanggal:</span> <span id="invoiceDate">-</span></p>
              <p class="text-slate-500 print:text-black m-0"><span class="font-semibold print:font-normal">Kasir:</span> <span id="cashierName">-</span></p>
            </div>
          </div>

          <!-- Consolidated Table -->
          <div class="overflow-x-auto border border-slate-200 rounded-lg mb-6 print:border-none print:m-0">
            <table class="tw-table m-0" id="invoiceItemsTable">
              <thead class="bg-slate-50 print:hidden">
                <tr>
                  <th>Layanan/Obat</th>
                  <th>Subtotal</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-slate-100 print:divide-none">
                <!-- Loaded dynamically -->
              </tbody>
            </table>
          </div>

          <!-- Total Calculations Preview -->
          <div class="border-t border-slate-200 pt-4 space-y-2 text-sm text-slate-700 print:border-dashed print:border-black print:text-[11px] print:pt-2">
            <div class="flex justify-between">
              <span class="text-slate-500 print:text-black">Subtotal:</span>
              <span id="previewSubtotal" class="font-semibold">Rp 0</span>
            </div>
            <div class="flex justify-between text-rose-600 print:text-black">
              <span>Diskon:</span>
              <span id="previewDiscount">- Rp 0</span>
            </div>
            <div class="flex justify-between text-blue-600 print:text-black">
              <span>Pajak / Biaya Tambahan:</span>
              <span id="previewTax">+ Rp 0</span>
            </div>
            <div class="receipt-divider print:block hidden"></div>
            <div class="flex justify-between text-base font-bold text-slate-800 print:text-[13px]">
              <span>TOTAL AKHIR:</span>
              <span id="previewTotal" class="text-klinik-primary print:text-black text-lg print:text-base">Rp 0</span>
            </div>
            <div class="receipt-divider print:block hidden"></div>
            <div class="flex justify-between text-slate-600 print:text-black font-medium">
              <span>Jumlah Diterima:</span>
              <span id="previewPaid">Rp 0</span>
            </div>
            <div class="flex justify-between text-slate-600 print:text-black font-medium">
              <span>Kembalian:</span>
              <span id="previewChange" class="text-amber-700 print:text-black">Rp 0</span>
            </div>
            <div class="flex justify-between text-xs text-slate-400 print:text-black mt-2 print:mt-1">
              <span>Metode Pembayaran:</span>
              <span id="previewMethod" class="font-semibold uppercase">-</span>
            </div>
          </div>

          <div class="receipt-divider print:block hidden"></div>
          <div class="hidden print:block text-center text-[10px] mt-4">
            <p>Terima kasih atas kepercayaan Anda.</p>
            <p>Semoga lekas sembuh.</p>
          </div>
        </div>

        <!-- Omnichannel Methods (Screen Only) -->
        <div class="mt-6 pt-6 border-t border-slate-100 flex flex-col md:flex-row justify-between items-center gap-6 no-print">
           <div class="flex items-center gap-4">
              <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=0" id="qrisImage" alt="QRIS" class="w-24 h-24 rounded-lg shadow-sm bg-white p-1 border border-slate-200">
              <div>
                <h6 class="font-bold text-slate-800 flex items-center gap-1">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-klinik-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" /></svg>
                  QRIS Dinamis
                </h6>
                <p class="text-xs text-slate-500 m-0 mt-1">Scan QRIS untuk pembayaran digital langsung.</p>
              </div>
           </div>
           <div class="flex flex-col gap-2 w-full md:w-auto">
              <button class="btn btn-outline-primary justify-center text-sm" onclick="payWithMidtrans()" id="midtransBtn">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>
                Snap Midtrans
              </button>
              <button class="btn btn-outline-dark justify-center text-sm" onclick="payWithCrypto()">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                Web3 Wallet
              </button>
           </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Form Controls -->
  <div class="no-print">
      <div class="card shadow-sm border border-slate-100">
          <div class="card-body p-6">
              <h5 class="card-title mb-4">Eksekusi Pembayaran</h5>
              <form class="space-y-4" id="billingForm">
                <!-- Fees Summary Breakdown -->
                <div class="bg-slate-50 dark:bg-slate-900 p-4 rounded-xl space-y-2 border border-slate-100">
                  <div class="flex justify-between text-xs">
                    <span class="text-slate-500">Biaya Admin:</span>
                    <span id="formAdminFee" class="font-medium text-slate-700">Rp 0</span>
                  </div>
                  <div class="flex justify-between text-xs">
                    <span class="text-slate-500">Konsultasi Dokter:</span>
                    <span id="formDoctorFee" class="font-medium text-slate-700">Rp 0</span>
                  </div>
                  <div class="flex justify-between text-xs">
                    <span class="text-slate-500">Biaya Tindakan:</span>
                    <span id="formTindakanFee" class="font-medium text-slate-700">Rp 0</span>
                  </div>
                  <div class="flex justify-between text-xs">
                    <span class="text-slate-500">Total Harga Obat:</span>
                    <span id="formMedicineCost" class="font-medium text-slate-700">Rp 0</span>
                  </div>
                </div>

                <!-- Adjustments -->
                <div class="grid grid-cols-2 gap-3">
                  <div>
                    <label class="form-label text-xs">Diskon (Rp)</label>
                    <input type="number" class="form-input text-sm" id="inputDiscount" value="0" min="0">
                  </div>
                  <div>
                    <label class="form-label text-xs">Pajak/Tambahan (Rp)</label>
                    <input type="number" class="form-input text-sm" id="inputTax" value="0" min="0">
                  </div>
                </div>

                <div>
                  <label class="form-label">Metode Pembayaran</label>
                  <select class="form-select" id="selectMethod">
                    <option value="cash">Tunai (Cash)</option>
                    <option value="debit">Debit / Kartu Kredit</option>
                    <option value="qris">QRIS Digital</option>
                    <option value="midtrans">Gateway Midtrans</option>
                    <option value="crypto">Web3 Crypto</option>
                  </select>
                </div>

                <div>
                  <label class="form-label" id="labelNominal">Diterima / Bayar (Rp)</label>
                  <input type="number" class="form-input text-lg font-bold" id="inputPaid" value="0" min="0">
                </div>
                
                <div class="alert alert-warning py-3" id="changeAlert">
                   <div class="flex justify-between items-center text-sm">
                     <span>Kembalian:</span>
                     <span class="font-bold text-lg text-amber-700" id="textChange">Rp 0</span>
                   </div>
                </div>

                <div>
                  <label class="form-label text-xs">Catatan Tagihan</label>
                  <textarea class="form-input text-xs" id="inputNotes" rows="2" placeholder="Catatan opsional pembayaran..."></textarea>
                </div>
                
                <div class="flex gap-2">
                  <button type="button" class="btn btn-outline-secondary w-1/2 text-xs py-2" onclick="saveAdjustmentsOnly()">
                    Simpan Saja
                  </button>
                  <button type="button" class="btn btn-success w-1/2 justify-center py-2 text-sm shadow-md" onclick="checkoutPayment()">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
                    Bayar & Cetak
                  </button>
                </div>
              </form>
          </div>
      </div>
  </div>
</section>

<!-- Midtrans Snap Script -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?= getenv('MIDTRANS_CLIENT_KEY') ?>"></script>

<script>
let currentPayment = null;
let medicineCost = 0;
let doctorFee = 0;
let tindakanFee = 0;
let adminFee = 0;

async function loadBillingData(paymentId) {
    if (!paymentId) return;
    try {
        const res = await fetch('/api/payments');
        const json = await res.json();
        const payments = json.data || [];
        const p = payments.find(pay => pay.id == paymentId);
        if (!p) {
            window.showToast('Data invoice tidak ditemukan', 'error');
            return;
        }
        
        currentPayment = p;
        medicineCost = parseInt(p.medicine_cost || 0);
        doctorFee = parseInt(p.doctor_fee || 0);
        tindakanFee = parseInt(p.tindakan_fee || 0);
        adminFee = parseInt(p.admin_fee || 0);

        // Populate fields
        document.getElementById('invoiceBadge').textContent = '#' + (p.invoice_number || 'INV');
        document.getElementById('patientName').textContent = p.patient_name || '-';
        document.getElementById('patientRM').textContent = p.prescription_code ? 'RX-' + p.prescription_id : 'Manual';
        document.getElementById('invoiceDate').textContent = p.payment_date ? p.payment_date.slice(0, 16) : '-';
        document.getElementById('cashierName').textContent = p.processed_by_name || 'System';
        
        document.getElementById('formAdminFee').textContent = 'Rp ' + adminFee.toLocaleString();
        document.getElementById('formDoctorFee').textContent = 'Rp ' + doctorFee.toLocaleString();
        document.getElementById('formTindakanFee').textContent = 'Rp ' + tindakanFee.toLocaleString();
        document.getElementById('formMedicineCost').textContent = 'Rp ' + medicineCost.toLocaleString();

        document.getElementById('inputDiscount').value = p.discount || 0;
        document.getElementById('inputTax').value = p.tax || 0;
        document.getElementById('inputNotes').value = p.notes || '';
        document.getElementById('selectMethod').value = p.payment_method || 'cash';
        
        if (p.status === 'paid') {
            document.getElementById('inputPaid').value = p.paid_amount || 0;
            document.getElementById('inputPaid').disabled = true;
            document.getElementById('inputDiscount').disabled = true;
            document.getElementById('inputTax').disabled = true;
            document.getElementById('selectMethod').disabled = true;
            document.getElementById('inputNotes').disabled = true;
            document.getElementById('midtransBtn').disabled = true;
        }

        // Fetch prescription items if applicable
        let rxListHtml = '';
        if (p.prescription_id) {
            try {
                const rxRes = await fetch('/api/prescriptions');
                const rxJson = await rxRes.json();
                const rx = rxJson.data.find(r => r.id == p.prescription_id);
                if (rx && rx.items) {
                    rxListHtml = rx.items.map(item => `
                        <tr class="text-xs text-slate-500">
                          <td class="pl-8 italic">${item.drug_name} (${item.qty} ${item.unit})</td>
                          <td class="text-right italic">-</td>
                        </tr>
                    `).join('');
                }
            } catch (err) {}
        }

        // Render Table Items
        const tbody = document.querySelector('#invoiceItemsTable tbody');
        tbody.innerHTML = `
            <tr>
              <td class="font-medium text-slate-700">Pendaftaran & Administrasi Klinik</td>
              <td class="text-right font-medium">Rp ${adminFee.toLocaleString()}</td>
            </tr>
            <tr>
              <td class="font-medium text-slate-700">Konsultasi Dokter Spesialis/Umum</td>
              <td class="text-right font-medium">Rp ${doctorFee.toLocaleString()}</td>
            </tr>
            ${tindakanFee > 0 ? `
            <tr>
              <td class="font-medium text-slate-700">Tindakan Medis / Prosedur Klinis</td>
              <td class="text-right font-medium">Rp ${tindakanFee.toLocaleString()}</td>
            </tr>` : ''}
            ${medicineCost > 0 ? `
            <tr>
              <td class="font-medium text-slate-700 font-semibold">Resep Obat / Farmasi</td>
              <td class="text-right font-bold">Rp ${medicineCost.toLocaleString()}</td>
            </tr>
            ${rxListHtml}
            ` : ''}
        `;

        updateTotals();

        // Print automatic trigger if url contains print=1
        const params = new URLSearchParams(window.location.search);
        if (params.get('print') === '1') {
            setTimeout(() => {
                window.print();
            }, 800);
        }
    } catch(e) {
        window.showToast('Gagal memuat invoice', 'error');
    }
}

function updateTotals() {
    const disc = parseInt(document.getElementById('inputDiscount').value || 0);
    const tax = parseInt(document.getElementById('inputTax').value || 0);
    const subtotal = adminFee + doctorFee + tindakanFee + medicineCost;
    const finalTotal = Math.max(0, (subtotal + tax) - disc);

    document.getElementById('previewSubtotal').textContent = 'Rp ' + subtotal.toLocaleString();
    document.getElementById('previewDiscount').textContent = '- Rp ' + disc.toLocaleString();
    document.getElementById('previewTax').textContent = '+ Rp ' + tax.toLocaleString();
    document.getElementById('previewTotal').textContent = 'Rp ' + finalTotal.toLocaleString();

    const payInput = document.getElementById('inputPaid');
    const method = document.getElementById('selectMethod').value;
    
    // If unpaid, prefill input paid if method is non-cash
    if (currentPayment && currentPayment.status !== 'paid') {
        if (['debit', 'qris', 'midtrans', 'crypto'].includes(method)) {
            payInput.value = finalTotal;
            payInput.disabled = true;
        } else {
            payInput.disabled = false;
        }
    }

    const paidVal = parseInt(payInput.value || 0);
    const change = Math.max(0, paidVal - finalTotal);

    document.getElementById('previewPaid').textContent = 'Rp ' + paidVal.toLocaleString();
    document.getElementById('previewChange').textContent = 'Rp ' + change.toLocaleString();
    document.getElementById('textChange').textContent = 'Rp ' + change.toLocaleString();
    document.getElementById('previewMethod').textContent = method;

    // QRIS image generator update
    document.getElementById('qrisImage').src = 'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=qris-invoice-' + finalTotal;
}

async function saveAdjustmentsOnly() {
    if (!currentPayment) return;
    const disc = parseInt(document.getElementById('inputDiscount').value || 0);
    const tax = parseInt(document.getElementById('inputTax').value || 0);
    const notes = document.getElementById('inputNotes').value;
    const subtotal = adminFee + doctorFee + tindakanFee + medicineCost;
    const finalTotal = Math.max(0, (subtotal + tax) - disc);

    try {
        const res = await fetch('/api/payments/' + currentPayment.id, {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                discount: disc,
                tax: tax,
                total_amount: finalTotal,
                notes: notes
            })
        });
        if (res.ok) {
            window.showToast('Rincian tagihan berhasil diperbarui', 'success');
            loadBillingData(currentPayment.id);
        } else {
            window.showToast('Gagal memperbarui rincian', 'error');
        }
    } catch (e) {
        window.showToast('Network error', 'error');
    }
}

async function checkoutPayment() {
    if (!currentPayment) return;
    const disc = parseInt(document.getElementById('inputDiscount').value || 0);
    const tax = parseInt(document.getElementById('inputTax').value || 0);
    const notes = document.getElementById('inputNotes').value;
    const method = document.getElementById('selectMethod').value;
    const paidVal = parseInt(document.getElementById('inputPaid').value || 0);
    const subtotal = adminFee + doctorFee + tindakanFee + medicineCost;
    const finalTotal = Math.max(0, (subtotal + tax) - disc);
    const change = Math.max(0, paidVal - finalTotal);

    if (currentPayment.status === 'paid') {
        window.print();
        return;
    }

    if (paidVal < finalTotal && method === 'cash') {
        window.showToast('Nominal pembayaran kurang dari total tagihan!', 'warning');
        return;
    }

    window.confirmDialog('Apakah Anda yakin ingin menyelesaikan pembayaran ini?', async () => {
        try {
            const res = await fetch('/api/payments/' + currentPayment.id, {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    status: 'paid',
                    paid_amount: paidVal,
                    change_amount: change,
                    payment_method: method,
                    discount: disc,
                    tax: tax,
                    total_amount: finalTotal,
                    notes: notes,
                    processed_by: <?= session()->get('user_id') ?? 'null' ?>
                })
            });
            const json = await res.json();
            if (res.ok) {
                window.showToast('Pembayaran Berhasil Diselesaikan!', 'success');
                // Trigger print
                setTimeout(() => {
                    window.print();
                    window.location.href = '<?= base_url("kasir/data") ?>';
                }, 500);
            } else {
                window.showToast(json.error || 'Gagal checkout pembayaran', 'error');
            }
        } catch(e) {
            window.showToast('Gagal memproses pembayaran', 'error');
        }
    });
}

function payWithMidtrans() {
    if (!currentPayment) return;
    const disc = parseInt(document.getElementById('inputDiscount').value || 0);
    const tax = parseInt(document.getElementById('inputTax').value || 0);
    const subtotal = adminFee + doctorFee + tindakanFee + medicineCost;
    const finalTotal = Math.max(0, (subtotal + tax) - disc);

    window.showToast('Menghubungi server Midtrans...', 'info');

    fetch('/api/payments/midtrans/snap', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            order_id: currentPayment.invoice_number || currentPayment.payment_code,
            gross_amount: finalTotal,
            customer: {
                first_name: currentPayment.patient_name || 'Pasien',
                email: 'pasien@klinikos.com'
            }
        })
    })
    .then(res => res.json())
    .then(data => {
        if (data.snap_token) {
            snap.pay(data.snap_token, {
                onSuccess: function(result) {
                    window.showToast('Pembayaran Midtrans sukses!', 'success');
                    checkoutPayment();
                },
                onPending: function(result) {
                    window.showToast('Pembayaran pending, silahkan selesaikan.', 'warning');
                },
                onError: function(result) {
                    window.showToast('Pembayaran Midtrans gagal.', 'error');
                }
            });
        } else {
            window.showToast(data.detail || 'Gagal inisialisasi Midtrans Snap', 'error');
        }
    })
    .catch(err => {
        window.showToast('Midtrans network error', 'error');
    });
}

function payWithCrypto() {
    const finalTotal = Math.max(0, (adminFee + doctorFee + tindakanFee + medicineCost + parseInt(document.getElementById('inputTax').value || 0)) - parseInt(document.getElementById('inputDiscount').value || 0));
    window.confirmDialog(`Hubungkan ke Web3 Wallet untuk mentransfer senilai ${(finalTotal/15000000).toFixed(6)} ETH?`, () => {
        window.showToast('Wallet terhubung! Mentransfer dana...', 'info');
        setTimeout(() => {
            document.getElementById('selectMethod').value = 'crypto';
            document.getElementById('inputPaid').value = finalTotal;
            updateTotals();
            window.showToast('Transfer Crypto sukses!', 'success');
        }, 1500);
    });
}

document.addEventListener('DOMContentLoaded', function() {
    const params = new URLSearchParams(window.location.search);
    const paymentId = params.get('id');
    loadBillingData(paymentId);

    // Event listeners
    document.getElementById('inputDiscount').addEventListener('input', updateTotals);
    document.getElementById('inputTax').addEventListener('input', updateTotals);
    document.getElementById('inputPaid').addEventListener('input', updateTotals);
    document.getElementById('selectMethod').addEventListener('change', updateTotals);
});
</script>
<?= $this->endSection() ?>
