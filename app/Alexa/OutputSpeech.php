<?php

namespace App\Alexa;

class OutputSpeech
{
    public $type;
    public $text;
    public $ssml;
    public $playBehavior;

    public function __construct(string $text, string $type = 'PlainText', string $ssml = '', string $playBehavior = 'REPLACE_ENQUEUED')
    {
        $this->type = $type;
        $this->text = $text;
        $this->ssml = $ssml;
        $this->playBehavior = $playBehavior;
    }
}
