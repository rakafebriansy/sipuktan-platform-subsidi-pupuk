<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bank extends Model
{
    use HasFactory;
    protected $table = 'banks';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    public $fillable = [
        'id',
        'nama'
    ];
    public function riwayat_transaksis(): HasMany
    {
        return $this->hasMany(RiwayatTransaksi::class,'id_bank','id');
    }
}
