<?php

namespace App\Service;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;


class TelegramSms {

    /** @var array */
    private $_config;
    private $_bot;

    public function __construct() {
        $this->_config = config('Sms');
        $this->_bot = new \TelegramBot\Api\BotApi(env('TELEGRAM_BOT_TOKEN'));
    }

    public function send($id, string $body, ?string $trackingId = null) {
        $this->_send($id, $body, $trackingId);
    }

    private function _send($id, string $body, ?string $trackingId) {
        app()['log']->channel('stderr')->info("Sending SMS via Telegram", ["body" => $body]);
        $this->_bot->sendMessage($id, $body);
    }
}
