<?php

namespace Courier\Users\Tokens\Types;

enum TokenStatus: string
{
    case Active = "active";
    case Unknown = "unknown";
    case Failed = "failed";
    case Revoked = "revoked";
}
