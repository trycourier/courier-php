<?php

namespace Courier\Send\Types;

enum ChannelSource: string
{
    case Subscription = "subscription";
    case List_ = "list";
    case Recipient = "recipient";
}
