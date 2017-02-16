<?php

namespace joeHickson\Mint;

class Mint
{

    /**
     * @var Currency
     */
    private $currency;

    public function __construct(string $currencyCode)
    {
        if (preg_match('/^[A-Z]{3}$/', $currencyCode) > 0) {
            if (file_exists(__DIR__.'/Data/'.$currencyCode.'.xml')) {
                $this->currency = CurrencyRepository::loadCurrency($currencyCode);
            } else {
                throw new \Exception ('Currency code not found');
            }
        } else {
            throw new \Exception ("A valid currency code must be specified - $currencyCode is invalid");
        }
    }

    /**
     * Get Denominations
     * Returns an array of the requested columns, keyed by denominationID and column name.
     * If a single column is requested the array will contain just the requested column
     *  [id] => [columnValue]
     * Otherwise it will contain an array of the requested columns
     *  [id] => [columnName] => [columnValue] 
     * 
     * Note the id is unique within currency only
     * 
     * @param array $columns - defined in Denominaton::$columns
     * @param bool $excludeUncommon - optionally include uncommon denominations
     * @param bool $inCirculation - optionally include withdrawn denominations
     * @return array
     */
    public function getDenominations(array $columns, bool $excludeUncommon = true, bool $inCirculation = true)
    {
        $output = ["notes" => [], "coins" => []];
        $denominations = $this->currency->getDenominations();
        
        foreach ($denominations as $id => $denomination) {
            if ($inCirculation XOR $denomination->isInCirculation()) {
                continue;
            }
            if ($excludeUncommon && $denomination->isUncommon()) {
                continue;
            }
            if (is_a($denomination, Coin::class)) {
                $output["coins"][$denomination->getId()] = DenominationRepository::output($denomination, $columns);
            } else {
                $output["notes"][$denomination->getId()] = DenominationRepository::output($denomination, $columns);
            }
        }
        return $output;
    }

    public function splitUnits(float $value): array
    {
    	$units = CurrencyRepository::splitUnits($value, $this->currency);
    	return $units;
    }
    
    public function formatDecimal(float $value, bool $excludeBlankMajor = false, bool $excludeBlankMinor = false): string
    {
    	$splitValue = $this->splitUnits($value);
    	$formattedString = CurrencyRepository::format($this->currency, $splitValue, $excludeBlankMajor, $excludeBlankMinor);
    	return $formattedString;
    }
    
    private function removeRedundant(Denomination $denomination)
    {
        return $denomination->getInCirculation();
    }

    private function removeUncommon(Denomination $denomination)
    {
        return !$denomination->getUncommon();
    }

}

?>
