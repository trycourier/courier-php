<?php

namespace Courier\Core\Exceptions;

class NotFoundException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Courier Not Found Exception';
}
