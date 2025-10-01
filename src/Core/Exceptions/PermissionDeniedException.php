<?php

namespace Courier\Core\Exceptions;

class PermissionDeniedException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Courier Permission Denied Exception';
}
