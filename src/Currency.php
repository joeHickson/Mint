<?php

namespace joeHickson\Mint;

class Currency
{
    /**
     * @var string
     */
    private $currencyCode;
    /**
     * @var string
     */
    private $fullName;
    /**
     * @var int
     */
    private $decimal;
    /**
     * @var string[]
     */
    private $formatMasks;
    /**
     * @var CurrencyUnitCollection
     */
    private $units;
    /**
     * @var DenominationCollection
     */
    private $denominations;

    public function setUnits(CurrencyUnitCollection $units)
    {
        $this->units = $units;
    }

    public function getUnits() : CurrencyUnitCollection
    {
        return $this->units;
    }

    public function setDenominations(DenominationCollection $denominationCollection)
    {
        $this->denominations = $denominationCollection;
    }
	
    public function getDenominations(): DenominationCollection
    {
        return $this->denominations;
    }

    /**
     * @return string
     */
    public function getCurrencyCode(): string
    {
        return $this->currencyCode;
    }

    /**
     * @param string $currencyCode
     */
    public function setCurrencyCode(string $currencyCode)
    {
        $this->currencyCode = $currencyCode;
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->fullName;
    }

    /**
     * @param string $fullName
     */
    public function setFullName(string $fullName)
    {
        $this->fullName = $fullName;
    }

    /**
     * @return int
     */
    public function getDecimal(): int
    {
        return $this->decimal;
    }

    /**
     * @param int $decimal
     */
    public function setDecimal(int $decimal)
    {
        $this->decimal = $decimal;
    }

    /**
     * @return string
     */
    public function getFormatMask($bitmask): string
    {
        return $this->formatMasks[$bitmask];
    }

    /**
     * @param string $formatMask
     */
    public function setFormatMask(int $bitmask, string $formatMask)
    {
        $this->formatMasks[$bitmask] = $formatMask;
    }

}

?>
