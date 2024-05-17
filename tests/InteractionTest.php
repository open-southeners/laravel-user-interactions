<?php

namespace OpenSoutheners\LaravelUserInteractions\Tests;

use Illuminate\Support\Collection;
use OpenSoutheners\LaravelUserInteractions\Support\Facades\Interaction;
use OpenSoutheners\LaravelUserInteractions\UserInteraction;
use stdClass;
use Workbench\App\Models\Post;
use Workbench\App\Models\User;

class InteractionTest extends TestCase
{
    protected Collection $users;

    protected Collection $posts;

    public function setUp(): void
    {
        parent::setUp();

        $this->users = User::all();
        $this->posts = Post::all();
    }

    public function testUserFollowedAnotherUserAndCheckingTheInteractionExists()
    {
        $taylor = $this->users->first();
        $ruben = $this->users->last();

        $interaction = Interaction::followed(subject: $taylor, causer: $ruben);

        $this->assertInstanceOf(UserInteraction::class, $interaction);

        $this->assertCount(0, $ruben->followers);
        $this->assertCount(1, $ruben->follows);
        $this->assertCount(1, $taylor->followers);
        $this->assertCount(0, $taylor->follows);
        $this->assertCount(0, $ruben->likers);
        $this->assertCount(0, $ruben->likes);
        $this->assertCount(0, $taylor->likers);
        $this->assertCount(0, $taylor->likes);
        $this->assertCount(0, $ruben->subscribers);
        $this->assertCount(0, $ruben->subscriptions);
        $this->assertCount(0, $taylor->subscribers);
        $this->assertCount(0, $taylor->subscriptions);
        $this->assertCount(0, $ruben->participants);
        $this->assertCount(0, $ruben->participates);
        $this->assertCount(0, $taylor->participants);
        $this->assertCount(0, $taylor->participates);
        $this->assertCount(0, $ruben->bookmarkers);
        $this->assertCount(0, $ruben->bookmarks);
        $this->assertCount(0, $taylor->bookmarkers);
        $this->assertCount(0, $taylor->bookmarks);
        $this->assertTrue(Interaction::from($ruben)->hasFollowed($taylor));
        $this->assertFalse(Interaction::from($taylor)->hasFollowed($ruben));
        $this->assertTrue(Interaction::from($taylor)->hasBeenFollowed($ruben));
        $this->assertFalse(Interaction::from($ruben)->hasBeenFollowed($taylor));
    }

    public function testFromUserFollowedAnotherUserAndCheckingTheInteractionExists()
    {
        $taylor = $this->users->first();
        $ruben = $this->users->last();

        $interaction = Interaction::from($ruben)->followed($taylor);

        $this->assertInstanceOf(UserInteraction::class, $interaction);

        $this->assertTrue(Interaction::from($ruben)->hasFollowed($taylor));
        $this->assertFalse(Interaction::from($taylor)->hasFollowed($ruben));
        $this->assertTrue(Interaction::from($taylor)->hasBeenFollowed($ruben));
        $this->assertFalse(Interaction::from($ruben)->hasBeenFollowed($taylor));
    }

    public function testUserFollowedAnotherUserTwiceDoesNotToggleAndReturnsSameModel()
    {
        $taylor = $this->users->first();
        $ruben = $this->users->last();

        $firstInteraction = Interaction::from($ruben)->followed($taylor);

        $this->assertTrue(Interaction::from($ruben)->hasFollowed($taylor));

        $secondInteraction = Interaction::from($ruben)->followed($taylor);

        $this->assertTrue(Interaction::from($ruben)->hasFollowed($taylor));

        $this->assertTrue($firstInteraction->is($secondInteraction));
    }

    public function testUserFollowedAnotherUserWithToggleTheFollow()
    {
        $taylor = $this->users->first();
        $ruben = $this->users->last();

        Interaction::from($ruben)->toggle()->followed($taylor);

        $this->assertTrue(Interaction::causer($ruben)->subject($taylor)->hasFollowed());
        $this->assertTrue(Interaction::from($taylor)->hasBeenFollowed($ruben));

        Interaction::from($ruben)->toggle()->followed($taylor);

        $this->assertFalse(Interaction::from($ruben)->hasFollowed($taylor));
        $this->assertFalse(Interaction::from($taylor)->hasBeenFollowed($ruben));
    }

    public function testDeveloperTriesAnIllegalInteractionThrowsAnException()
    {
        $taylor = $this->users->first();
        $ruben = $this->users->last();

        $this->expectExceptionMessage('Method loved does not exists as a possible interaction. Please configure your custom user interactions enum.');

        Interaction::from($ruben)->loved($taylor);
    }

    public function testDeveloperConfiguredIllegalEnumInteractionTypeThrowsAnException()
    {
        config(['user-interactions.interaction_types' => new stdClass()]);

        $taylor = $this->users->first();
        $ruben = $this->users->last();

        $this->expectExceptionMessage('Interaction types config parameter should be a valid PHP enum.');

        Interaction::from($ruben)->loved($taylor);
    }
}
