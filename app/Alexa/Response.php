<?php

namespace App\Alexa;

class Response
{
    public $outputSpeech = null;
    public $card = null;
    public $directives = [];
    public $shouldEndSession = false;

    public function render()
    {
        return view('response', ['response' => $this,]);
    }

    public function withOutputSpeech(OutputSpeech $outputSpeech)
    {
        $this->outputSpeech = $outputSpeech;

        return $this;
    }

    public function withCard(Card $card)
    {
        $this->card = $card;

        return $this;
    }

    public function withDirective(Directive $directive)
    {
        $this->directives[] = $directive;

        return $this;
    }
}
