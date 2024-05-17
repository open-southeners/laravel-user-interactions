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
     * @var array<int, string>
     */
    protected $fillable = ['interaction_type'];

    /**
     * Get the table associated with the model.
     *
     * @return string
     */
    public function getTable()
    {
        /** @var string $configuredTable */
        $configuredTable = config('user-interactions.table_name');

        return $configuredTable;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo<\Illuminate\Database\Eloquent\Model, self>
     */
    public function causer(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo<\Illuminate\Database\Eloquent\Model, self>
     */
    public function subject(): MorphTo
    {
        return $this->morphTo();
    }
}
