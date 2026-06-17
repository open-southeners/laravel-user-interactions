<?php

namespace Workbench\App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use OpenSoutheners\LaravelUserInteractions\Concerns\InteractsWith;
use OpenSoutheners\LaravelUserInteractions\Contracts\Interactable;

/**
 * @implements \OpenSoutheners\LaravelUserInteractions\Contracts\Interactable<self>
 */
class User extends Authenticatable implements Interactable
{
    use InteractsWith;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array<string>
     */
    protected $guarded = [];
}
