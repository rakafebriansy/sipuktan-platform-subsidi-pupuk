<?php

namespace App\Http\Controllers;

use App\Services\AlokasiService;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    // private AlokasiService $alokasi_service;
    // public function __construct(AlokasiService $alokasi_service) {
    //     $this->alokasi_service = $alokasi_service;
    // }
    // public function pemerintahGetAlokasiByTahun(Request $request)
    // {
    //     if($request->ajax()){
    //         $tahun = $request->tahun;
    //         $musim_tanam = $request->musim_tanam;
    //         $alokasis = $this->alokasi_service->ajaxPemerintahGetAlokasiByTahun($tahun,$musim_tanam);
    
    //         return response(json_encode($alokasis),200);
    //     }
    // }
}
