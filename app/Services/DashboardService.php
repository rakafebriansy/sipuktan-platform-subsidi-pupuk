<?php

namespace App\Services;

interface DashboardService
{
    function petaniSetSidebar(int $id): array;
    function kiosResmiSetSidebar(int $id): array;
    function pemerintahSetSidebar(int $id): array;
    function setPieChart(): array;
}