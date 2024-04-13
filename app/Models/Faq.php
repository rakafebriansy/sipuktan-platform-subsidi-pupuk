<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Faq extends Model
{
    use HasFactory;
    protected $table = 'faqs';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = false;
    public $fillable = [
        'pertanyaan',
        'jawaban',
        'id_kategori',
        'id_pemerintah'
    ];
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class,'id_kategori','id');
    }
    public function pemerintah(): BelongsTo
    {
        return $this->belongsTo(Pemerintah::class,'id_pemerintah','id');
    }
}
