<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Session;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EmailController;
// use App\Http\Controllers\AhliEventController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PenggunaController;
// use App\Http\Controllers\AhliMesyuaratController;
use App\Http\Controllers\AhliLoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\FullCalendarController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\NotisMesyuaratController;
use App\Http\Controllers\LaporanKeahlianController;
use App\Http\Controllers\PanggilanMesyuaratController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
|--------------------------------------------------------------------------
*/

/*--------------------------------------------------------------------------
Routes used for : Laman Utama and login page
Model used      : user
Controller used : user
//* To change the homepage of the login image, go to RouteServiceProvider --> HOME
/*------------------------------- Routes Begin ----------------------------*/

//ahli mesyuarat login
// In routes/web.php
//Route::get('/m_QRCode/{event_id}', [AttendanceController::class, 'attendanceForm'])->name('attendance.form');
//Route::get('/login/ahli/{event_id?}', [AhliLoginController::class, 'showLoginForm'])->name('ahli.login.form');
//Route::post('/login/ahli', [AhliLoginController::class, 'login'])->name('ahli.login');

// Route::get('/m_QRCode/{event_id}', [AttendanceController::class, 'attendanceForm'])->name('attendance.form');
// Route::get('/login/ahli/{event_id?}', [AhliLoginController::class, 'showLoginForm'])->name('ahli.login.form');
// Route::post('/login/ahli', [AhliLoginController::class, 'submit'])->name('ahli.login.submit')->middleware('throttle:60,1');
// Route::get('/default', function () {
//     return view('default');
// })->name('default.route');

// use App\Http\Controllers\QRCodeController;

// // Updated route for login functionality
// Route::get('/login/ahli/{event_id?}', [AhliLoginController::class, 'showLoginForm'])->name('ahli.login.form');

// Route::get('/m_QRCode/{id_ahli}/{id}', [QRCodeController::class, 'indexPengesahanQRCode'])->name('pengesahanQR');


// // Keep other routes as they are
// Route::get('/m_QRCode/{event_id}', [AttendanceController::class, 'attendanceForm'])->name('attendance.form');
// Route::post('/login/ahli', [AhliLoginController::class, 'submit'])->name('ahli.login.submit')->middleware('throttle:60,1');
// Route::get('/default', function () {
//     return view('default');
// })->name('default.route');


// //ahli mesyuarat logout
// Route::get('/logout/ahli', function () {
//     Session::flush();
//     return redirect()->route('ahli.login.form');
// })->name('ahli.logout');

// Route::get('/test', function () {
//     return view('test');
// });

use App\Http\Controllers\QRCodeController;


// Updated route for login functionality
Route::get('/login/{id_ahli}/{id?}', [AhliLoginController::class, 'showLoginForm'])->name('ahli.login.form');
// Route to handle login submission with rate limiting
Route::post('/login/ahli', [AhliLoginController::class, 'submit'])->name('ahli.login.submit')->middleware('throttle:600,1');

// Route for QR Code verification
Route::get('/m_QRCode/{id_ahli}/{id}', [QRCodeController::class, 'indexPengesahanQRCode'])
->name('pengesahanQR')
->middleware('verify.qrcode');

Route::get('/m_QRCode/{id_ahli}/{id}', [QRCodeController::class, 'showQRCode'])->name('pengesahanQR')->middleware('verify.qrcode');


// Route for attendance form
Route::get('/m_QRCode/{id_ahli}/{id}', [AttendanceController::class, 'attendanceForm'])->name('attendance.form');




// Default route for testing
Route::get('/default', function () {
    return view('default');
})->name('default.route');

// Route for ahli mesyuarat logout
Route::get('/logout/ahli', function () {
    Session::flush();
    return redirect()->route('ahli.login.form');
})->name('ahli.logout');

// Route for testing purposes
Route::get('/test', function () {
    return view('test');
});



//laman utama login
Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

// default auth command for home
Route::get('/home', [HomeController::class, 'index'])->name('home');

/*------------------------------- Routes End ----------------------------*/


