<?php

namespace OpenSoutheners\LaravelUserInteractions\Concerns;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use OpenSoutheners\LaravelUserInteractions\UserInteraction;
use OpenSoutheners\LaravelUserInteractions\UserInteractionType;

trait InteractsWith
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany<\Illuminate\Database\Eloquent\Model>
     */
    public function followers(): MorphMany
    {
        return $this->morphMany(UserInteraction::class, 'subject')
            ->where('interaction_type', UserInteractionType::Follow)
            ->with('causer');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany<\Illuminate\Database\Eloquent\Model>
     */
    public function follows(): MorphMany
    {
        return $this->morphMany(UserInteraction::class, 'causer')
            ->where('interaction_type', UserInteractionType::Follow)
            ->with('subject');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany<\Illuminate\Database\Eloquent\Model>
     */
    public function likers(): MorphMany
    {
        return $this->morphMany(UserInteraction::class, 'subject')
            ->where('interaction_type', UserInteractionType::Like)
            ->with('causer');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany<\Illuminate\Database\Eloquent\Model>
     */
    public function likes(): MorphMany
    {
        return $this->morphMany(UserInteraction::class, 'causer')
            ->where('interaction_type', UserInteractionType::Like)
            ->with('subject');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany<\Illuminate\Database\Eloquent\Model>
     */
    public function subscribers(): MorphMany
    {
        return $this->morphMany(UserInteraction::class, 'subject')
            ->where('interaction_type', UserInteractionType::Subscribe)
            ->with('causer');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany<\Illuminate\Database\Eloquent\Model>
     */
    public function subscriptions(): MorphMany
    {
        return $this->morphMany(UserInteraction::class, 'causer')
            ->where('interaction_type', UserInteractionType::Subscribe)
            ->with('subject');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany<\Illuminate\Database\Eloquent\Model>
     */
    public function participants(): MorphMany
    {
        return $this->morphMany(UserInteraction::class, 'subject')
            ->where('interaction_type', UserInteractionType::Participate)
            ->with('causer');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany<\Illuminate\Database\Eloquent\Model>
     */
    public function participates(): MorphMany
    {
        return $this->morphMany(UserInteraction::class, 'causer')
            ->where('interaction_type', UserInteractionType::Participate)
            ->with('subject');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany<\Illuminate\Database\Eloquent\Model>
     */
    public function bookmarkers(): MorphMany
    {
        return $this->morphMany(UserInteraction::class, 'subject')
            ->where('interaction_type', UserInteractionType::Bookmark)
            ->with('causer');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany<\Illuminate\Database\Eloquent\Model>
     */
    public function bookmarks(): MorphMany
    {
        return $this->morphMany(UserInteraction::class, 'causer')
            ->where('interaction_type', UserInteractionType::Bookmark)
            ->with('subject');
    }
}
