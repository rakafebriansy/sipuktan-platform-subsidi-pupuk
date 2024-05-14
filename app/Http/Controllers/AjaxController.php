<?php

namespace App\Http\Controllers;

use App\Services\AlokasiService;
use App\Services\FaqService;
use App\Services\KeluhanService;
use App\Services\LaporanService;
use App\Services\NotifikasiService;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    private AlokasiService $alokasi_service;
    private LaporanService $laporan_service;
    private NotifikasiService $notifikasi_service;
    private FaqService $faq_service;
    private KeluhanService $keluhan_service;
    public function __construct(AlokasiService $alokasi_service, LaporanService $laporan_service, NotifikasiService $notifikasi_service, FaqService $faq_service, KeluhanService $keluhan_service) {
        $this->alokasi_service = $alokasi_service;
        $this->laporan_service = $laporan_service;
        $this->notifikasi_service = $notifikasi_service;
        $this->faq_service = $faq_service;
        $this->keluhan_service = $keluhan_service;
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
    public function getPetaniFromAlokasi(Request $request)
    {
        if(isset($request->id)) {
            $detail_petani = $this->alokasi_service->ajaxDetailAlokasiPetani($request->id);
            return $detail_petani;
        }
        return '';
    }
    public function getPetaniFromAlokasiPemerintah(Request $request)
    {
        if(isset($request->id)) {
            $detail_petani = $this->alokasi_service->ajaxDetailAlokasiPetaniByPemerintah($request->id);
            return $detail_petani;
        }
        return '';
    }
    public function deleteNotifikasi(Request $request)
    {
        if(isset($request->id)) {
            $result = $this->notifikasi_service->ajaxDeleteNotifikasi($request->id);
            return json_encode(['status'=>$result]);
        }
        return '';
    }
    public function getFaqDetail(Request $request)
    {
        if(isset($request->id)) {
            $result = $this->faq_service->ajaxGetFaqDetail($request->id);
            return $result;
        }
        return '';
    }
    public function getKeluhanDetail(Request $request)
    {
        if(isset($request->id)) {
            $result = $this->keluhan_service->ajaxGetKeluhanDetail($request->id);
            return $result;
        }
        return '';
    }
    public function getLaporanBlade(Request $request)
    {
        if(isset($request->id)) {
            $result = $this->laporan_service->ajaxGetLaporanBlade($request->id);
            return $result;
        }
        return '';
    }
}
