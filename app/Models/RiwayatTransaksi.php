<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class RiwayatTransaksi extends Model
{
    use HasFactory;
    protected $table = 'riwayat_transaksis';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = false;
    public $fillable = [
        'tanggal_transaksi',
        'metode_pembayaran',
        'status_pembayaran',
        'id_alokasi',
    ];
    public function alokasi(): BelongsTo
    {
        return $this->belongsTo(Alokasi::class, 'id_alokasi');
    }
    public function laporan():HasOne
    {
        return $this->hasOne(Laporan::class, 'id_riwayat_tansaksi','id');
    }
}