/*--------------------------------------------------------------------------
Routes used for : Pengguna Sistem
Model used      : User, ref_unit, ref_peranan_pengguna, user_role_pengguna, ref_tajuk_mesyuarat, user_tajuk_mesyuarat, Log_Aktiviti
Controller used : PenggunaController
/*------------------------------- Routes Begin ----------------------------*/

Route::get('/pengguna', [PenggunaController::class, 'index'])->name('senarai.pengguna');
Route::get('p_Pengguna/{id}', [App\Http\Controllers\PenggunaController::class, 'show'])->name('p_paparPengguna.show');
Route::get('p_Pengguna/{id}/edit', [App\Http\Controllers\PenggunaController::class, 'edit'])->name('p_editPengguna.edit');
Route::patch('p_Pengguna/{id}/edit', [App\Http\Controllers\PenggunaController::class, 'update'])->name('p_editPengguna.update');
Route::delete('p_Pengguna/{id}',  [App\Http\Controllers\PenggunaController::class, 'softDelete'])->name('p_padamPengguna.softDelete');

//reset password pengguna (admin)
Route::get('p_Pengguna_admin_reset_password/{id}', [App\Http\Controllers\PenggunaController::class, 'edit_password_pengguna_admin'])->name('edit-password-pengguna-admin');
Route::post('p_Pengguna_admin_reset_password/{id}', [App\Http\Controllers\PenggunaController::class, 'update_password_pengguna_admin'])->name('update-password-pengguna-admin');

// reset password pengguna (pengguna)
Route::get('p_Pengguna_reset_password_pengguna/{id}', [App\Http\Controllers\PenggunaController::class, 'edit_password_pengguna'])->name('edit-password-pengguna');
Route::post('p_Pengguna_reset_password_pengguna/{id}',  [App\Http\Controllers\PenggunaController::class, 'update_password_pengguna'])->name('update-password-pengguna');

// Route::get ('p_Pengguna/{document_type}', [App\Http\Controllers\PenggunaController::class, 'print'])->name('p_CetakMaklumatPengguna.print');
/*------------------------------- Routes End ----------------------------*/


/*--------------------------------------------------------------------------
Routes used for : Selenggara Mesyuarat/Kalendar
Model used      : Event, AhliEvent
Controller used : FullCalendarController, EventController, AhliEventController
/*------------------------------- Routes Begin ----------------------------*/

Route::get('/mesyuarat/fullcalendar', [App\Http\Controllers\FullCalendarController::class, 'index'])->name('m_tambah');
Route::get('m_SelenggaraKalendar/{id}', [App\Http\Controllers\FullCalendarController::class, 'show'])->name('m_SelenggaraKalendar');

// Padam Mesyuarat di table event dan ahli_event
Route::delete('padam_aktiviti/{id}', [App\Http\Controllers\FullCalendarController::class, 'destroy'])->name('padam_aktiviti');

// Route to fetch all events
Route::get('/events', [EventController::class, 'index'])->name('allEvent');

// Route to store or update an event
Route::post('/events/store', [EventController::class, 'store'])->name('eventStore');
Route::put('/events/update', [EventController::class, 'update'])->name('eventUpdate');

// Route to delete an event
Route::delete('/events/delete', [EventController::class, 'destroy'])->name('eventDelete');

// Show Ahli Mesyuarat beserta catat kehadiran
Route::get('m_UbahKehadiran/{id}', [App\Http\Controllers\AhliEventController::class, 'update_ubah_kehadiran'])->name('kemaskini_kehadiran');
Route::post('m_UbahKehadiran/{id}', [App\Http\Controllers\AhliEventController::class, 'kemaskini_ubah_kehadiran'])->name('kemaskini_kehadiran');

// Pengesahan Kehadiran Ahli Mesyuarat
Route::get('m_PengesahanKehadiran/{id}', [App\Http\Controllers\AhliEventController::class, 'papar_pengesahan_kehadiran'])->name('m_PengesahanKehadiranAhli');
Route::post('m_PengesahanKehadiran/{id}', [App\Http\Controllers\AhliEventController::class, 'store_pengesahan_kehadiran'])->name('m_PengesahanKehadiranAhli');

