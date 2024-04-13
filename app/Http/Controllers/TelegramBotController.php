<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
    public function show()
    {
        $response = $this->telegram->getMe();

        return $response;
    }
    public function getMessages()
    {
        $responses = $this->telegram->getUpdates();
        return $responses;
    }
    public function sendMessage()
    {
        $response = $this->telegram->sendMessage([
            'chat_id' => '1980788561',
            'text' => 'Sudah ngoding frontendnya?'
        ]);
        
        $messageId = $response->getMessageId();
        dd($messageId);
    }
}
