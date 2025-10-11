<?php

namespace Courier\Core\Exceptions;

class InternalServerException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Courier Internal Server Exception';
}
