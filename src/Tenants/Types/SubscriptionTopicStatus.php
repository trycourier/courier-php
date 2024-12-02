<?php

namespace Courier\Tenants\Types;

enum SubscriptionTopicStatus: string
{
    case OptedOut = "OPTED_OUT";
    case OptedIn = "OPTED_IN";
    case Required = "REQUIRED";
}
