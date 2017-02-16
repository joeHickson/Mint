<?php

namespace joeHickson\Mint;

interface DenominationInterface
{
    public function getAbsoluteValue();

    public function getQuantity();

    public function isInCirculation();

    public function isUncommon();

    public function getValue();

    public function getId();

    public function setId(int $id);

    public function getUnitId();

    public function setUnitId(int $id);

    public function getCurrency();

    public function setCurrency(Currency $currency);
}

?>
