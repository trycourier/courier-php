<?php

declare(strict_types=1);

namespace Courier\Send\Recipient\AudienceRecipient\Filter;

enum Path: string
{
    case ACCOUNT_ID = 'account_id';
}
