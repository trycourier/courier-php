<?php

namespace Courier\Users\Tokens\Types;

enum ProviderKey: string
{
    case FirebaseFcm = "firebase-fcm";
    case Apn = "apn";
    case Expo = "expo";
    case Onesignal = "onesignal";
}
