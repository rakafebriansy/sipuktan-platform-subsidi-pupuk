<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KelompokTani extends Model
{
    use HasFactory;
    protected $table = 'kelompok_tanis';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = false;
    public $fillable = [
        'nama',
        'id_kios_resmi',
        'id_kecamatan'
    ];
    public function petanis(): HasMany
    {
        return $this->hasMany(Petani::class, 'id_kelompok_tani', 'id');
    }
    public function kecamatan(): BelongsTo
    {
        return $this->belongsTo(Kecamatan::class, 'id_kecamatan', 'id');
    }
    public function kios_resmi(): BelongsTo
    {
        return $this->belongsTo(KiosResmi::class, 'id_kios_resmi', 'id');
    }
}
