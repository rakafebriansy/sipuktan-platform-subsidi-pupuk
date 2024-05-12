<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KredensialUbahSandi extends Model
{
    protected $table = 'kredensial_ubah_sandis';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = false;
    public $timestamps = false;
    public $fillable = [
        'token',
        'id_petani',
        'id_pemilik_kios',
    ];
    public function pemilik_kios(): BelongsTo
    {
        return $this->belongsTo(PemilikKios::class,'id_pemilik_kios','id');
    }
    public function petani(): BelongsTo
    {
        return $this->belongsTo(Petani::class,'id_petani','id');
    }
}
