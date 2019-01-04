<?php

namespace Laraketai\Mobizon;

use Illuminate\Notifications\Notification;
use Laraketai\Mobizon\Exceptions\CouldNotSendNotification;

class MobizonChannel
{
    /**
     * @var MobizonApi $mobizonApi
     */
    protected $mobizonApi;
    protected $config;
    /**
     * MobizonChanel constructor.
     *
     * @param MobizonApi $mobizonApi
     */
    public function __construct(MobizonApi $mobizonApi)
    {
        $this->mobizonApi = $mobizonApi;
        $this->config = config('mobizon');
    }
    /**
     * Send the given notification.
     *
     * @param $notifiable
     * @param Notification $notification
     * @throws CouldNotSendNotification
     * @throws \Laraketai\Mobizon\Mobizon_Http_Error
     * @throws \Laraketai\Mobizon\Mobizon_Param_Required
     */
    public function send($notifiable, Notification $notification)
    {
        $to = $notifiable->routeNotificationFor('mobizon');
        if (empty($to)) {
            throw CouldNotSendNotification::missingRecipient();
        }
        $message = $notification->toMobizon($notifiable);
        if (is_string($message)) {
            $message = new MobizonMessage($message);
        }
        $message->alphaname($this->config['alphaname']);
        $this->sendMessage($to, $message);
    }
    /**
     * @param $recipient
     * @param MobizonMessage $message
     * @throws CouldNotSendNotification
     * @throws \Laraketai\Mobizon\Mobizon_Http_Error
     * @throws \Laraketai\Mobizon\Mobizon_Param_Required
     */
    protected function sendMessage($recipient, MobizonMessage $message)
    {
        if (mb_strlen($message->content) > 800) {
            throw CouldNotSendNotification::contentLengthLimitExceeded();
        }
        $params = [
            'recipient' => $recipient,
            'text' => $message->content,
            //'from' => $message->alphaname, //Optional
        ];
        if(!$this->mobizonApi->call('message', 'sendSMSMessage', $params)){
            throw CouldNotSendNotification::mobizonRespondedWithAnError($this->mobizonApi->getCode(),$this->mobizonApi->getMessage(),$this->mobizonApi->getData());
        }
    }
}
