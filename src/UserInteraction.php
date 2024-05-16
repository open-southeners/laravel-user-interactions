<?php

namespace OpenSoutheners\LaravelUserInteractions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property \BackedEnum $interaction_type
 * @property int $causer_id
 * @property string $causer_type
 * @property int $subject_id
 * @property string $subject_type
 */
class UserInteraction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = ['interaction_type'];

    public function getTable()
    {
        return config('user-interactions.table_name');
    }

    public function causer(): MorphTo
    {
        return $this->morphTo();
    }

    public function subject(): MorphTo
    {
        return $this->morphTo();
    }
}
