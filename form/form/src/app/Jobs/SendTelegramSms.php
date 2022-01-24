<?php

namespace App\Jobs;

use App\Service;

class SendTelegramSms extends Job {

    private $_id;
    private string $_body;
    private string $_service;

    public function __construct($id, string $body, string $service) {
        $this->_id = $id;
        $this->_body = $body;
        $this->_service = $service;
    }

    public function handle() {
        try {
            app()->make(Service\TelegramSms::class)->send($this->_id, $this->_body);
        } catch (\Throwable $t) {
            app()['log']->critical('Sending sms failed', ['exception_class' => get_class($t), 'message' => $t->getMessage(), 'trace' => Service\Utils::cutTrace($t)]);
        }
    }
}