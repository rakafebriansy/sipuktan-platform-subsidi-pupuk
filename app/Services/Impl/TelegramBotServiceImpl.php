<?php

namespace App\Services\Impl;
use App\Services\TelegramBotService;

class TelegramBotServiceImpl implements TelegramBotService
{
    public function setWelcome(array $request): string
    {
        return view('bot.index',[
            'first_name' => $request['message']['from']['first_name']
        ])->render();
    }
    public function test(array $request): string
    {
        return 'test';
    }
}