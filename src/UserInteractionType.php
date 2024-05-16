<?php

namespace OpenSoutheners\LaravelUserInteractions;

enum UserInteractionType: string
{
    case Follow = 'followed';

    case Like = 'liked';

    case Subscribe = 'subscribed';

    case Participate = 'participated';

    case Bookmark = 'bookmarked';
}
