<?php

namespace Courier\Bulk\Types;

enum BulkJobUserStatus: string
{
    case Pending = "PENDING";
    case Enqueued = "ENQUEUED";
    case Error = "ERROR";
}
