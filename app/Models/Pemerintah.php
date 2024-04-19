<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pemerintah extends Model
{
    use HasFactory;
    protected $guard = 'pemerintah';
    protected $table = 'pemerintahs';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    public $fillable = [
        'nama_pengguna',
        'kata_sandi'
    ];
    protected $guarded = ['id'];
    protected $hidden = [
     'kata_sandi',
    ];
    public function getAuthIdentifierName()
    {
        return $this->id;
    }
    public function getAuthIdentifier()
    {
        return $this->nama_pengguna;
    }
    public function getAuthPassword()
    {
     return $this->kata_sandi;
    }
    public function faqs(): HasMany
    {
        return $this->hasMany(Faq::class, 'id_pemerintah', 'id');
    }
    public function notifikasis(): HasMany
    {
        return $this->hasMany(Notifikasi::class, 'id_pemerintah', 'id');
    }
    public function keluhans(): HasMany
    {
        return $this->hasMany(Keluhan::class, 'id_pemerintah', 'id');
    }
}
