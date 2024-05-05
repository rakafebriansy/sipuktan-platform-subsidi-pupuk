<?php

namespace App\Http\Controllers\Dashboard\Pemerintah;

use App\Http\Controllers\Controller;
use App\Services\DashboardService;
use App\Services\FaqService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FaqController extends Controller
{
    private DashboardService $dashboard_service;
    private FaqService $faq_service;
    public function __construct(DashboardService $dashboard_service, FaqService $faq_service) {
        $this->dashboard_service = $dashboard_service;
        $this->faq_service = $faq_service;
    }
    public function setFaq()
    {
        $id = Session::get('id_pemerintah',null);
        ['pemerintah' => $pemerintah,
        'initials' =>$initials] = $this->dashboard_service->pemerintahSetSidebar($id); 
        $faqs = $this->faq_service->pemerintahSetFaq($id);
        return view('dashboard.pemerintah.pages.faq', [
            'title' => 'Pemerintah | Dashboard',
            'pemerintah' => $pemerintah,
            'initials' => $initials,
            'faqs' => $faqs
        ]);
    }
}