// Cetakan Kehadiran Ahli Mesyuarat - Hadir/Tidak Hadir
Route::get('/mesyuarat1/{document_type}/{id}', [App\Http\Controllers\AhliEventController::class, 'cetakhadir'])->name('mesyuarat1');
Route::get('/mesyuarat/{document_type}/{id}', [App\Http\Controllers\AhliEventController::class, 'cetaktidakhadir'])->name('mesyuarat');
/*------------------------------- Routes End ----------------------------*/


/*--------------------------------------------------------------------------
Routes used for : Selenggara Ahli Mesyuarat
Model used      : AhliMesyuarat, ButiranAhliMesyuarat, Event, kekananan_gred, KodGelaran, LantikanAhliMesyuarat, PegawaiKhas, Pemandu_Bguard,
                  ref_jawatan, ref_kementerian, ref_status_ahli, ref_status_jawatan, SetiausahaPejabat
Controller used : AhliMesyuaratController
/*------------------------------- Routes Begin ----------------------------*/

// paparan senarai ahli
Route::get('p_AhliMesyuarat', [App\Http\Controllers\AhliMesyuaratController::class, 'index'])->name('p_carianAhliMesyuarat');

// paparan maklumat ahli mesyuarat
Route::get('p_Show/{id}', [App\Http\Controllers\AhliMesyuaratController::class, 'show'])->name('papar_ahli');

// tambah ahli mesyuarat
Route::get('Tambah', [App\Http\Controllers\AhliMesyuaratController::class, 'createAhliMesyuarat'])->name('TambahAhli');
Route::post('DaftarAhliMesyuarat', [App\Http\Controllers\AhliMesyuaratController::class, 'storeAhliMesyuarat'])->name('DaftarAhli');
Route::post('TambahMaklumatAhliMesyuarat', [App\Http\Controllers\AhliMesyuaratController::class, 'storeMaklumatAhli'])->name('TambahMaklumat');

// kemaskini maklumat ahli mesyuarat
Route::get('p_Edit2/{id}', [App\Http\Controllers\AhliMesyuaratController::class, 'edit'])->name('kemaskini');
Route::post('kemaskiniAhli/{id}', [App\Http\Controllers\AhliMesyuaratController::class, 'updateButiranAhli'])->name('kemaskini_ButiranAhli');
Route::post('kemaskiniLantikan/{id}', [App\Http\Controllers\AhliMesyuaratController::class, 'updateLantikanPersaraan'])->name('kemaskini_LantikanPersaraan');
Route::post('kemaskiniPemanduBguard/{id}', [App\Http\Controllers\AhliMesyuaratController::class, 'updatePemanduBguard'])->name('kemaskini_PemanduBguard');
Route::post('tambahPegawaiKhas/{id}', [App\Http\Controllers\AhliMesyuaratController::class, 'storePegawaiKhas'])->name('tambah_PegawaiKhas');
Route::post('tambahSetiausahaPejabat/{id}', [App\Http\Controllers\AhliMesyuaratController::class, 'storeSetiausahaPejabat'])->name('tambah_Supej');

// Padam Ahli Mesyuarat, Pegawai Khas & Setiausaha Pejabat
Route::delete('padam_pengguna/{id}', [App\Http\Controllers\AhliMesyuaratController::class, 'softDelete'])->name('padam_pengguna');
Route::delete('padam_pegkhas/{id_pegkhas}', [App\Http\Controllers\AhliMesyuaratController::class, 'destroyPegkhas'])->name('padam_pegkhas');
Route::delete('padam_supej/{id_supej}', [App\Http\Controllers\AhliMesyuaratController::class, 'destroySupej'])->name('padam_supej');

// Cetak Senarai & Maklumat Ahli Mesyuarat
Route::get('p_CetakSenaraiAhli', [App\Http\Controllers\AhliMesyuaratController::class, 'cetak'])->name('p_CetakSenaraiAhli');
Route::get('p_CetakMaklumatAhli/{id}', [App\Http\Controllers\AhliMesyuaratController::class, 'cetakMaklumatAhli'])->name('p_CetakMaklumatAhli');

// Semak senarai ahli
Route::get('p_SemakSenaraiAhli', [App\Http\Controllers\AhliMesyuaratController::class, 'semak'])->name('p_SemakSenaraiAhli');
Route::post('/update-kekananan', [App\Http\Controllers\AhliMesyuaratController::class, 'updateKekananan'])->name('updateKekananan');

