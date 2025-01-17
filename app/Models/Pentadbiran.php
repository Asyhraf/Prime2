<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pentadbiran extends Model
{
    use HasFactory;

    protected $table = 'pentadbiran';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'nama',
        'nama_kad_pengenalan',
        'nombor_kad_pengenalan',
        'kod_gelaran',
        'senator',
        'kod_gelaran_darjah',
        'gelaran_professional',
        'kod_agama',
        'kod_jantina',
        'kod_status_perkahwinan',
        'tarikh_lahir',
        'nama_pasangan',
        'bintang',
        'bintang_luar',
        'kod_kelulusan_akademik',
        'butiran_kelulusan_akademik',
        'alamat_1',
        'alamat_2',
        'alamat_poskod',
        'alamat_bandar',
        'kod_negeri_alamat',
        'telefon_rumah',
        'telefon_pejabat',
        'telefon_bimbit',
        'telefon_faks',
        'telefon_pegawai',
        'emel',
        'adr_status',	
        'kod_parlimen',	
        'dun_status',	
        'kod_dun',	
        'adn_status',	
        'adn1_tarikh_mula',	
        'adn1_tarikh_tamat',
        'adn2_tarikh_mula',	
        'adn2_tarikh_tamat',	
        'kod_jenis_lantikan_senator',
        'adn_kekananan',
        'kod_jawatan',
        'jawatan_penuh',
        'jawatan_kekananan',
        'kod_kementerian',	
        'kod_kementerian2',	 
        'tarikh_lantikan',   
        'kod_parti',	
        'kod_parti_komponen',
        'kod_parti_jawatan',
        'kekananan_dalam_parti',
        'gambar',	
        'catatan',
        'users_id',
        'tarikh_cipta',	
        'tarikh_kemaskini',	
        'tarikh_hapus'
    ];

    public function kodgelaran()
    {
        return $this->hasOne('App\Models\KodGelaran','id','kod_gelaran');
    }

    public function kodparlimen()
    {
        return $this->hasOne('App\Models\KodParlimen','id','kod_parlimen'); 
    }

    public function kodnegeri()
    {
        return $this->hasOne('App\Models\KodNegeri','id','kod_negeri_alamat');
    }

    public function koddun()
    {
        return $this->hasOne('App\Models\KodDun','id','kod_dun');
    }

    public function kodjenislantikansenator()
    {
        return $this->hasOne('App\Models\KodJenisLantikanSenator','id','kod_jenis_lantikan_senator');
    }

    public function kodpartikomponen()
    {
        return $this->hasOne('App\Models\KodPartiKomponen','id','kod_parti_komponen');
    }

    public function kodgelarandarjah()
    {
        return $this->hasOne('App\Models\KodGelaranDarjah','id','kod_gelaran_darjah');
    }

    public function akaunpengguna()
    {
        return $this->hasOne('App\Models\User','id','id');
    }

    public function kodagama()
    {
        return $this->hasOne('App\Models\KodAgama','id','kod_agama');
    }

    public function kodjantina()
    {
        return $this->hasOne('App\Models\KodJantina','id','kod_jantina');
    }

    public function kodstatusperkahwinan()
    {
        return $this->hasOne('App\Models\KodStatusPerkahwinan','id','kod_status_perkahwinan');
    }

    public function kodkelulusanakademik()
    {
        return $this->hasOne('App\Models\KodKelulusanAkademik','id','kod_kelulusan_akademik');
    }

    public function kodparti(){
        return $this->hasOne('App\Models\KodParti','id','kod_parti');
    }

    public function kodpartijawatan()
    {
        return $this->hasOne('App\Models\KodPartiJawatan','id','kod_parti_jawatan');
    }

    public function kodjawatan()
    {
        return $this->hasOne('App\Models\KodJawatan','id','kod_jawatan');
    }

    public function kodkementerian()
    {
        return $this->hasOne('App\Models\KodKementerian','id','kod_kementerian');
    }

    public function kodkementerian2()
    {
        return $this->hasOne('App\Models\KodKementerian','id','kod_kementerian2');
    }
}
