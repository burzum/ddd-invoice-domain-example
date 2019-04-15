<?php
declare(strict_types = 1);

namespace Psa\Invoicing\Domain;

use MyCLabs\Enum\Enum;

/**
 * PaymentStatus
 *
 * @method PAID()
 * @method UNPAID()
 */
class PaymentStatus extends Enum
{
    const PAID = 'paid';
    const UNPAID = 'unpaid';
}
