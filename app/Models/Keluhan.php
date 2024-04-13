<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Keluhan extends Model
{
    use HasFactory;
    protected $table = 'keluhans';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = false;
    public $fillable = [
        'keluhan',
        'balasan',
        'tanggal_keluhan',
        'id_petani',
        'id_kios_resmi',
        'id_pemerintah'
    ];
    public function petanis(): BelongsTo
    {
        return $this->belongsTo(Petani::class, 'id_petani','id');
    }
    public function kios_resmis(): BelongsTo
    {
        return $this->belongsTo(KiosResmi::class, 'id_kios_resmi','id');
    }
    public function pemerintahs(): BelongsTo
    {
        return $this->belongsTo(Pemerintah::class, 'id_pemerintah','id');
    }
}
