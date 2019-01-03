<?php

namespace Laraketai\Mobizon;

use Illuminate\Support\Arr;

class MobizonMessage
{
    /**
     * The phone number the message should be sent from.
     *
     * @var string
     */
    public $alphaname = '';
    /**
     * The message content.
     *
     * @var string
     */
    public $content = '';
    /**
     * Time of sending a message.
     *
     * @var \DateTimeInterface
     */
    public $sendAt;
    /**
     * Create a new message instance.
     *
     * @param  string $content
     *
     * @return static
     */
    public static function create($content = '')
    {
        return new static($content);
    }
    /**
     * @param  string  $content
     */
    public function __construct($content = '')
    {
        $this->content = $content;
    }
    /**
     * Set the message content.
     *
     * @param  string  $content
     *
     * @return $this
     */
    public function content($content)
    {
        $this->content = $content;
        return $this;
    }
    /**
     *
     * @param  string  $alphaname
     *
     * @return $this
     */
    public function alphaname($alphaname)
    {
        $this->alphaname = $alphaname;
        return $this;
    }
}
