<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PemilikKios extends Model
{
    use HasFactory;
    protected $table = 'pemilik_kios';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = false;
    public $fillable = [
        'nama_pemilik',
        'nik',
        'foto_ktp',
        'nomor_telepon',
    ];

    public function kios_resmi(): HasOne
    {
        return $this->hasOne(KiosResmi::class,'id_pemilik_kios','id');
    }
}
