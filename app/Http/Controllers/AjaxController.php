<?php

namespace App\Http\Controllers;

use App\Services\AlokasiService;
use App\Services\LaporanService;
use App\Services\NotifikasiService;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    private AlokasiService $alokasi_service;
    private LaporanService $laporan_service;
    private NotifikasiService $notifikasi_service;
    public function __construct(AlokasiService $alokasi_service, LaporanService $laporan_service, NotifikasiService $notifikasi_service) {
        $this->alokasi_service = $alokasi_service;
        $this->laporan_service = $laporan_service;
        $this->notifikasi_service = $notifikasi_service;
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
            return json_encode($detail_petani);
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
}
