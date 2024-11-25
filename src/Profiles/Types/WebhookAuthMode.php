<?php

namespace Courier\Profiles\Types;

enum WebhookAuthMode: string
{
    case None = "none";
    case Basic = "basic";
    case Bearer = "bearer";
}
