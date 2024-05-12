<?php

namespace App\Services;
use Illuminate\Http\Request;

interface TelegramBotService
{
    function service(Request $request): array;
    function replyService(Request $request): array;
}