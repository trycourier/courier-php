<?php

namespace Courier\Core\Exceptions;

class AuthenticationException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Courier Authentication Exception';
}
