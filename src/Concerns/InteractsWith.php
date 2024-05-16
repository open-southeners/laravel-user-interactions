<?php

namespace OpenSoutheners\LaravelUserInteractions\Concerns;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use OpenSoutheners\LaravelUserInteractions\UserInteraction;
use OpenSoutheners\LaravelUserInteractions\UserInteractionType;

trait InteractsWith
{
    public function followers(): MorphMany
    {
        return $this->morphMany(UserInteraction::class, 'subject')
            ->where('interaction_type', UserInteractionType::Follow);
    }

    public function follows(): MorphMany
    {
        return $this->morphMany(UserInteraction::class, 'causer')
            ->where('interaction_type', UserInteractionType::Follow);
    }

    public function likers(): MorphMany
    {
        return $this->morphMany(UserInteraction::class, 'subject')
            ->where('interaction_type', UserInteractionType::Follow);
    }

    public function likes(): MorphMany
    {
        return $this->morphMany(UserInteraction::class, 'causer')
            ->where('interaction_type', UserInteractionType::Follow);
    }

    public function subscribers(): MorphMany
    {
        return $this->morphMany(UserInteraction::class, 'subject')
            ->where('interaction_type', UserInteractionType::Follow);
    }

    public function subscribed(): MorphMany
    {
        return $this->morphMany(UserInteraction::class, 'causer')
            ->where('interaction_type', UserInteractionType::Follow);
    }

    public function participants(): MorphMany
    {
        return $this->morphMany(UserInteraction::class, 'subject')
            ->where('interaction_type', UserInteractionType::Follow);
    }

    public function participates(): MorphMany
    {
        return $this->morphMany(UserInteraction::class, 'causer')
            ->where('interaction_type', UserInteractionType::Follow);
    }

    public function bookmarkers(): MorphMany
    {
        return $this->morphMany(UserInteraction::class, 'subject')
            ->where('interaction_type', UserInteractionType::Follow);
    }

    public function bookmarked(): MorphMany
    {
        return $this->morphMany(UserInteraction::class, 'causer')
            ->where('interaction_type', UserInteractionType::Follow);
    }
}
