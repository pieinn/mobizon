<?php

namespace Laraketai\Mobizon\Exceptions;

use Exception;
use DomainException;

class CouldNotSendNotification extends Exception
{
    /**
     * Thrown when recipient's phone number is missing.
     *
     * @return static
     */
    public static function missingRecipient()
    {
        return new static('Notification was not sent. Phone number is missing.');
    }
    /**
     * Thrown when content length is greater than 800 characters.
     *
     * @return static
     */
    public static function contentLengthLimitExceeded()
    {
        return new static(
            'Notification was not sent. Content length may not be greater than 800 characters.'
        );
    }
    /**
     * Thrown when we're unable to communicate with mobizon.kz.
     *
     * @param $code
     * @param $message
     * @param $data
     * @return static
     */
    public static function mobizonRespondedWithAnError($code, $message, $data)
    {
        return new static(
            "mobizon.kz responded with an error code: $code message: $message"
        );
    }
    /**
     * Thrown when we're unable to communicate with mobizon.kz.
     *
     * @param  Exception  $exception
     *
     * @return static
     */
    public static function couldNotCommunicateWithMobizon(Exception $exception)
    {
        return new static("The communication with mobizon.kz failed. Reason: {$exception->getMessage()}");
    }
}

