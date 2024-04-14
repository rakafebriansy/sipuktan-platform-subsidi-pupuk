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
    public function petaniRregister(array $request): void
    {
        $request['kata_sandi'] = Hash::make($request['kata_sandi']);
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