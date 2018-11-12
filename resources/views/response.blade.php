{
    "version": "1.0",
    "sessionAttributes": {
        "key": "value"
    },
    "response": {
@if (!empty($response->outputSpeech))
        "outputSpeech": {
            "type": "{{ $response->outputSpeech->type }}",
            "text": "{{ $response->outputSpeech->text }}",
            "ssml": "{{ $response->outputSpeech->ssml }}",
            "playBehavior": "{{ $response->outputSpeech->playBehavior }}"
        },
@endif
@if (!empty($response->card))
        "card": {
            "type": "{{ $response->card->type }}",
            "title": "{{ $response->card->title }}",
            "content": "{{ $response->card->content }}",
            "text": "{{ $response->card->text }}",
            "image": {
                "smallImageUrl": "{{ $response->card->smallImageUrl }}",
                "largeImageUrl": "{{ $response->card->largeImageUrl }}"
            }
        },
@endif
@if (!empty($response->directives))
        "directives": [
        @foreach ($response->directives as $directive)
            {
                "type": "InterfaceName.Directive"
                (...properties depend on the directive type)
            }@if (!$loop->last),@endif
        @endforeach
        ],
@endif
        "shouldEndSession": {{ isset($response->shouldEndSession) && $response->shouldEndSession ? 'true' : 'false' }}
    }
}