/*------------------------------- Routes End ----------------------------*/


/*--------------------------------------------------------------------------
Routes used for : Panggilan Mesyuarat
Model used      : Event, AhliEvent
Controller used : PanggilanMesyuaratController, EmailController
/*------------------------------- Routes Begin ----------------------------*/

// Emel Panggilan Mesyuarat
Route::get('/panggilan', [App\Http\Controllers\PanggilanMesyuaratController::class, 'indexPanggilan'])->name('m_PanggilanMesyuarat');

Route::get('/ahlimesyuarat/ksukp/{id}', [App\Http\Controllers\PanggilanMesyuaratController::class, 'showSenaraiKSUKP'])->name('ahli.ksukp');
Route::get('/ahlimesyuarat/mbkm/{id}', [App\Http\Controllers\PanggilanMesyuaratController::class, 'showSenaraiMBKM'])->name('ahli.mbkm');
Route::post('/tambah/ahli/{id}', [App\Http\Controllers\PanggilanMesyuaratController::class, 'tambahAhli'])->name('tambah.ahli');
Route::delete('/padam/ahli/{id}', [App\Http\Controllers\PanggilanMesyuaratController::class, 'deleteAhli'])->name('padam.ahli');

Route::get('/panggilan/ksukp/{id}', [App\Http\Controllers\PanggilanMesyuaratController::class, 'showPanggilanKSUKP'])->name('panggilan.ksukp');
Route::get('/panggilan/mbkm/{id}', [App\Http\Controllers\PanggilanMesyuaratController::class, 'showPanggilanMBKM'])->name('panggilan.mbkm');
Route::get('/emel/panggilan/ksukp/{id}/{id_ahli}', [App\Http\Controllers\PanggilanMesyuaratController::class, 'emelPanggilanKSUKP'])->name('emel.ksukp');
Route::get('/emel/panggilan/mbkm/{id}/{id_ahli}', [App\Http\Controllers\PanggilanMesyuaratController::class, 'emelPanggilanMBKM'])->name('emel.mbkm');

Route::post('/emel/ksukp', [App\Http\Controllers\EmailController::class, 'emailPanggilanKSUKP'])->name('emel.panggilan.ksukp');
Route::post('/emel/mbkm', [App\Http\Controllers\EmailController::class, 'emailPanggilanMBKM'])->name('emel.panggilan.mbkm');

/*------------------------------- Routes End ----------------------------*/


/*--------------------------------------------------------------------------
Routes used for : Senarai Mesyuarat & Aktiviti
Model used      : ref_tajuk_mesyuarat, AhliMesyuarat, ref_kementerian
Controller used : MesyuaratController
/*------------------------------- Routes Begin ----------------------------*/

// Papar Senarai Mesyuarat & Aktiviti
Route::get('p_Mesyuarat', [App\Http\Controllers\MesyuaratController::class, 'index'])->name('p_pengurusanMesyuarat');

// Papar Senarai Ahli Berdasarkan Jenis Mesyuarat
Route::get('p_SenaraiAhli/{id}', [App\Http\Controllers\MesyuaratController::class, 'create'])->name('p_SenaraiAhli');

// Cetak Ahli Mesyuarat Berdasarkan Jenis Mesyuarat
Route::get('p_CetakanAhliMesyuarat/{id}', [App\Http\Controllers\MesyuaratController::class, 'CetakMesyuaratAhli'])->name('CetakMesyuaratAhli');

/*------------------------------- Routes End ----------------------------*/


/*--------------------------------------------------------------------------
Routes used for : Templat Dokumen
Model used      :
Controller used : NotisMesyuaratController, PindaanTarikhController, EdaranDokumenController, EdaranMinitController, AgendaMesyuaratController & PanggilanMesyuaratController.
/*------------------------------- Routes Begin ----------------------------*/

