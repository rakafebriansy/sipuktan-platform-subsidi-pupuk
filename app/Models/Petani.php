<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;

class Petani extends Model implements Authenticatable
{
    use HasFactory;
    protected $table = 'petanis';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = false;
    public $fillable = [
        'nik',
        'nama',
        'kata_sandi',
        'foto_ktp',
        'nomor_telepon',
        'id_kelompok_tani',
        'ingat_saya',
        'token'
    ];
    protected $guarded = ['id'];
    protected $hidden = [
     'kata_sandi', 'remember_token',
    ];
    public function kelompok_tani(): BelongsTo
    {
        return $this->belongsTo(KelompokTani::class,'id_kelompok_tani','id');
    }
    public function alokasis(): HasMany
    {
        return $this->hasMany(Alokasi::class,'id_petani','id');
    }
    public function keluhans(): HasMany
    {
        return $this->hasMany(Keluhan::class,'id_petani','id');
    }
    public function notifikasis(): HasMany
    {
        return $this->hasMany(Notifikasi::class,'id_petani','id');
    }
    public function riwayat_transaksis(): HasManyThrough
    {
        return $this->hasManyThrough(RiwayatTransaksi::class, Alokasi::class,
        'id_petani',
        'id_alokasi',
        'id',
        'id'
    );
    }
    public function getAuthIdentifierName()
    {
        return 'nik';
    }
    public function getAuthIdentifier()
    {
        return $this->nik;
    }
    public function getAuthPassword()
    {
        return $this->kata_sandi;
    }
    public function getRememberToken()
    {
        return $this->ingat_saya;
    }
    public function setRememberToken($value)
    {
        $this->ingat_saya = $value;
    }
    public function getRememberTokenName()
    {
        return 'ingat_saya';
    }
}
