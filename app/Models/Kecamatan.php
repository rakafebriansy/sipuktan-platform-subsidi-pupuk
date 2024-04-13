<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kecamatan extends Model
{
    use HasFactory;
    protected $table = 'kecamatans';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    public $fillable = [
        'id',
        'nama'
    ];
    public function kelompok_tanis(): HasMany
    {
        return $this->hasMany(KelompokTani::class,'id_kecamatan','id');
    }
    public function kios_resmis(): HasMany
    {
        return $this->hasMany(KiosResmi::class,'id_kecamatan','id');
    }
}
