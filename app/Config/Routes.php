<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// --- HALAMAN PUBLIK (TANPA AUTH) ---
$routes->get('/', '\Modules\General\Controllers\General::General');
$routes->get('login', '\Modules\Auth\Controllers\Auth::index');
$routes->post('login/auth', '\Modules\Auth\Controllers\Auth::login');
$routes->get('logout', '\Modules\Auth\Controllers\Auth::logout');

// --- API PUBLIK ---
$routes->post('api/auth/register', '\Modules\Auth\Controllers\Auth::register');
$routes->post('api/auth/login', '\Modules\Auth\Controllers\Auth::loginApi');

// --- HALAMAN TERPROTEKSI (PERLU LOGIN) ---
$routes->group('', ['filter' => 'auth'], function ($routes) {

    // Dashboard
    $routes->get('/', '\Modules\Dashboard\Controllers\Dashboard::index');
    $routes->get('dashboard', '\Modules\Dashboard\Controllers\Dashboard::index');
    $routes->get('dashboard/users', '\Modules\Dashboard\Controllers\Dashboard::users');
    $routes->get('dashboard/logs', '\Modules\Dashboard\Controllers\Dashboard::logs');

    // Fitur Umum
    $routes->get('laporan', '\Modules\Dashboard\Controllers\Dashboard::laporan');
    $routes->get('profile', '\Modules\Dashboard\Controllers\Dashboard::profile');
    $routes->get('pengaturan', '\Modules\Dashboard\Controllers\Dashboard::pengaturan');

    // Resepsionis
    $routes->group('resepsionis', ['filter' => 'auth:admin,resepsionis'], function ($routes) {
        $routes->get('pendaftaran', '\Modules\Resepsionis\Controllers\Resepsionis::pendaftaran');
        $routes->get('antrean', '\Modules\Resepsionis\Controllers\Resepsionis::antrean');
        $routes->get('janji-temu', '\Modules\Resepsionis\Controllers\Resepsionis::janjiTemu');
        $routes->get('pesan', '\Modules\Resepsionis\Controllers\Resepsionis::pesan');
    });

    // Dokter
    $routes->group('dokter', ['filter' => 'auth:admin,dokter'], function ($routes) {
        $routes->get('antrean', '\Modules\Dokter\Controllers\Dokter::antrean');
        $routes->get('soap', '\Modules\Dokter\Controllers\Dokter::soap');
    });

    // Apoteker
    $routes->group('apoteker', ['filter' => 'auth:admin,apoteker'], function ($routes) {
        $routes->get('resep', '\Modules\Apoteker\Controllers\Apoteker::resep');
        $routes->get('stok', '\Modules\Apoteker\Controllers\Apoteker::stok');
        $routes->get('form', '\Modules\Apoteker\Controllers\Apoteker::form');
        $routes->get('supplier', '\Modules\Apoteker\Controllers\Apoteker::supplier');
    });

    // Perawat
    $routes->group('perawat', ['filter' => 'auth:admin,perawat'], function ($routes) {
        $routes->get('antrean', '\Modules\Perawat\Controllers\Perawat::antrean');
        $routes->get('periksa', '\Modules\Perawat\Controllers\Perawat::periksa');
    });

    // Kasir
    $routes->group('kasir', ['filter' => 'auth:admin,kasir'], function ($routes) {
        $routes->get('data', '\Modules\Kasir\Controllers\Kasir::data');
        // $routes->get('billing', '\Modules\Kasir\Controllers\Kasir::billing');
        $routes->get('form', '\Modules\Kasir\Controllers\Kasir::form');
        $routes->get('riwayat', '\Modules\Kasir\Controllers\Kasir::riwayat');
    });
});

