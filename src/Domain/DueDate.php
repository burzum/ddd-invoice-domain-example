<?php
declare(strict_types = 1);

namespace Psa\Invoicing\Domain;

use DateTimeZone;

/**
 * Due Date
 */
class DueDate extends \DateTime
{
    /**
     * Constructor
     */
    public function __construct(string $time = '+2 weeks', \DateTimeZone $timezone = null)
    {
        parent::__construct($time, $timezone);
    }
}
