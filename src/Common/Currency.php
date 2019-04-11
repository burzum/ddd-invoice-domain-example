<?php
declare(strict_types = 1);

namespace Psa\Invoicing\Common;

use MyCLabs\Enum\Enum;
use SplEnum;

/**
 * Currency
 */
class Currency extends Enum
{
    const DEFAULT = self::CHF;
    const CHF = 'CHF';
    const JPY = 'JPY';
    const USD = 'USD';
    const EUR = 'EUR';
}
