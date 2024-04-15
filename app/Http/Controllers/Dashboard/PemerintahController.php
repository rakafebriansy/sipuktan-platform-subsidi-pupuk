<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\PetaniRegisterRequest;
use App\Models\Alokasi;
use App\Models\Pemerintah;
use App\Models\Petani;
use App\Services\AkunService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class PemerintahController extends Controller
{
    private AkunService $akun_service;
    public function __construct(AkunService $akun_service)
    {
        $this->akun_service = $akun_service;
    }
    public function setDashboard()
    {
        $id = Session::get('id',null);
        $pemerintah = Pemerintah::find($id); 
        return view('dashboard.pemerintah.pages.index', [
            'title' => 'Pemerintah | Dashboard',
            'pemerintah' => $pemerintah
        ]);
    }
    public function setAlokasi()
    {
        $id = Session::get('id',null);
        $pemerintah = Pemerintah::find($id); 
        // $alokasis = Alokasi::query()->w
        return view('dashboard.pemerintah.pages.alokasi', [
            'title' => 'Pemerintah | Dashboard',
            'pemerintah' => $pemerintah
        ]);
    }
}
