<?php

namespace App\Services;

interface HomepageService
{
    function homepageCountPetani(): string;
    function homepageCountKiosResmi(): string;
    function homepageCountKelompokTani(): string;
    function homepageSumPupuk(): string;
}