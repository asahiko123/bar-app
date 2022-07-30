<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class AuthType extends Enum
{
    public const MAIL = "MAIL";
    public const SOCIAL = "SOCIAL";
    public const BOTH = "BOTH";
}
