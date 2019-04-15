<?php
declare(strict_types = 1);

namespace Psa\Invoicing\Common;

use MyCLabs\Enum\Enum;
use SplEnum;

/**
 * Country
 */
class Country extends Enum
{
    const DEFAULT = self::USA;

    const DEU = 'DEU';
    const JAP = 'JAP';
    const USA = 'USA';
    const CHE = 'CHE'; // Swiss
    const LIE = 'LIE'; // Liechtenstein
}
