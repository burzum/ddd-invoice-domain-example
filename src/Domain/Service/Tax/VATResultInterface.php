<?php
declare(strict_types = 1);

namespace Psa\Invoicing\Domain\Service\Tax;

use JsonSerializable;

/**
 * VAT calculation result object interface
 */
interface VATResultInterface extends JsonSerializable
{
    /**
     * Gets the gross value
     *
     * @return float
     */
    public function getGross() : float;

    /**
     * Gets the nett value
     *
     * @return float
     */
    public function getNett() : float;

    /**
     * Gets the vat value
     *
     * @return float
     */
    public function getVat() : float;

    /**
     * Gets the percentage value
     *
     * @return float
     */
    public function getPercentage() : float;
}
