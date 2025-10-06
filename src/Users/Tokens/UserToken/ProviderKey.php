<?php

declare(strict_types=1);

namespace Courier\Users\Tokens\UserToken;

enum ProviderKey: string
{
    case FIREBASE_FCM = 'firebase-fcm';

    case APN = 'apn';

    case EXPO = 'expo';

    case ONESIGNAL = 'onesignal';
}
