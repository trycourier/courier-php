<?php

namespace Courier\Messages\Types;

enum MessageStatus: string
{
    case Canceled = "CANCELED";
    case Clicked = "CLICKED";
    case Delayed = "DELAYED";
    case Delivered = "DELIVERED";
    case Digested = "DIGESTED";
    case Enqueued = "ENQUEUED";
    case Filtered = "FILTERED";
    case Opened = "OPENED";
    case Routed = "ROUTED";
    case Sent = "SENT";
    case Simulated = "SIMULATED";
    case Throttled = "THROTTLED";
    case Undeliverable = "UNDELIVERABLE";
    case Unmapped = "UNMAPPED";
    case Unroutable = "UNROUTABLE";
}
