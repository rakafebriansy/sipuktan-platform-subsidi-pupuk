<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Model;

class KiosResmi extends Model
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
    ];

    protected $guarded = ['id'];
    protected $hidden = [
     'kata_sandi', 'remember_token',
    ];
    public function getAuthIdentifierName()
    {
        return $this->id;
    }
    public function getAuthIdentifier()
    {
        return $this->nib;
    }
    public function getAuthPassword()
    {
     return $this->kata_sandi;
    }
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
}