Route::get('m_NotisMesyuarat', [App\Http\Controllers\NotisMesyuaratController::class, 'indexNotis'])->name('m_NotisMesyuarat');
Route::get('m_CetakanNotisMesyuarat/ksukp/{id}', [App\Http\Controllers\NotisMesyuaratController::class, 'cetakannotismesyuarat_ksukp'])->name('m_CetakanNotisMesyuarat_ksukp');
Route::get('m_CetakanNotisMesyuarat/mbkm/{id}', [App\Http\Controllers\NotisMesyuaratController::class, 'cetakannotismesyuarat_mbkm'])->name('m_CetakanNotisMesyuarat_mbkm');
Route::get('m_PindaanTarikh', [App\Http\Controllers\PindaanTarikhController::class, 'indexPindaan'])->name('m_PindaanTarikh');
Route::get('m_CetakanPindaanTarikhMesyuarat/ksukp/{id}', [App\Http\Controllers\PindaanTarikhController::class, 'cetakanpindaantarikhmesyuarat_ksukp'])->name('m_CetakanPindaanTarikhMesyuarat_ksukp');
Route::get('m_CetakanPindaanTarikhMesyuarat/mbkm/{id}', [App\Http\Controllers\PindaanTarikhController::class, 'cetakanpindaantarikhmesyuarat_mbkm'])->name('m_CetakanPindaanTarikhMesyuarat_mbkm');
Route::get('m_EdaranDokumen', [App\Http\Controllers\EdaranDokumenController::class, 'indexEdaran'])->name('m_EdaranDokumen');
Route::get('m_CetakanEdaranDokumen/ksukp/{id}', [App\Http\Controllers\EdaranDokumenController::class, 'cetakanEdaran_ksukp'])->name('m_CetakanEdaranDokumen_ksukp');
Route::get('m_CetakanEdaranDokumen/mbkm/{id}', [App\Http\Controllers\EdaranDokumenController::class, 'cetakanEdaran_mbkm'])->name('m_CetakanEdaranDokumen_mbkm');
Route::get('m_EdaranMinit', [App\Http\Controllers\EdaranMinitController::class, 'indexMinit'])->name('m_EdaranMinit');
Route::get('m_CetakanEdaranMinit/ksukp/{id}', [App\Http\Controllers\EdaranMinitController::class, 'cetakanMinit_ksukp'])->name('m_CetakanEdaranMinit_ksukp');
Route::get('m_CetakanEdaranMinit/mbkm/{id}', [App\Http\Controllers\EdaranMinitController::class, 'cetakanMinit_mbkm'])->name('m_CetakanEdaranMinit_mbkm');
Route::get('m_AgendaMesyuarat', [App\Http\Controllers\AgendaMesyuaratController::class, 'indexAgenda'])->name('m_AgendaMesyuarat');
Route::get('m_CetakanAgendaMesyuarat/ksukp/{id}', [App\Http\Controllers\AgendaMesyuaratController::class, 'cetakanagendamesyuarat_ksukp'])->name('m_CetakanAgendaMesyuarat_ksukp');
Route::get('m_CetakanAgendaMesyuarat/mbkm/{id}', [App\Http\Controllers\AgendaMesyuaratController::class, 'cetakanagendamesyuarat_mbkm'])->name('m_CetakanAgendaMesyuarat_mbkm');

// Cetakan Pilihan Dokumen
Route::get('p_CetakanPilihan', [App\Http\Controllers\CetakanPilihanController::class, 'index'])->name('p_CetakanPilihan');
Route::post('p_LaporanPilihan', [App\Http\Controllers\CetakanPilihanController::class, 'cetakanlaporan'])->name('cetakanlaporan');
// Route::post('/cetakandokumen/cetak/', 'CetakanDokumenController@cetakanlaporan')->name('cetakanlaporan');

// Cetakan Kawalan Dokumen
Route::get('p_KawalanDokumen', [App\Http\Controllers\KawalanDokumenController::class, 'index'])->name('p_KawalanDokumen');
Route::get('p_CetakanKawalanDokumen', [App\Http\Controllers\KawalanDokumenController::class, 'cetakkawalandokumen'])->name('p_CetakanKawalanDokumen');
// Route::get('penyelenggaraan/{document_type}/{id}', [App\Http\Controllers\KawalanDokumenController::class, 'cetakkawalandokumen'])->name('penyelenggaraanKD');

