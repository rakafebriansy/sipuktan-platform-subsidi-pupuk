<?php

namespace App\Services\Impl;

use App\Models\Faq;
use App\Services\FaqService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class FaqServiceImpl implements FaqService
{
    public function getFaqKiosResmi(): Collection
    {
        $faqs = Faq::where('jenis_pengguna','Kios Resmi')->get(['id','pertanyaan','jawaban']);
        return $faqs;
    }
    public function getFaqPetani(): Collection
    {
        $faqs = Faq::where('jenis_pengguna','Petani')->get(['id','pertanyaan','jawaban']);
        return $faqs;
    }
    public function pemerintahSetFaq(int $id): Collection
    {
        $faqs = Faq::where('id_pemerintah',$id)->orderBy('jenis_pengguna')->get();
        return $faqs;
    }
    public function pemerintahBuatFaq(array $validated, int $id): bool
    {
        $validated['id_pemerintah'] = $id;
        DB::transaction(function() use ($validated) {
            Faq::insert($validated);
        });
        return true;
    }
}

?>