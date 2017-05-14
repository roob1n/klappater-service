<?php

namespace App\Uahnn\Transformers;

use Illuminate\Database\Eloquent\Collection;

abstract class Transformer {

    public function transformCollection(Collection $collection) {
        return $collection->map([$this, 'transform']);
    }

    public abstract function transform($item);
}