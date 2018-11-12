<?php

namespace App\Alexa\Request\Intent;

class Intent
{
    public $name;
    public $confirmationStatus;
    public $slots;

    public function __construct($intent)
    {
        $this->name = $intent->name;
        $this->confirmationStatus = optional($intent->confirmationStatus);

        if (isset($intent->slots)) {
            foreach ($intent->slots as $slotName => $slotData) {
                $this->slots[$slotName] = new Slot($slotData);
            }
        }
    }
}
