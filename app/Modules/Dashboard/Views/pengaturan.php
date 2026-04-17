<?= $this->extend('Modules\\Shared\\Views\\layout') ?>
<?= $this->section('content') ?>
<div class="pagetitle"><h1>Pengaturan Sistem</h1></div>
<div class="card p-4">
    <h5 class="fw-bold mb-3">Integrasi Midtrans</h5>
    <div class="p-3 bg-light rounded shadow-sm border mb-4">
        <code>MIDTRANS_SERVER_KEY=...</code><br>
        <code>MIDTRANS_CLIENT_KEY=...</code>
    </div>
    <h5 class="fw-bold mb-3">Integrasi Blockchain (Solana/Ethereum)</h5>
    <div class="p-3 bg-light rounded shadow-sm border">
        <code>NETWORK=devnet</code><br>
        <code>WALLET_ADDRESS=...</code>
    </div>
</div>
<?= $this->endSection() ?>
