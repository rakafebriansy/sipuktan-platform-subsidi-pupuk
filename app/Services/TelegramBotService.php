<?php

namespace App\Services;

interface TelegramBotService
{
    function setWelcome(array $request): string;
    function test(array $request): string;
}