// Cetakan Kawalan Dokumen
Route::get('penyelenggaraan/p_QRCode', [App\Http\Controllers\KawalanDokumenController::class, 'indexQRCode'])->name('kawalanDokumen');

// Cetakan Sticker Alamat
Route::get('p_StickerAlamat', [App\Http\Controllers\StickerAlamatController::class, 'index'])->name('p_StickerAlamat');
Route::get('/cetak_sticker_alamat/{id}', [App\Http\Controllers\StickerAlamatController::class, 'cetakstickeralamat'])->name('cetak_sticker');

/*------------------------------- Routes End ----------------------------*/


/*--------------------------------------------------------------------------
Routes used for : Pengesahan Kehadiran Mesyuarat
Model used      : Event
Controller used : MesyuaratPengesahanController, EmailController, QRCodeController
/*------------------------------- Routes Begin ----------------------------*/

Route::get('m_PaparMesyuarat', [App\Http\Controllers\MesyuaratPengesahanController::class, 'index'])->name('m_pengesahan');
Route::get('m_QRPaparMesyuarat', [App\Http\Controllers\MesyuaratPengesahanController::class, 'indexQRPapar'])->name('m_QRPapar');
Route::delete('padam_mesyuarat/{id}', [App\Http\Controllers\MesyuaratPengesahanController::class, 'deleteEvent'])->name('padam_mesyuarat');

Route::get('m_Wakil/{id}', [App\Http\Controllers\MesyuaratPengesahanController::class, 'show'])->name('papar_wakil');
Route::get('m_Email_ksukp/{id}/{id_ahli}', [App\Http\Controllers\MesyuaratPengesahanController::class, 'blast_email_ksukp'])->name('blast_email_ksukp');
Route::get('m_Email_mbkm/{id}/{id_ahli}', [App\Http\Controllers\MesyuaratPengesahanController::class, 'blast_email_mbkm'])->name('blast_email_mbkm');
Route::post('m_Email_ksukp', [App\Http\Controllers\EmailController::class, 'emailKSUKP'])->name('emailKSUKP');
Route::post('m_Email_mbkm', [App\Http\Controllers\EmailController::class, 'emailMBKM'])->name('emailMBKM');

Route::get('m_QRCode/{id_ahli}/{id}', [App\Http\Controllers\QRCodeController::class, 'indexPengesahanQRCode'])->name('pengesahanQR');
Route::post('m_QRCode/{id_ahli}/{id}', [App\Http\Controllers\QRCodeController::class, 'simpanKehadiranQR'])->name('pra_kehadiran');
Route::view('m_QRCodeBerjaya/{id_ahli}/{id}', 'mesyuarat.m_QRCodeBerjaya')->name('m_QRCodeBerjaya');

Route::get('m_CetakQRCode/{id}', [App\Http\Controllers\MesyuaratPengesahanController::class, 'indexQRCode'])->name('CetakQR');
Route::get('m_SemakanKehadiranQR/{id}', [App\Http\Controllers\MesyuaratPengesahanController::class, 'semakKehadiranQR'])->name('SemakKehadiranQR');
Route::get('/get-ahli-event/{eventTitle}', [App\Http\Controllers\MesyuaratPengesahanController::class, 'getAhiEvent']);

/*------------------------------- Routes End ----------------------------*/


/*--------------------------------------------------------------------------
Routes used for : Penyelenggaraan- Jawatan
Model used      : Ref Jawatan
Controller used : JawatanController
/*------------------------------- Routes Begin ----------------------------*/

Route::get('p_Jawatan', [App\Http\Controllers\JawatanController::class, 'index'])->name('p_pengurusanJawatan');

// Cetakan Senarai Jawatan
Route::get('p_CetakanJawatan', [App\Http\Controllers\JawatanController::class, 'cetakanjawatan'])->name('p_CetakanJawatan');

// Tambah Jawatan
Route::get('p_TambahJawatan', [App\Http\Controllers\JawatanController::class, 'create'])->name('p_TambahJawatan');
Route::post('p_TambahJawatan', [App\Http\Controllers\JawatanController::class, 'store'])->name('tambah-jawatan');

