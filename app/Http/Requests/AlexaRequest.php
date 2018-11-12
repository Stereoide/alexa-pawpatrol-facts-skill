<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;

class AlexaRequest extends Request
{
    public $intent = null;

    public function __construct(array $query = array(), array $request = array(), array $attributes = array(), array $cookies = array(), array $files = array(), array $server = array(), $content = null)
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);


    }
}
