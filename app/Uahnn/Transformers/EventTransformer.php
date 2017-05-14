<?php

namespace App\Uahnn\Transformers;

class EventTransformer extends Transformer {

    public function transform($event) {

        return [
            'name' => $event->name,
            'location' => $event->location->name,
            'start' => $event->start->format('Y-m-d h:m:s'),
            'end' => $event->end->format('Y-m-d h:m:s')
        ];
    }
}