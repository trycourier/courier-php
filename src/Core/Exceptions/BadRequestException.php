<?php

namespace Courier\Core\Exceptions;

class BadRequestException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Courier Bad Request Exception';
}
