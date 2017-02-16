<?php

namespace joeHickson\Mint;

class CurrencyUnitRepository
{
    public static function formatUnit(CurrencyUnit $unit, $quantity)
    {
        return sprintf($unit->getFormatMask());
    }
}
