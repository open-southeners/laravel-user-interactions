<?php

namespace Workbench\App\Models;

use Illuminate\Database\Eloquent\Model;
use OpenSoutheners\LaravelUserInteractions\Concerns\InteractsWith;
use OpenSoutheners\LaravelUserInteractions\Contracts\Interactable;

/**
 * @implements \OpenSoutheners\LaravelUserInteractions\Contracts\Interactable<self>
 */
class Post extends Model implements Interactable
{
    use InteractsWith;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array<string>
     */
    protected $guarded = [];
}
