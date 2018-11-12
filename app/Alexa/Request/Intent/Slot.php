<?php

namespace App\Alexa\Request\Intent;

class Slot
{
    public $name;
    public $value;
    public $confirmationStatus;

    public function __construct($slot)
    {
        $this->name = $slot->name;
        $this->value = $slot->value;
        $this->confirmationStatus = $slot->confirmationStatus;
    }
}
