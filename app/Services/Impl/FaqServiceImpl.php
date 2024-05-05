<?php

namespace App\Services\Impl;

use App\Models\Faq;
use App\Services\FaqService;
use Illuminate\Database\Eloquent\Collection;

class FaqServiceImpl implements FaqService
{
    public function getFaqKiosResmi(): Collection
    {
        $faqs = Faq::where('pengguna','Kios Resmi')->get(['id','pertanyaan','jawaban']);
        return $faqs;
    }
    public function getFaqPetani(): Collection
    {
        $faqs = Faq::where('pengguna','Petani')->get(['id','pertanyaan','jawaban']);
        return $faqs;
    }
}

?>