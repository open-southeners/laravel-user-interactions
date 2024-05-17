---
description: All methods available on this package to be used
---

# Usage

This package offers any of the entities previously configured (check [.](./ "mention")) the ability to save different type of interactions between them, by default but not only limited to you have the following interaction types:

* Follow
* Like
* Subscribe
* Participation
* Bookmark

If you ever feel this is not enough you are completely free to [send a PR](https://github.com/open-southeners/laravel-user-interactions/compare) to our repository **or even better extend the enum** and change it from the config file.

### Save interactions

Knowing this you can simply use this package from the enum in the following way:

<pre class="language-php"><code class="lang-php">use OpenSoutheners\LaravelUserInteractions\Support\Facades\Interaction;
<a data-footnote-ref href="#user-content-fn-1">use OpenSoutheners\LaravelUserInteractions\UserInteractionType;</a>

// User ID 1 will follow User ID 2
Interaction::from(User::find(1))
    ->to(User::find(2))
    ->does(UserInteractionType::Follow); // returns UserInteraction persisted model
</code></pre>

**Not a fan of Facades?** You can use the functional way as well:

```php
use OpenSoutheners\LaravelUserInteractions\UserInteractionType;

app('user.interaction')->from(User::find(1))
    ->to(User::find(2))
    ->does(UserInteractionType::Follow);
```

But you can do this in a even **shorter way and without any import** like this:

```php
app('user.interaction')->followed(User::find(1), User::find(2));

// Or using a much descriptive way with named arguments
app('user.interaction')->followed(causer: User::find(1), subject: User::find(2));

// Or even a combination of both ways
app('user.interaction')->from(User::find(1))->followed(User::find(2));
```

Possibilities are endless!

<pre class="language-php"><code class="lang-php">use OpenSoutheners\LaravelUserInteractions\Support\Facades\Interaction;

<strong>Interaction::followed(User::find(1), User::find(2));
</strong>Interaction::liked(User::find(1), Post::find(2));
Interaction::subscribed(User::find(1), Channel::find(1));
Interaction::participated(User::find(1), Comment::find(3));
Interaction::bookmarked(User::find(1), Post::find(4));
</code></pre>

### Toggle removal when interaction exists

If your interaction logic needs to toggle whenever the same type and entities are at the same direction you can use the following:

```php
// If this is the first interaction it will be saved otherwise it does nothing
Interaction::followed(User::find(1), User::find(2));

// This does the same but if one exists it will remove it
Interaction::toggle()->followed(User::find(1), User::find(2));
```

### Checking existence of interaction

Now the previous code was for saving and you can check all the previously saved interactions using the following:

```php
use OpenSoutheners\LaravelUserInteractions\Support\Facades\Interaction;
use OpenSoutheners\LaravelUserInteractions\UserInteractionType;

// Check if User ID 1 did follow User ID 2
Interaction::from(User::find(1))
    ->to(User::find(2))
    ->did(UserInteractionType::Follow); // returns bool
```

Or even shorter version:

```php
use OpenSoutheners\LaravelUserInteractions\Support\Facades\Interaction;

Interaction::from(User::find(1))->to(User::find(2))->hasFollowed();
Interaction::from(User::find(1))->hasFollowed(User::find(2));
Interaction::hasFollowed(User::find(1), User::find(2));
Interaction::hasFollowed(causer: User::find(1), subject: User::find(2));
```

And of course this is compatible with any other interaction (**even those one you added into your own enum!**).

But how about checking if a user has been followed by the other user, **you can revert the causer/subject** but we prepared a more semantic method for you:

```php
use OpenSoutheners\LaravelUserInteractions\Support\Facades\Interaction;

// To check if User ID 1 has been followed by User ID 2...

// you will normally do this
Interaction::hasFollowed(causer: User::find(2), subject: User::find(1));

// but you can also do this
Interaction::hasBeenFollowed(causer: User::find(1), subject: User::find(2));
```

### Query interactions

You can save and check for interactions but what about querying? We got you covered:

<pre class="language-php"><code class="lang-php"><strong>use OpenSoutheners\LaravelUserInteractions\Support\Facades\Interaction;
</strong>use OpenSoutheners\LaravelUserInteractions\UserInteractionType;
<strong>
</strong><strong>// Query all followers of a user
</strong><strong>Interaction::to(User::find(1))->doing(UserInteractionType::Follow)->get();
</strong><strong>
</strong><strong>// Remove all followers of a user
</strong>Interaction::to(User::find(1))->doing(UserInteractionType::Follow)->delete();
<strong>
</strong><strong>// Query all follows of a user
</strong>Interaction::from(User::find(1))->doing(UserInteractionType::Follow)->get();

// Remove all follows of a user
Interaction::from(User::find(1))->doing(UserInteractionType::Follow)->delete();
</code></pre>

Now is up to you to put all this in practice!

[^1]: This can very well be your previously configured enum for extended types
