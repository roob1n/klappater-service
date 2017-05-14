<?php

namespace App\Uahnn\Transformers;

class GuestTransformer extends Transformer {

    private $eventTransformer;

    function __construct(EventTransformer $eventTransformer) {
        $this->eventTransformer = $eventTransformer;
    }

    public function transform($guest) {

        return [
            'id' => $guest->id,
            'last_name' => $guest->last_name,
            'first_name' => $guest->first_name,
            'nick_name' => $guest->nick_name,
            'email' => $guest->email,
            'credits' => $guest->suggestion_credit,
            'timeout' => $guest->suggestion_timeout,
            'events' => $this->eventTransformer->transformCollection($guest->events),
        ];
    }
}