# Mint

**Coinage and currency subdivision library**

All functions are accessed via the main Mint class which must be initiated with an ISO currency code.

## Functions

### Get Denominations

```PHP
$currencyCode = 'LSD'; //Pounds, Shilling, Pence
$columns = ['label'];
$mint = new Mint($currencyCode);
$denominations = $mint->getDenominations($columns[, $excludeUncommon = true [, $inCirculation = true;]]);
```
Returns an array keyed by denominationID of the requested columns. $excludeUncommon and $inCirculation can be used to filter returned denominations.
Available columns are:

* *id* (int) Currency unique ID for the denomination. Also returned as the key. |
* *value* (float) Financial value of denomination |
* *quantity* (float) Number of units represented by coin e.g. 50¢ coing = 50. $1 = 1. |
* *inCirculation* (bool) Identifies if coin is in circulation. Used for depreciating currency. |
* *uncommon* (bool) Identifies rarely used denomination. |
* *label* (string) Representation of the name of the denomination e.g. ('50¢', '$1') |

### Format Currency - TODO

```PHP
$currencyCode = 'LSD'; //Pounds, Shilling, Pence
$mint = new Mint($currencyCode);
$value = $mint->formatValue(5.1125, $leadingUnit = true, $trailingUnit = true); // £5.2s.3d
``` 
Returns a formatted string representation. $leadingUnit can be used to suppress leading 0 value e.g.

* $currencyCode = 'USD'
* formatValue(0.5, false) = 50¢
* formatValue(0.5, true) = $0.50

Similarly $trailingUnit can be used to trim stray values e.g.
* $currencyCode = 'USD'
* formatValue(25, false, false) = $25 // this simplifies any value to its shortest representation
* $currencyCode = 'LSD'
* formatValue(0.4, true, false) =  8s // this only really applies to multi-part currencies - 0.4 could be rendered £0.8s.0d or 8s/0d or 8s depending on leading / trailing exclusions

### Decimalise - TODO

```PHP
$currencyCode = 'LSD'; //Pounds, Shilling, Pence
$mint = new Mint($currencyCode);
$value = $mint->decimalise([[0]=>5,[1]=>2,[2]=>3]); // 5.1125
```
Takes an array and converts it into the decimal equivalent.

### Split Units - TODO

```PHP
$currencyCode = 'LSD'; //Pounds, Shilling, Pence
$mint = new Mint($currencyCode);
$value = $mint->splitUnits(5.1125); // [[0]=>5,[1]=>2,[2]=>3]
``` 
Takes a decimal value and splits it into unit components

## Current supported currencies

* GBP - Pounds Sterling
* LSD - Historic pre-decimal Pounds Sterling. Used for testing