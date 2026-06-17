<?php

namespace OpenSoutheners\LaravelUserInteractions\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use OpenSoutheners\LaravelUserInteractions\UserInteraction;

/**
 * @template TModel of \Illuminate\Database\Eloquent\Model
 *
 * @mixin TModel
 * @phpstan-require-extends \Illuminate\Database\Eloquent\Model
 */
interface Interactable
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany<UserInteraction, TModel>
     */
    public function followers(): MorphMany;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany<UserInteraction, TModel>
     */
    public function follows(): MorphMany;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany<UserInteraction, TModel>
     */
    public function likers(): MorphMany;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany<UserInteraction, TModel>
     */
    public function likes(): MorphMany;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany<UserInteraction, TModel>
     */
    public function subscribers(): MorphMany;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany<UserInteraction, TModel>
     */
    public function subscriptions(): MorphMany;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany<UserInteraction, TModel>
     */
    public function participants(): MorphMany;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany<UserInteraction, TModel>
     */
    public function participates(): MorphMany;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany<UserInteraction, TModel>
     */
    public function bookmarkers(): MorphMany;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany<UserInteraction, TModel>
     */
    public function bookmarks(): MorphMany;
}
