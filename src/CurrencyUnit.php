<?php

namespace joeHickson\Mint;

class CurrencyUnit
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $symbol;
    /**
     * @var string
     */
    private $formatMask;
    /**
     * @var int
     */
    private $absoluteValue;
    /**
     * @var int
     */
    private $quantityToNextUnit;
    /**
     * @var Currency
     */
    private $currency;


    public function setDenominations(DenominationCollection $denominationCollection)
    {
        $this->denominations = $denominationCollection;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getFormatMask(): string
    {
        return $this->formatMask;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getSymbol(): string
    {
        return $this->symbol;
    }

    public function setSymbol(string $symbol)
    {
        $this->symbol = $symbol;
    }

    public function getAbsoluteValue(): int
    {
        return $this->absoluteValue;
    }

    public function setAbsoluteValue(int $absoluteValue)
    {
        $this->absoluteValue = $absoluteValue;
    }

    /**
     * @return int|null
     */
    public function getQuantityToNextUnit()
    {
        return $this->quantityToNextUnit;
    }

    /**
     * @param int|null $quantityToNextUnit
     */
    public function setQuantityToNextUnit($quantityToNextUnit)
    {
        $this->quantityToNextUnit = $quantityToNextUnit;
    }


    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    public function setCurrency(Currency $currency)
    {
        $this->currency = $currency;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @param string $formatMask
     */
    public function setFormatMask(string $formatMask)
    {
        $this->formatMask = $formatMask;
    }

}

?>
