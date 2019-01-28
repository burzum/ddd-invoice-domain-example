<?php
declare(strict_types = 1);

namespace Psa\Invoicing\Common;

use MyCLabs\Enum\Enum;

/**
 * Salutation
 */
class Salutation extends Enum
{
    const MR = 'mr';
    const MRS = 'mrs';
    const MS = 'ms';
    const DR = 'dr';
}
