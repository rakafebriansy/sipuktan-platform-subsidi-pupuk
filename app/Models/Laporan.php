<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Laporan extends Model
{
    use HasFactory;
    protected $table = 'laporans';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = false;
    public $fillable = [
        'tanggal_pengambilan',
        'foto_bukti_pengambilan',
        'foto_ktp',
        'foto_surat_kuasa',
        'foto_tanda_tangan',
        'status_verifikasi',
        'id_riwayat_transaksi',
        'telah_diedit',
        'tanggal_diedit',
        'catatan'
    ];
    public function riwayat_transaksi(): BelongsTo
    {
        return $this->belongsTo(RiwayatTransaksi::class, 'id_riwayat_transaksi', 'id');
    }
}
