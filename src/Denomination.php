<?php

namespace joeHickson\Mint;

abstract class Denomination
{
    public static $columns = ['id', 'value', 'quantity', 'inCirculation', 'uncommon', 'label'];
    /**
     * @var int
     */
    private $id;
    /**
     * @var int
     */
    private $unitId;
    /**
     * @var int
     */
    private $absoluteValue;
    /**
     * @var float
     */
    private $quantity;
    /**
     * @var bool
     */
    private $inCirculation;
    /**
     * @var bool
     */
    private $uncommon;
    /**
     * @var Currency
     */
    private $currency;


    public function getAbsoluteValue(): int
    {
        return $this->absoluteValue;
    }

    public function getQuantity(): float
    {
        return $this->quantity;
    }

    public function isInCirculation(): bool
    {
        return $this->inCirculation;
    }

    public function isUncommon(): bool
    {
        return $this->uncommon;
    }

    public function getValue(): float
    {
        return $this->getAbsoluteValue() / 10000;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getUnitId(): int
    {
        return $this->unitId;
    }

    public function setUnitId(int $id)
    {
        $this->unitId = $id;
    }

    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    public function setCurrency(Currency $currency)
    {
        $this->currency = $currency;
    }

    public function setAbsoluteValue(int $absoluteValue)
    {
        $this->absoluteValue = $absoluteValue;
    }

    public function setQuantity(float $quantity)
    {
        $this->quantity = $quantity;
    }

    public function setInCirculation(bool $inCirculation)
    {
        $this->inCirculation = $inCirculation;
    }

    public function setUncommon(bool $uncommon)
    {
        $this->uncommon = $uncommon;
    }

    public function getLabel(): string
    { // TODO: consider storing the unit value in pre-split form
    	return CurrencyRepository::format($this->currency, CurrencyRepository::splitUnits($this->absoluteValue/10000, $this->currency), true, true);
    }
}

?>
