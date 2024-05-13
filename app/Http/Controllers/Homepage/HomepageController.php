<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Services\FaqService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomepageController extends Controller
{
    private FaqService $faq_service;
    public function __construct(FaqService $faq_service) {
        $this->faq_service = $faq_service;
    }
    public function index(): View
    {
        $faqs_kios_resmi = $this->faq_service->getFaqKiosResmi();
        $faqs_petani = $this->faq_service->getFaqPetani();
        return view('homepage.pages.index', [
            'title' => 'SIPUKTAN',
            'faqs_petani' => $faqs_petani,
            'faqs_kios_resmi' => $faqs_kios_resmi
        ]);
    }
}
