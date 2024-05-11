<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\TelegramBotService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Telegram\Bot\Api;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramBotController extends Controller
{
    private TelegramBotService $telegram_bot_service;
    protected $telegram;

    /**
     * Create a new controller instance.
     *
     * @param  Api  $telegram
     */
    public function __construct(Api $telegram, TelegramBotService $telegram_bot_service)
    {
        $this->telegram = $telegram;
        $this->telegram_bot_service = $telegram_bot_service;
    }

    /**
     * Show the bot information.
     */
    private function sendMessageHTML(string $id, string $rendered)
    {
        $this->telegram->sendMessage([
            'chat_id' => $id,
            'text' => $rendered,
            'parse_mode' => 'html',
        ]);
    }
    private function setPromptService(string $prompt) {
        switch ($prompt) {
            case 'test':
                return 'test';
            default:
                return 'setWelcome';
        }
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
        Log::channel('bot')->info(json_encode($request->all(),JSON_PRETTY_PRINT));

        $user_id = $request['message']['from']['id'];
        $text = $request['message']['text'];
        $service_method = $this->setPromptService($text);
        $response_text = $this->telegram_bot_service->$service_method($request->all());
        $this->sendMessageHTML($user_id,$response_text);
    }
    public function setWebhook(): bool
    {
        $responses = $this->telegram->setWebhook(['url'=> env('APP_URL') . '/bot/webhook/' . env('TELEGRAM_BOT_TOKEN')]);
        return $responses;
    }
}
