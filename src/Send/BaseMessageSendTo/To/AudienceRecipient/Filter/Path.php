<?php

declare(strict_types=1);

namespace Courier\Send\BaseMessageSendTo\To\AudienceRecipient\Filter;

enum Path: string
{
    case ACCOUNT_ID = 'account_id';
}
