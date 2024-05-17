---
description: Installation of this package to your Laravel application
---

# Getting started

First install it using Composer:

```bash
composer require open-southeners/laravel-user-interactions
```

Then publish the **required** database migrations and config file:

```bash
php artisan vendor:publish --provider="OpenSoutheners\\LaravelUserInteractions\\ServiceProvider"
```

Run the migrations and you're almost all setup, now you need to **configure the interactable models** to be able to query and perform interactions from and into these models.

For example for your User model:

<pre class="language-php"><code class="lang-php">&#x3C;?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use OpenSoutheners\LaravelUserInteractions\Concerns\InteractsWith;
use OpenSoutheners\LaravelUserInteractions\Contracts\Interactable;

class User extends Authenticatable <a data-footnote-ref href="#user-content-fn-1">implements Interactable</a>
{
    <a data-footnote-ref href="#user-content-fn-2">use InteractsWith</a>;
    
    // The rest of your code here...
}
</code></pre>

And the models where your users will interact into:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OpenSoutheners\LaravelUserInteractions\Concerns\InteractsWith;
use OpenSoutheners\LaravelUserInteractions\Contracts\Interactable;

class Post extends Model implements Interactable
{
    use InteractsWith;

    // The rest of your code here...
}

```

And you are all set! 🎉

[^1]: Add this interface to the model to be able to use the model within the package functionality

[^2]: Also don't forget the trait that will make the actual functionality (relationships) work
