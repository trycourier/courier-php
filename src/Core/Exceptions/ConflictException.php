<?php

namespace Courier\Core\Exceptions;

class ConflictException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Courier Conflict Exception';
}
