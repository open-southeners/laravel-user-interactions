<?php

namespace OpenSoutheners\LaravelUserInteractions\Support;

use BackedEnum;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use OpenSoutheners\LaravelUserInteractions\Contracts\Interactable;
use OpenSoutheners\LaravelUserInteractions\UserInteraction;

final class Interaction
{
    protected ?Interactable $causer = null;

    protected ?Interactable $subject = null;

    protected ?BackedEnum $type = null;

    protected bool $removingWhenExists = false;

    /**
     * Action caused from entity (model).
     */
    public function from(Interactable $causer): self
    {
        $this->causer = $causer;

        return $this;
    }

    /**
     * Action caused from entity (alias of from).
     */
    public function causer(Interactable $causer): self
    {
        return $this->from($causer);
    }

    /**
     * Action subjected to entity (model).
     */
    public function to(Interactable $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Action subjected to entity (alias of to).
     */
    public function subject(Interactable $subject): self
    {
        return $this->to($subject);
    }

    /**
     * Toggle interaction when one already exists.
     */
    public function toggle(bool $allowingRemoval = true): self
    {
        $this->removingWhenExists = $allowingRemoval;

        return $this;
    }

    /**
     * Query if causer is doing the specified interaction to subject.
     *
     * @return \Illuminate\Database\Eloquent\Builder<\OpenSoutheners\LaravelUserInteractions\UserInteraction>
     */
    public function doing(BackedEnum $interaction): Builder
    {
        $query = UserInteraction::query();

        if ($this->causer) {
            $query->whereHasMorph(
                'causer',
                get_class($this->causer),
                fn ($query) => $query->whereKey($this->causer->getKey())
            );
        }

        if ($this->subject) {
            $query->whereHasMorph(
                'subject',
                get_class($this->subject),
                fn ($query) => $query->whereKey($this->subject->getKey())
            );
        }

        return $query->where('interaction_type', $interaction);
    }

    /**
     * Perform interaction so causer does it to subject.
     */
    public function does(BackedEnum $interaction): ?UserInteraction
    {
        $oneDoesExist = $this->doing($interaction)->first();

        if ($this->removingWhenExists && $oneDoesExist) {
            $oneDoesExist->delete();

            return null;
        }

        if ($oneDoesExist) {
            return $oneDoesExist;
        }

        $userInteraction = new UserInteraction(['interaction_type' => $interaction]);

        $userInteraction->causer()->associate($this->causer);
        $userInteraction->subject()->associate($this->subject);

        $userInteraction->save();

        return $userInteraction;
    }

    /**
     * Check if causer is doing the specified interaction to subject.
     */
    public function did(BackedEnum $interaction): bool
    {
        return $this->doing($interaction)->exists();
    }

    /**
     * Query if subject is doing the specified interaction to causer (reverse of did).
     */
    public function has(BackedEnum $interaction): bool
    {
        $originalCauser = $this->causer;
        $this->causer = $this->subject;

        $this->subject = $originalCauser;

        return $this->did($interaction);
    }

    /**
     * @param  array<\OpenSoutheners\LaravelUserInteractions\Contracts\Interactable>  $arguments
     * @return mixed
     */
    public function __call(string $method, array $arguments)
    {
        $interactionTypesEnum = config('user-interactions.interaction_types');

        if (! is_subclass_of($interactionTypesEnum, BackedEnum::class)) {
            throw new Exception('Interaction types config parameter should be a valid PHP enum.');
        }

        [$action, $interaction] = match (true) {
            Str::startsWith($method, 'hasBeen') => ['has', Str::of($method)->replace('hasBeen', '')->lower()->value()],
            Str::startsWith($method, 'has') => ['did', Str::of($method)->replace('has', '')->lower()->value()],
            default => ['does', $method],
        };

        $interactionType = $interactionTypesEnum::tryFrom($interaction);

        if (! $interactionType) {
            throw new Exception("Method {$method} does not exists as a possible interaction. Please configure your custom user interactions enum.");
        }

        $causer = $arguments['causer'] ?? $arguments[0] ?? null;
        $subject = $arguments['subject']
            ?? $arguments[$this->causer && count($arguments) === 1 ? 0 : 1]
            ?? null;

        if (count($arguments) > 1 && $causer) {
            $this->from($causer);
        }

        if ($subject) {
            $this->to($subject);
        }

        return call_user_func([$this, $action], $interactionType);
    }
}
