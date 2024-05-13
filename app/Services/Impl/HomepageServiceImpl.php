<?php

namespace App\Services\Impl;
use App\Models\Alokasi;
use App\Models\KelompokTani;
use App\Models\KiosResmi;
use App\Models\Petani;
use App\Services\HomepageService;

class HomepageServiceImpl implements HomepageService
{
    public function homepageCountPetani(): string
    {
        $count = Petani::count();
        return number_format($count,0,',','.');
    }
    public function homepageCountKiosResmi(): string
    {
        $count = KiosResmi::count();
        return number_format($count,0,',','.');
    }
    public function homepageCountKelompokTani(): string
    {
        $count = KelompokTani::count();
        return number_format($count,0,',','.');
    }
    public function homepageSumPupuk(): string
    {
        $count = Alokasi::sum('jumlah_pupuk');
        return number_format($count,0,',','.');
    }
}