// Ubahsuai Jawatan
Route::get('p_EditJawatan/{id}', [App\Http\Controllers\JawatanController::class, 'edit'])->name('ubahsuai_jawatan');
Route::post('p_EditJawatan/{id}', [App\Http\Controllers\JawatanController::class, 'update'])->name('kemaskini_jawatan');

// Padam Jawatan
Route::delete('padam_jawatan/{id}', [App\Http\Controllers\JawatanController::class, 'delete'])->name('padam_jawatan');

/*------------------------------- Routes End ----------------------------*/


/*--------------------------------------------------------------------------
Routes used for : Penyelenggaraan- Kementerian
Model used      : ref_kementerian
Controller used : KementerianController
/*------------------------------- Routes Begin ----------------------------*/

Route::get('p_Kementerian', [App\Http\Controllers\KementerianController::class, 'index'])->name('p_pengurusanKementerian');

// Cetakan Senarai Kementerian
Route::get('p_CetakanKementerian', [App\Http\Controllers\KementerianController::class, 'cetakankementerian'])->name('p_CetakanKementerian');

// Tambah Kementerian
Route::get('p_TambahKementerian', [App\Http\Controllers\KementerianController::class, 'create'])->name('p_TambahKementerian');
Route::post('p_TambahKementerian', [App\Http\Controllers\KementerianController::class, 'store'])->name('tambah-kementerian');

// Ubahsuai Kementerian
Route::get('p_EditKementerian/{id}', [App\Http\Controllers\KementerianController::class, 'edit'])->name('ubahsuai_kementerian');
Route::post('p_EditKementerian/{id}', [App\Http\Controllers\KementerianController::class, 'update'])->name('kemaskini_kementerian');

// padam_kementerian- Padam
Route::delete('padam_kementerian/{id}', [App\Http\Controllers\KementerianController::class, 'delete'])->name('padam_kementerian');

/*------------------------------- Routes End ----------------------------*/


/*--------------------------------------------------------------------------
Routes used for : Pentadbiran
Model used      :
Controller used : PentadbiranController
/*------------------------------- Routes Begin ----------------------------*/

// Ahli Jemaah Menteri
Route::get('pen_AhliJemaahMenteri', [App\Http\Controllers\PentadbiranController::class, 'index'])->name('pen_Menteri');

// Padam Ahli Jemaah Menteri
Route::delete('padam_AhliJemaahMenteri/{id}', [App\Http\Controllers\PentadbiranController::class, 'delete'])->name('padam_AhliJemaahMenteri');

// Papar Maklumat Ahli Jemaah Menteri
Route::get('pen_ShowJemaah/{id}', [App\Http\Controllers\PentadbiranController::class, 'show'])->name('papar_jemaah');


Route::get('pen_TimMenteri', [App\Http\Controllers\PentadbiranController::class, 'indexTim'])->name('pen_TimMenteri');
Route::get('pen_MBKM', [App\Http\Controllers\PentadbiranController::class, 'indexMBKM'])->name('pen_MBKM');
Route::get('pen_SUPOL', [App\Http\Controllers\PentadbiranController::class, 'indexSUPOL'])->name('pen_SUPOL');
Route::get('pen_DR', [App\Http\Controllers\PentadbiranController::class, 'indexDR'])->name('pen_DR');
Route::get('pen_DN', [App\Http\Controllers\PentadbiranController::class, 'indexDN'])->name('pen_DN');
Route::get('pen_DNLantikan', [App\Http\Controllers\PentadbiranController::class, 'indexDNLantikan'])->name('pen_DNLantikan');
Route::get('pen_DNLantikanNegeri', [App\Http\Controllers\PentadbiranController::class, 'indexDNLantikanNegeri'])->name('pen_DNLantikanNegeri');

/*------------------------------- Routes End ----------------------------*/


/*--------------------------------------------------------------------------
Routes used for : Laporan
Model used      : Event, AhliEvent, AhliMesyuarat, ref_tajuk_mesyuarat, ref_kementerian
Controller used : LaporanController, LaporanKekanananController & LaporanKeahlianController
/*------------------------------- Routes Begin ----------------------------*/

