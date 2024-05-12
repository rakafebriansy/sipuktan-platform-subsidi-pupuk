<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class KiosResmi extends Model implements Authenticatable
{
    use HasFactory;
    protected $table = 'kios_resmis';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = false;
    public $fillable = [
        'nib',
        'nama',
        'jalan',
        'kata_sandi',
        'id_pemilik_kios',
        'id_kecamatan',
        'ingat_saya',
        'token'
    ];

    protected $guarded = ['id'];
    protected $hidden = [
     'kata_sandi', 'remember_token',
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
    public function petanis(): HasManyThrough
    {
        return $this->hasManyThrough(Petani::class, KelompokTani::class,
        'id_kios_resmi', 
        'id_kelompok_tani', 
        'id', 
        'id'
    );
    }
    public function getAuthIdentifierName()
    {
        return 'nib';
    }
    public function getAuthIdentifier()
    {
        return $this->nib;
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
