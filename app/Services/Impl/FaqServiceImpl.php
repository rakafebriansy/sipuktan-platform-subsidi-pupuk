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
        return DB::transaction(function() use ($validated) {
            return Faq::insert($validated);
        });
    }
    public function pemerintahEditFaq(array $data): bool
    {
        return DB::transaction(function() use($data) {
            return Faq::where('id',$data['id'])->update([
                'pertanyaan' => $data['pertanyaan'],
                'jawaban' => $data['jawaban'],
                'jenis_pengguna' => $data['jenis_pengguna'],
            ]);
        });
    }
    public function pemerintahHapusFaq(int $id): bool
    {
        return DB::transaction(function () use ($id) {
            return Faq::where('id',$id)->delete();
        });
    }
    public function ajaxGetFaqDetail(int $id): string
    {
        $faq = Faq::where('id',$id)->first()->toJson(JSON_PRETTY_PRINT);
        return $faq;
    }

}

?>