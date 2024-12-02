<?php

namespace Courier\Messages\Types;

enum MessageStatus: string
{
    case Clicked = "CLICKED";
    case Delivered = "DELIVERED";
    case Enqueued = "ENQUEUED";
    case Opened = "OPENED";
    case Canceled = "CANCELED";
    case Sent = "SENT";
    case Throttled = "THROTTLED";
    case Undeliverable = "UNDELIVERABLE";
    case Unmapped = "UNMAPPED";
    case Unroutable = "UNROUTABLE";
}
