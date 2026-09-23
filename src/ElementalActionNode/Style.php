<?php

declare(strict_types=1);

namespace Courier\ElementalActionNode;

/**
 * How prominent the action should be. `button` is the default, `secondary` and `tertiary` are the other two button styles, and `link` renders as inline text rather than a button.
 *
 * Each channel draws these as closely as its medium allows. Email fills `button`, outlines `secondary`, and underlines `tertiary`. The in-app Inbox fills `button`, outlines `secondary`, and draws `tertiary` as a solid button. Slack renders all three as Block Kit buttons, with `secondary` in Slack's `primary` style and `tertiary` in its `danger` style.
 *
 * `background_color` is the fill for `button`, and the border and label color for `secondary`. For `tertiary` it colors the underline and label in email and the fill in the Inbox. It does not apply to `link`. An Inbox theme that sets its own action colors takes precedence over the template.
 */
enum Style: string
{
    case BUTTON = 'button';

    case SECONDARY = 'secondary';

    case TERTIARY = 'tertiary';

    case LINK = 'link';
}
