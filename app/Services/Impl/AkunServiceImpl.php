<?php

namespace App\Services\Impl;

use App\Models\KelompokTani;
use App\Models\KiosResmi;
use App\Models\Petani;
use App\Services\AkunService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AkunServiceImpl implements AkunService
{
    public function petaniRegister(array $request, ): void
    {
        $request['kata_sandi'] = Hash::make($request['kata_sandi']);
        dd($request['foto_ktp']);
        // $foto_ktp->storePubliclyAs('foto_ktps', $picture->getClientOriginalName(), 'public');
        // $request['foto_ktp'] = $foto_ktp->getClientOriginalName(); 
        DB::transaction(function () use ($request) {
            Petani::create($request);
        });
    }
    public function kiosResmiRegister(array $request): void
    {
        $request['kata_sandi'] = Hash::make($request['kata_sandi']);
        DB::transaction(function () use ($request) {
            KiosResmi::create($request);
        }); 
    }

}