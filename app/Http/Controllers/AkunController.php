<?php

namespace App\Http\Controllers;

use App\Http\Requests\PetaniRegisterRequest;
use App\Services\AkunService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AkunController extends Controller
{
    private AkunService $akun_service;
    public function __construct(AkunService $akun_service)
    {
        $this->akun_service = $akun_service;
    }
    public function petaniRegister(): Response
    {
        return response()->view('homepage.petani.register',[
            'title' => 'Petani | Register'
        ]);
    }
    public function petaniPostRegister(PetaniRegisterRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        try {
            $this->akun_service->register($validated);
            return redirect('/petani/login')->with('success','Akun berhasil terdaftar!');
        } catch (\Exception $e) {
            return redirect('/petani/register')->withErrors('dbErr','Akun gagal dibuat!');
        }
    }
}
