<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Telegram\Bot\Api;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramBotController extends Controller
{
    protected $telegram;

    /**
     * Create a new controller instance.
     *
     * @param  Api  $telegram
     */
    public function __construct(Api $telegram)
    {
        $this->telegram = $telegram;
    }

    /**
     * Show the bot information.
     */
    private function sendMessage(string $id, string $text)
    {
        $this->telegram->sendMessage([
            'chat_id' => $id,
            'text' => $text
        ]);
    }
    public function getBotInformation()
    {
        $response = $this->telegram->getMe();

        return $response;
    }
    public function getMessagesByPolling()
    {
        $responses = $this->telegram->getUpdates();
        return $responses;
    }
    public function getMessagesByWebhook(string $token, Request $request): void
    {
        $user_id = $request['message']['from']['id'];
        $text = 'anjg kau';
        Log::channel('bot')->info(json_encode($request->all(),JSON_PRETTY_PRINT));
        $this->sendMessage($user_id,$text);
    }
    public function setWebhook(): bool
    {
        $responses = $this->telegram->setWebhook(['url'=> env('APP_URL') . '/bot/webhook/' . env('TELEGRAM_BOT_TOKEN')]);
        return $responses;
    }
}
