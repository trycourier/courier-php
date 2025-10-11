<?php

namespace Courier\Core\Exceptions;

class UnprocessableEntityException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Courier Unprocessable Entity Exception';
}
