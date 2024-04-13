<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KiosResmi extends Model
{
    use HasFactory;
    protected $table = 'kios_resmis';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = false;
    public $fillable = [
        'nama_pemilik',
        'nik',
        'kata_sandi',
        'nomor_telepon',
        'id_kecamatan'
    ];
    public function pemilik_kios(): BelongsTo
    {
        return $this->belongsTo(PemilikKios::class,'id_pemilik_kios','id');
    }
    public function kecamatan(): BelongsTo
    {
        return $this->belongsTo(Kecamatan::class,'id_kecamatan','id');
    }
    public function alokasis(): HasMany
    {
        return $this->hasMany(Alokasi::class, 'id_kios_resmi','id');
    }
    public function keluhans(): HasMany
    {
        return $this->hasMany(Keluhan::class, 'id_kios_resmi','id');
    }
    public function notifikasis(): HasMany
    {
        return $this->hasMany(Notifikasi::class, 'id_kios_resmi','id');
    }
    public function kelompok_tanis(): HasMany
    {
        return $this->hasMany(KelompokTani::class, 'id_kios_resmi','id');
    }
}
