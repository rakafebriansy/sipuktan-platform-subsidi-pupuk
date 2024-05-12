<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\AkunService;
use App\Services\TelegramBotService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Telegram\Bot\Api;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramBotController extends Controller
{
    private TelegramBotService $telegram_bot_service;
    private AkunService $akun_service;
    protected $telegram;

    /**
     * Create a new controller instance.
     *
     * @param  Api  $telegram
     */
    public function __construct(Api $telegram, TelegramBotService $telegram_bot_service, AkunService $akun_service)
    {
        $this->telegram = $telegram;
        $this->telegram_bot_service = $telegram_bot_service;
        $this->akun_service = $akun_service;
    }

    /**
     * Show the bot information.
     */
    private function sendMessageHTML(array $final_request)
    {
        $chat = [
            'chat_id' => $final_request['pengirim'],
            'text' => $final_request['teks'],
            'parse_mode' => 'html',
        ];
        if(isset($final_request['reply_markup'])) {
            $chat['reply_markup'] = json_encode($final_request['reply_markup']);
        }
        $this->telegram->sendMessage($chat);
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

        if(isset($request['message']['text'])) {
            $final_request = $this->telegram_bot_service->service($request);
        } else if (isset($request['message']['reply_to_message']['text'])) {
            $final_request = $this->telegram_bot_service->replyService($request);
        }
        $this->sendMessageHTML($final_request);
    }
    public function setWebhook(): RedirectResponse
    {
        $responses = $this->telegram->setWebhook(['url'=> env('APP_URL') . '/bot/webhook/' . env('TELEGRAM_BOT_TOKEN')]);
        if($responses) {
            return redirect('/');
        }
        return redirect('/')->withErrors(['error' => 'Something went wrong with our webhook']);
    }
}
