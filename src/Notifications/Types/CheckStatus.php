<?php

namespace Courier\Notifications\Types;

enum CheckStatus: string
{
    case Resolved = "RESOLVED";
    case Failed = "FAILED";
    case Pending = "PENDING";
}
