<?php

namespace App\Http\Controllers;

use App\Alexa\OutputSpeech;
use App\Alexa\Response;
use Illuminate\Http\Request;

class AlexaRequestController extends Controller
{
    public function request(Request $request)
    {
        $alexaRequest = new \App\Alexa\Request\Request($request->getContent());

        $response = new Response();
        return $response->withOutputSpeech(new OutputSpeech('Hallo Welt'))->render();
    }
}
