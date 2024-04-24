<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MusimTanam extends Model
{
    use HasFactory;
    protected $guard = 'musim_tanam';
    protected $table = 'musim_tanams';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = false;
    public $fillable = [
        'musim_tanam',
        'tahun'
    ];
}
