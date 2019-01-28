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
    public function __construct(?string $time = null, DateTimeZone $timezone = null)
    {
        if (is_null($time)) {
            $time = '+2 weeks';
        }

        parent::__construct($time, $timezone);
    }
}
