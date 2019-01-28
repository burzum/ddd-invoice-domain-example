<?php
declare(strict_types = 1);

namespace Psa\Invoicing\Domain;

use MyCLabs\Enum\Enum;

/**
 * InvoiceStatus
 */
class InvoiceStatus extends Enum
{
    const DRAFT = 'draft';
    const LOCKED = 'locked';
}
