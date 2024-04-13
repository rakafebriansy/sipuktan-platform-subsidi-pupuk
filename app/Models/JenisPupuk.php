<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JenisPupuk extends Model
{
    use HasFactory;
    protected $table = 'jenis_pupuks';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    public $fillable = [
        'id',
        'jenis',
        'harga'
    ];
    public function alokasis(): HasMany
    {
        return $this->hasMany(Alokasi::class,'id_jenis_pupuk','id');
    }
}
