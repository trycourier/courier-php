<?php

namespace Courier\Core\Exceptions;

class RateLimitException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Courier Rate Limit Exception';
}