// --- API TERPROTEKSI ---
$routes->group('api', ['filter' => 'auth'], function ($routes) {

    // User/Auth API
    $routes->get('users/me', '\Modules\Auth\Controllers\Auth::getMe');
    $routes->post('users/me', '\Modules\Auth\Controllers\Auth::updateMe');
    $routes->post('users/me/photo', '\Modules\Auth\Controllers\Auth::uploadProfilePicture');
    $routes->get('users', '\Modules\Auth\Controllers\Auth::listUsers');
    $routes->get('users/staff', '\Modules\Auth\Controllers\Auth::listStaff');
    $routes->get('users/(:num)', '\Modules\Auth\Controllers\Auth::getUser/$1');
    $routes->post('users', '\Modules\Auth\Controllers\Auth::createUser');
    $routes->put('users/(:num)', '\Modules\Auth\Controllers\Auth::updateUser/$1');
    $routes->delete('users/(:num)', '\Modules\Auth\Controllers\Auth::deleteUser/$1');

    // Drugs API (Apoteker)
    $routes->get('drugs', '\Modules\Apoteker\Controllers\Apoteker::listDrugs');
    $routes->get('drugs/detail', '\Modules\Apoteker\Controllers\Apoteker::listDrugsDetail');
    $routes->get('drugs/low-stock', '\Modules\Apoteker\Controllers\Apoteker::lowStockDrugs');
    $routes->get('drugs/export', '\Modules\Apoteker\Controllers\Apoteker::exportDrugs');
    $routes->get('drugs/template', '\Modules\Apoteker\Controllers\Apoteker::downloadTemplate');
    $routes->post('drugs/import', '\Modules\Apoteker\Controllers\Apoteker::importDrugs');
    $routes->post('drugs', '\Modules\Apoteker\Controllers\Apoteker::createDrug');
    $routes->put('drugs/(:num)', '\Modules\Apoteker\Controllers\Apoteker::updateDrug/$1');
    $routes->delete('drugs/(:num)', '\Modules\Apoteker\Controllers\Apoteker::deleteDrug/$1');
    $routes->get('drugs/(:any)', '\Modules\Apoteker\Controllers\Apoteker::getDrug/$1');

    // Prescriptions API (Apoteker)
    $routes->get('prescriptions', '\Modules\Apoteker\Controllers\Apoteker::listPrescriptions');
    $routes->get('prescriptions/(:num)', '\Modules\Apoteker\Controllers\Apoteker::getPrescription/$1');
    $routes->post('prescriptions', '\Modules\Apoteker\Controllers\Apoteker::createPrescription');
    $routes->put('prescriptions/(:num)', '\Modules\Apoteker\Controllers\Apoteker::updatePrescription/$1');
    $routes->delete('prescriptions/(:num)', '\Modules\Apoteker\Controllers\Apoteker::deletePrescription/$1');

    // Prescription Items API
    $routes->get('prescription-items', '\Modules\Apoteker\Controllers\Apoteker::listPrescriptionItems');
    $routes->post('prescription-items', '\Modules\Apoteker\Controllers\Apoteker::createPrescriptionItem');

    // Patients API (Resepsionis)
    $routes->get('patients/export', '\Modules\Resepsionis\Controllers\Resepsionis::exportPatients');
    $routes->get('patients/template', '\Modules\Resepsionis\Controllers\Resepsionis::downloadPatientTemplate');
    $routes->post('patients/import', '\Modules\Resepsionis\Controllers\Resepsionis::importPatients');
    $routes->get('patients', '\Modules\Resepsionis\Controllers\Resepsionis::listPatients');
    $routes->get('patients/(:num)', '\Modules\Resepsionis\Controllers\Resepsionis::getPatient/$1');
    $routes->post('patients', '\Modules\Resepsionis\Controllers\Resepsionis::createPatient');
    $routes->put('patients/(:num)', '\Modules\Resepsionis\Controllers\Resepsionis::updatePatient/$1');
    $routes->delete('patients/(:num)', '\Modules\Resepsionis\Controllers\Resepsionis::deletePatient/$1');
    $routes->get('patients/payments', '\Modules\Resepsionis\Controllers\Resepsionis::listPatientPayments');

    // Queues API (Resepsionis)
    $routes->get('queues', '\Modules\Resepsionis\Controllers\Resepsionis::listQueues');
    $routes->get('doctors', '\Modules\Resepsionis\Controllers\Resepsionis::listDoctors');
    $routes->get('dokter/list', '\Modules\Resepsionis\Controllers\Resepsionis::listDoctors');
    $routes->get('queues/(:num)', '\Modules\Resepsionis\Controllers\Resepsionis::getQueue/$1');
    $routes->post('queues', '\Modules\Resepsionis\Controllers\Resepsionis::createQueue');
    $routes->put('queues/(:num)', '\Modules\Resepsionis\Controllers\Resepsionis::updateQueue/$1');
    $routes->delete('queues/(:num)', '\Modules\Resepsionis\Controllers\Resepsionis::deleteQueue/$1');

    // Medical Records API (Dokter)
    $routes->get('medical-records', '\Modules\Dokter\Controllers\Dokter::listMedicalRecords');
    $routes->get('medical-records/(:num)', '\Modules\Dokter\Controllers\Dokter::getMedicalRecord/$1');
    $routes->post('medical-records', '\Modules\Dokter\Controllers\Dokter::createMedicalRecord');
    $routes->put('medical-records/(:num)', '\Modules\Dokter\Controllers\Dokter::updateMedicalRecord/$1');
    $routes->delete('medical-records/(:num)', '\Modules\Dokter\Controllers\Dokter::deleteMedicalRecord/$1');

    // Referrals API (Dokter)
    $routes->get('referrals', '\Modules\Dokter\Controllers\Dokter::listReferrals');
    $routes->post('referrals', '\Modules\Dokter\Controllers\Dokter::createReferral');
    $routes->put('referrals/(:num)', '\Modules\Dokter\Controllers\Dokter::updateReferral/$1');
    $routes->delete('referrals/(:num)', '\Modules\Dokter\Controllers\Dokter::deleteReferral/$1');

    // Schedules API (Dokter)
    $routes->get('schedules', '\Modules\Dokter\Controllers\Dokter::listSchedules');
    $routes->post('schedules', '\Modules\Dokter\Controllers\Dokter::createSchedule');
    $routes->put('schedules/(:num)', '\Modules\Dokter\Controllers\Dokter::updateSchedule/$1');
    $routes->delete('schedules/(:num)', '\Modules\Dokter\Controllers\Dokter::deleteSchedule/$1');

    // Shifts API (Dokter)
    $routes->get('shifts', '\Modules\Dokter\Controllers\Dokter::listShifts');
    $routes->post('shifts', '\Modules\Dokter\Controllers\Dokter::createShift');
    $routes->put('shifts/(:num)', '\Modules\Dokter\Controllers\Dokter::updateShift/$1');
    $routes->delete('shifts/(:num)', '\Modules\Dokter\Controllers\Dokter::deleteShift/$1');

    // ICD API (Dokter)
    $routes->get('icd10/search', '\Modules\Dokter\Controllers\Dokter::searchICD10');
    $routes->get('icd9/search', '\Modules\Dokter\Controllers\Dokter::searchICD9');

    // Payments API (Kasir)
    $routes->get('payments', '\Modules\Kasir\Controllers\Kasir::listPayments');
    $routes->post('payments', '\Modules\Kasir\Controllers\Kasir::createPayment');
    $routes->put('payments/(:num)', '\Modules\Kasir\Controllers\Kasir::updatePayment/$1');
    $routes->delete('payments/(:num)', '\Modules\Kasir\Controllers\Kasir::deletePayment/$1');

    // Midtrans API (Kasir)
    $routes->get('midtrans/status/(:any)', '\Modules\Kasir\Controllers\Kasir::midtransPaymentStatus/$1');
    $routes->post('midtrans/snap', '\Modules\Kasir\Controllers\Kasir::createMidtransSnap');
    $routes->post('midtrans/webhook', '\Modules\Kasir\Controllers\Kasir::midtransWebhook');

    // Appointments API (Resepsionis)
    $routes->get('appointments', '\Modules\Resepsionis\Controllers\Resepsionis::listAppointments');
    $routes->get('appointments/(:num)', '\Modules\Resepsionis\Controllers\Resepsionis::getAppointment/$1');
    $routes->put('appointments/(:num)', '\Modules\Resepsionis\Controllers\Resepsionis::updateAppointment/$1');

    // Patient Messages API (Resepsionis)
    $routes->get('messages', '\Modules\Resepsionis\Controllers\Resepsionis::listMessages');
    $routes->get('messages/(:num)', '\Modules\Resepsionis\Controllers\Resepsionis::getMessage/$1');
    $routes->put('messages/(:num)/read', '\Modules\Resepsionis\Controllers\Resepsionis::markMessageRead/$1');
    $routes->delete('messages/(:num)', '\Modules\Resepsionis\Controllers\Resepsionis::deleteMessage/$1');

    // Activity Logs API (Resepsionis)
    $routes->get('activity-logs', '\Modules\Resepsionis\Controllers\Resepsionis::listActivityLogs');
    $routes->get('activity-logs/search', '\Modules\Resepsionis\Controllers\Resepsionis::searchActivityLogs');
    $routes->get('activity-logs/(:num)', '\Modules\Resepsionis\Controllers\Resepsionis::getActivityLog/$1');
    $routes->post('activity-logs', '\Modules\Resepsionis\Controllers\Resepsionis::createActivityLog');

    // Perawat API
    $routes->get('perawat/queues', '\Modules\Perawat\Controllers\Perawat::listQueues');
    $routes->get('perawat/queues/(:num)', '\Modules\Perawat\Controllers\Perawat::getQueue/$1');
    $routes->put('perawat/queues/(:num)', '\Modules\Perawat\Controllers\Perawat::updateQueue/$1');
    $routes->get('perawat/medical-records', '\Modules\Perawat\Controllers\Perawat::listMedicalRecords');
    $routes->post('perawat/medical-records', '\Modules\Perawat\Controllers\Perawat::createMedicalRecord');
    $routes->get('perawat/medical-records/(:num)', '\Modules\Perawat\Controllers\Perawat::getMedicalRecord/$1');
    $routes->put('perawat/medical-records/(:num)', '\Modules\Perawat\Controllers\Perawat::updateMedicalRecord/$1');
    $routes->get('perawat/lokets', '\Modules\Perawat\Controllers\Perawat::listLokets');

    // Settings API (Dashboard)
    $routes->get('settings', '\Modules\Dashboard\Controllers\Dashboard::getSettings');
    $routes->post('settings', '\Modules\Dashboard\Controllers\Dashboard::saveSettings');

    // Dashboard Stats API
    $routes->get('dashboard/stats', '\Modules\Dashboard\Controllers\Dashboard::getDashboardStats');
    $routes->get('dashboard/logs', '\Modules\Dashboard\Controllers\Dashboard::apiLogs');

    // Lokets API (Resepsionis)
    $routes->get('lokets', '\Modules\Resepsionis\Controllers\Resepsionis::listLokets');
    $routes->post('lokets', '\Modules\Resepsionis\Controllers\Resepsionis::createLoket');
    $routes->put('lokets/(:num)', '\Modules\Resepsionis\Controllers\Resepsionis::updateLoket/$1');
    $routes->delete('lokets/(:num)', '\Modules\Resepsionis\Controllers\Resepsionis::deleteLoket/$1');

    // Suppliers API (Apoteker)
    $routes->get('suppliers', '\Modules\Apoteker\Controllers\Apoteker::listSuppliers');
    $routes->get('suppliers/(:num)', '\Modules\Apoteker\Controllers\Apoteker::getSupplier/$1');
    $routes->post('suppliers', '\Modules\Apoteker\Controllers\Apoteker::createSupplier');
    $routes->put('suppliers/(:num)', '\Modules\Apoteker\Controllers\Apoteker::updateSupplier/$1');
    $routes->delete('suppliers/(:num)', '\Modules\Apoteker\Controllers\Apoteker::deleteSupplier/$1');

    // Stock Transactions API (Apoteker)
    $routes->get('stock-transactions', '\Modules\Apoteker\Controllers\Apoteker::listStockTransactions');
    $routes->post('stock-transactions', '\Modules\Apoteker\Controllers\Apoteker::createStockTransaction');

});

$routes->get('general', '\Modules\General\Controllers\General::General');
$routes->get('service', '\Modules\General\Controllers\General::Service');
$routes->get('about', '\Modules\General\Controllers\General::About');
$routes->get('contact', '\Modules\General\Controllers\General::Contact');

// --- API PUBLIK UNTUK SUBMIT DARI HALAMAN CONTACT ---
$routes->post('pasien/janji-temu/submit', '\Modules\Pasien\Controllers\Pasien::submitJanjiTemu');
$routes->post('pasien/kirim-pesan/submit', '\Modules\Pasien\Controllers\Pasien::submitPesan');