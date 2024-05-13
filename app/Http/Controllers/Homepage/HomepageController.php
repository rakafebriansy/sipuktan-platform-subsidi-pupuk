<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Services\FaqService;
use App\Services\HomepageService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomepageController extends Controller
{
    private HomepageService $homepage_service;
    private FaqService $faq_service;
    public function __construct(FaqService $faq_service, HomepageService $homepage_service) {
        $this->faq_service = $faq_service;
        $this->homepage_service = $homepage_service;
    }
    public function index(): View
    {
        $faqs_kios_resmi = $this->faq_service->getFaqKiosResmi();
        $faqs_petani = $this->faq_service->getFaqPetani();
        $count_petani = $this->homepage_service->homepageCountPetani();
        $count_kios_resmi = $this->homepage_service->homepageCountKiosResmi();
        $count_poktan = $this->homepage_service->homepageCountKelompokTani();
        $sum_pupuk = $this->homepage_service->homepageSumPupuk();
        return view('homepage.pages.index', [
            'title' => 'SIPUKTAN',
            'faqs_petani' => $faqs_petani,
            'faqs_kios_resmi' => $faqs_kios_resmi,
            'count_info' => [
                'petani' => $count_petani,
                'kios_resmi' => $count_kios_resmi,
                'poktan' => $count_poktan,
                'pupuk' => $sum_pupuk,
            ]
        ]);
    }
}
