<?php

namespace OpenSoutheners\LaravelUserInteractions\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * @mixin \Illuminate\Database\Eloquent\Model
 */
interface Interactable
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany<\Illuminate\Database\Eloquent\Model>
     */
    public function followers(): MorphMany;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany<\Illuminate\Database\Eloquent\Model>
     */
    public function follows(): MorphMany;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany<\Illuminate\Database\Eloquent\Model>
     */
    public function likers(): MorphMany;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany<\Illuminate\Database\Eloquent\Model>
     */
    public function likes(): MorphMany;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany<\Illuminate\Database\Eloquent\Model>
     */
    public function subscribers(): MorphMany;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany<\Illuminate\Database\Eloquent\Model>
     */
    public function subscriptions(): MorphMany;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany<\Illuminate\Database\Eloquent\Model>
     */
    public function participants(): MorphMany;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany<\Illuminate\Database\Eloquent\Model>
     */
    public function participates(): MorphMany;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany<\Illuminate\Database\Eloquent\Model>
     */
    public function bookmarkers(): MorphMany;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany<\Illuminate\Database\Eloquent\Model>
     */
    public function bookmarks(): MorphMany;
}
