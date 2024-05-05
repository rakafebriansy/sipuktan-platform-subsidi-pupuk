<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Alokasi extends Model
{
    use HasFactory;
    protected $table = 'alokasis';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = false;
    public $fillable = [
        'jumlah_pupuk',
        'musim_tanam',
        'tahun',
        'id_jenis_pupuk',
        'id_kios_resmi',
        'id_petani'
    ];
    public function petani(): BelongsTo
    {
        return $this->belongsTo(Petani::class, 'id_petani', 'id');
    }
    public function kios_resmi(): BelongsTo
    {
        return $this->belongsTo(KiosResmi::class, 'id_kios_resmi', 'id');
    }
    public function jenis_pupuk(): BelongsTo
    {
        return $this->belongsTo(JenisPupuk::class, 'id_jenis_pupuk', 'id');
    }
    public function riwayat_transaksi(): HasOne
    {
        return $this->hasOne(RiwayatTransaksi::class, 'id_riwayat_transaksi', 'id');
    }
    public function laporan(): HasOneThrough
    {
        return $this->hasOneThrough(Laporan::class, RiwayatTransaksi::class,
        'id_alokasi', 
        'id_riwayat_transaksi', 
        'id', 
        'id'
    );
    }
}
