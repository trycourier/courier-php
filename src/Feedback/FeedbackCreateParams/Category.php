<?php

declare(strict_types=1);

namespace Courier\Feedback\FeedbackCreateParams;

/**
 * What kind of report this is: `possible_bug` for behavior that looks wrong, `confusing_behavior` for behavior that works but was hard to understand, `feature_request` for something Courier does not do yet, and `other`.
 */
enum Category: string
{
    case POSSIBLE_BUG = 'possible_bug';

    case CONFUSING_BEHAVIOR = 'confusing_behavior';

    case FEATURE_REQUEST = 'feature_request';

    case OTHER = 'other';
}