// Susun Atur Kedudukan
Route::get('lap_Susunan', [App\Http\Controllers\LaporanController::class, 'indexSusunan'])->name('lap_Susunan');
Route::get('ubah_kedudukan/KSUKP/{id}', [App\Http\Controllers\LaporanController::class, 'editKedudukanKSUKP'])->name('ubah-kedudukan-KSUKP');
Route::get('ubah_kedudukan/MBKM/{id}', [App\Http\Controllers\LaporanController::class, 'editKedudukanMBKM'])->name('ubah-kedudukan-MBKM');
Route::post('update_kedudukan/KSUKP/{id}', [App\Http\Controllers\LaporanController::class, 'updateKedudukanKSUKP'])->name('update-kedudukan-KSUKP');
Route::post('update_Kedudukan/MBKM/{id}', [App\Http\Controllers\LaporanController::class, 'updateKedudukanMBKM'])->name('update-kedudukan-MBKM');

Route::get('/kedudukan/KSUKP/{id}', [App\Http\Controllers\LaporanController::class, 'showKedudukanKSUKP'])->name('papar-kedudukan-KSUKP');
Route::get('/kedudukan/MBKM/{id}', [App\Http\Controllers\LaporanController::class, 'showKedudukanMBKM'])->name('papar-kedudukan-MBKM');

// Route::post('/cetaksusunanKSUKP/{id}', [App\Http\Controllers\LaporanController::class, 'cetakSusunanKSUKP'])->name('cetak-kedudukan-KSUKP');

// Statistik Kehadiran
Route::get('lap_Statistik', [App\Http\Controllers\LaporanController::class, 'indexStatistik'])->name('lap_Statistik');

// laporan log aktiviti
Route::get('log_aktiviti',  [App\Http\Controllers\LaporanController::class, 'log_aktiviti'])->name('log-aktiviti');

// laporan log login
Route::get('log_user',  [App\Http\Controllers\LaporanController::class, 'log_login'])->name('log-login');

// Keahlian
Route::get('lap_Keahlian', [App\Http\Controllers\LaporanKeahlianController::class, 'indexKeahlian'])->name('lap_Keahlian');
// Route::get('/lap_Keahlian/{id}', 'LaporanKeahlianController@select_tajuk')->name('select_tajuk');

Route::get('getAhli', [App\Http\Controllers\LaporanKeahlianController::class, 'getAhli'])->name('getAhli');
Route::get('getAhli/{id_ahli}', [App\Http\Controllers\LaporanKeahlianController::class, 'getAhli']);
Route::get('getJawatan/{id_ahli}', [App\Http\Controllers\LaporanKeahlianController::class, 'getJawatan']);
Route::get('getKementerian/{id_ahli}', [App\Http\Controllers\LaporanKeahlianController::class, 'getKementerian']);

// Route::post('p_LaporanKeahlian', [App\Http\Controllers\LaporanKeahlianController::class, 'cetakanlaporankeahlian'])->name('cetakanlaporankeahlian');
// Route::post('/cetakandokumen/cetakkeahlian/', 'CetakanDokumenKeahlianController@cetakanlaporankeahlian')->name('cetakanlaporankeahlian');

// Route::post('p_LaporanPilihan', [App\Http\Controllers\CetakanPilihanController::class, 'cetakanlaporan'])->name('cetakanlaporan');
// Route::post('/cetakandokumen/cetak/', 'CetakanDokumenController@cetakanlaporan')->name('cetakanlaporan');

/*------------------------------- Routes End ----------------------------*/


/*--------------------------------------------------------------------------
Routes used for : Manual Pengguna
Model used      :
Controller used : PDFViewController
/*------------------------------- Routes Begin ----------------------------*/

// PDF Manual Pengguna - manual_Prime2.pdf
Route::get('manual_Prime2.pdf', [App\Http\Controllers\PDFViewController::class, 'manual_Prime2.pdf'])->name('manual_Prime2.pdf');

/*------------------------------- Routes End ----------------------------*/


/*--------------------------------------------------------------------------
Routes used for : Logout
Model used      : -
Controller used : AuthController
/*------------------------------- Routes Begin ----------------------------*/

// Redirect kepada logout
Route::get('logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

/*------------------------------- Routes End ----------------------------*/
