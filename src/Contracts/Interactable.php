<?php

namespace OpenSoutheners\LaravelUserInteractions\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface Interactable
{
    public function followers(): MorphMany;

    public function follows(): MorphMany;

    public function likers(): MorphMany;

    public function likes(): MorphMany;

    public function subscribers(): MorphMany;

    public function subscribed(): MorphMany;

    public function participants(): MorphMany;

    public function participates(): MorphMany;

    public function bookmarkers(): MorphMany;

    public function bookmarked(): MorphMany;
}
