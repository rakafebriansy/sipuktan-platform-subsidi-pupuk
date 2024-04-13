<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Petani extends Model
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
        'id_kelompok_tani'
    ];
    public function kelompok_tani(): BelongsTo
    {
        return $this->belongsTo(KelompokTani::class,'id_kelompok_tani','id');
    }
    public function alokasi(): HasOne
    {
        return $this->hasOne(Alokasi::class,'id_petani','id');
    }
    public function keluhans(): HasMany
    {
        return $this->hasMany(Keluhan::class,'id_petani','id');
    }
    public function notifikasis(): HasMany
    {
        return $this->hasMany(Notifikasi::class,'id_petani','id');
    }
    
}
