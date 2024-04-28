<?php

namespace App\Http\Controllers;

use App\Services\LaporanService;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    private LaporanService $laporan_service;
    public function __construct(LaporanService $laporan_service) {
        $this->laporan_service = $laporan_service;
    }
    public function getPetaniFromRiwayat(Request $request)
    {
        if(isset($request->letters)) {
            $petanis = $this->laporan_service->ajaxGetPetaniFromRiwayat($request->letters);
            return json_encode($petanis);
        }
        return '';
    }
    public function getLaporanFilenames(Request $request)
    {
        if(isset($request->id)) {
            $filenames = $this->laporan_service->ajaxGetLaporanFilenames($request->id);
            return $filenames;
        }
        return '';
    }
}
