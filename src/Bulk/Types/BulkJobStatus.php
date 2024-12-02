<?php

namespace Courier\Bulk\Types;

enum BulkJobStatus: string
{
    case Created = "CREATED";
    case Processing = "PROCESSING";
    case Completed = "COMPLETED";
    case Error = "ERROR";
}
