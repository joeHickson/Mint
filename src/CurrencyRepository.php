<?php

namespace joeHickson\Mint;

class CurrencyRepository
{
    public static function loadCurrency(string $currencyCode): Currency
    {
        $currencyXML = new \SimpleXMLElement (file_get_contents(__DIR__.'/Data/'.$currencyCode.'.xml', true), true);

        $currency = new Currency ();
        $currency->setCurrencyCode((string) $currencyXML->currencyID);
        $currency->setFullName((string) $currencyXML->fullName);
        $currency->setDecimal((int) $currencyXML->decimal);
        // lalit xml to array lib
        foreach ($currencyXML->formats->format->formatMask as $formatXML) {
            $bitwiseMask = bindec((string) $formatXML['unitMask']);
            $currency->setFormatMask($bitwiseMask, (string) $formatXML);
        }
        $unitCollection = new CurrencyUnitCollection ();
        foreach ($currencyXML->units->unit as $unitXML) {
            $unit = new CurrencyUnit ();
            $unit->setName((string) $unitXML->name);
            $unit->setId((int) $unitXML->id);
            $unit->setSymbol((string) $unitXML->symbol);
            $unit->setFormatMask((string) $unitXML->formatMask);
            $unit->setAbsoluteValue((int) $unitXML->absoluteValue);
            $unit->setQuantityToNextUnit((int) $unitXML->quantityToNextUnit);
            $unit->setCurrency($currency);
            $unitCollection [$unit->getID()] = $unit;
        }
        $currency->setUnits($unitCollection);

        $denominationCollection = new DenominationCollection ();
        foreach ($currencyXML->denominations->denomination as $denominationXML) {
            if ((string) $denominationXML->coin === 'true') {
                $denomination = new Coin ();
            } else {
                $denomination = new Note ();
            }
            $denomination->setId((int) $denominationXML->id);
            $denomination->setUnitId((int) $denominationXML->unit);
            $denomination->setQuantity((float) $denominationXML->quantity);
            $denomination->setAbsoluteValue((int) $denominationXML->absoluteValue);
            if ((string) $denominationXML->inCirculation === 'true') {
                $denomination->setInCirculation(true);
            } else {
                $denomination->setInCirculation(false);
            }
            if ((string) $denominationXML->uncommon === 'true') {
                $denomination->setUncommon(true);
            } else {
                $denomination->setUncommon(false);
            }
            $denomination->setCurrency($currency);
            $denominationCollection [$denomination->getID()] = $denomination;
        }
        $currency->setDenominations($denominationCollection);

        return $currency;
    }

    public static function splitUnits(float $value, Currency $currency): array
    {
        $absValue = (int) round($value * 10000, 0);
        $units = $currency->getUnits();
        $runningTotal = $absValue;
        $output = [];
        /**
         * @var CurrencyUnit $unit
         */
        foreach ($units as $unitId => $unit) {
            $remainder = $runningTotal % $unit->getAbsoluteValue();
            $output[$unitId] = (int) floor($runningTotal / $unit->getAbsoluteValue());
            $runningTotal = $remainder;
        }

        return $output;
    }

    public static function format(Currency $currency, array $units, bool $excludeLeading, bool $excludeTrailing)
    {
        $bitMask = 0;
        $blank = true;
        for ($i = 1; $i <= count($units); $i++) {
            if ($units[$i] === 0) {
                $a = ($excludeLeading && $blank);
                $b = ($excludeTrailing && !$blank);
                if (!($a || $b)) {
                    $bitMask += 2 ** ($i - 1);
                }
            } else {
                $blank = false;
                $x = 2 ** ($i - 1);
                $bitMask += $x;
            }
        }
        $output = vsprintf($currency->getFormatMask($bitMask), $units);

        return $output;
    }
}

?>
