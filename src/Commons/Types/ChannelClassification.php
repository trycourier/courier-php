<?php

namespace Courier\Commons\Types;

enum ChannelClassification: string
{
    case DirectMessage = "direct_message";
    case Email = "email";
    case Push = "push";
    case Sms = "sms";
    case Webhook = "webhook";
    case Inbox = "inbox";
}
