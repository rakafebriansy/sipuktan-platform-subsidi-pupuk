<?php

namespace App\Services;
use App\Http\Requests\PetaniRegisterRequest;
use Illuminate\Http\UploadedFile;

interface DashboardService
{
    function petaniSetDashboard(int $id): array;
    function kiosResmiSetDashboard(int $id): array;
}