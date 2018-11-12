<?php

namespace App\Alexa\Request;

class Request
{
    public $version;

    protected $session;
    public $sessionId;
    public $sessionIsNew;
    public $attributes;

    protected $context;
    public $system;
    public $apiAccessToken;
    public $apiEndpoint;
    public $applicationId;
    public $device;
    public $deviceId;
    public $supportedInterfaces;

    public $user;
    public $userId;
    public $accessToken;
    public $permissions;

    protected $request;
    public $requestType;
    public $requestId;
    public $timestamp;
    public $locale;
    public $dialogState;
    public $sessionEndedReason;
    public $sessionEndedErrorType;
    public $sessionEndedErrorMessage;

    public $intent;

    public function __construct(string $request)
    {
        $payload = json_decode($request);

        /* Verify application id */

        if (!isset($payload->session->application->applicationId)) {
            abort(400);
        }

        if ($payload->session->application->applicationId !== 'amzn1.ask.skill.8669d7d7-be3f-4267-821c-7d86c496de94') {
            abort(400);
        }

        /* Parse payload metadata */

        $this->version = optional($payload)->version;

        $this->session = optional($payload)->session;
        if (!empty($this->session)) {
            $this->sessionId = $this->session->sessionId;
            $this->sessionIsNew = $this->session->new;

            /* Try to parse attributes map */

            if (isset($this->session->attributes)) {
                $this->attributes = $this->session->attributes;
            }
        }

        /* Parse context */

        $this->context = $payload->context;

        $this->system = $this->context->System;
        $this->apiAccessToken = $this->system->apiAccessToken;
        $this->apiEndpoint = $this->system->apiEndpoint;
        $this->applicationId = $this->system->application->applicationId;

        $this->device = $this->system->device;
        $this->deviceId = $this->device->deviceId;
        $this->supportedInterfaces = $this->device->supportedInterfaces;

        $this->user = $this->system->user;
        $this->userId = $this->user->userId;
        $this->accessToken = optional($this->user)->accessToken;
        $this->permissions = optional($this->user)->permissions;

        /* Parse request */

        $this->request = optional($payload)->request;
        if (empty($this->request)) {
            abort(400);
        }

        $this->requestType = $this->request->type;
        $this->requestId = $this->request->requestId;
        $this->timestamp = $this->request->timestamp;
        $this->locale = $this->request->locale;

        if (isset($this->request->dialogState)) {
            $this->dialogState = $this->request->dialogState;
        }

        if ($this->isIntentRequest()) {
            $this->intent = new Intent\Intent($this->request->intent);
        }

        if ($this->isSessionEndedRequest()) {
            $this->sessionEndedReason = $this->request->reason;

            if (isset($this->request->error)) {
                $this->sessionEndedErrorType = $this->request->error->type;
                $this->sessionEndedErrorMessage = $this->request->error->message;
            }
        }
    }

    public function isLaunchRequest()
    {
        return $this->requestType === 'LaunchRequest';
    }

    public function isIntentRequest()
    {
        return $this->requestType === 'IntentRequest';
    }

    public function isSessionEndedRequest()
    {
        return $this->requestType === 'SessionEndedRequest';
    }
}