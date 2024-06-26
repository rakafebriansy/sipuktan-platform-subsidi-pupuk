<?php

namespace App\Http\Controllers\Dashboard\Pemerintah;

use App\Http\Controllers\Controller;
use App\Http\Requests\PemerintahBuatFaqRequest;
use App\Http\Requests\PemerintahEditFaqRequest;
use App\Services\DashboardService;
use App\Services\FaqService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class FaqController extends Controller
{
    private DashboardService $dashboard_service;
    private FaqService $faq_service;
    public function __construct(DashboardService $dashboard_service, FaqService $faq_service) {
        $this->dashboard_service = $dashboard_service;
        $this->faq_service = $faq_service;
    }
    public function setFaq(): View
    {
        $id = Auth::guard('pemerintah')->user()->id;
        ['pemerintah' => $pemerintah,
        'notifikasis' => $notifikasis,
        'initials' =>$initials] = $this->dashboard_service->pemerintahSetSidebar($id); 
        $faqs = $this->faq_service->pemerintahSetFaq($id);
        return view('dashboard.pemerintah.pages.faq', [
            'title' => 'Pemerintah | FAQ',
            'notifikasis' => $notifikasis,
            'pemerintah' => $pemerintah,
            'initials' => $initials,
            'faqs' => $faqs
        ]);
    }
    public function buatFaq(PemerintahBuatFaqRequest $request): RedirectResponse
    {
        $id = Auth::guard('pemerintah')->user()->id;
        $validated = $request->validated();
        if($this->faq_service->pemerintahBuatFaq($validated, $id)) {
            return back()->with('success', 'FAQ baru berhasil ditambahkan');
        }
        return back()->withInput()->withErrors(['error' => 'FAQ baru gagal ditambahkan']);
    }
    public function editFaq(PemerintahEditFaqRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        if($this->faq_service->pemerintahEditFaq($validated)) {
            return back()->with('success','FAQ berhasil diperbarui');
        }
        return back()->withInput()->withErrors(['error' => 'FAQ gagal diperbarui']);
    }
    public function hapusFaq(Request $request): RedirectResponse
    {
        if($this->faq_service->pemerintahHapusFaq($request->id)) {
            return back()->with('success','FAQ berhasil dihapus');
        }
        return back()->withInput()->withErrors(['error' =>'FAQ gagal dihapus']);
    }
}
