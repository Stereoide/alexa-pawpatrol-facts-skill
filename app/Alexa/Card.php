<?php

namespace App\Alexa;

class Card
{
    public $type;
    public $title;
    public $content;
    public $text;
    public $smallImageUrl;
    public $largeImageUrl;

    public function __construct(string $type = 'Simple', string $title = '', string $content = '', string $text = '', string $smallImageUrl = '', string $largeImageUrl = '')
    {
        $this->type = $type;
        $this->title = $title;
        $this->content = $content;
        $this->text = $text;
        $this->smallImageUrl = $smallImageUrl;
        $this->largeImageUrl = $largeImageUrl;
    }
}
