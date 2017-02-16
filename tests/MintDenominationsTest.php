<?php
use joeHickson\Mint\Mint;

class MintDenominationsTest extends PHPUnit_Framework_TestCase
{
	public function dataProvider(){
		return [
				[5.1125, true, true, '£5.2s.3d'],
				[0.1125, true, true, '2s/3d'],
				[0.1125, false, true, '£0.2s.3d'],
				[0.1, true, true, '2s'], // [0,2,0] (010)
				[0.1, false, false, '£0.2s.0d'], // (111)
				[0.1, false, true, '£0.2s'], // (011)
				[0.1, true, false, '2s/0d'],  // (110)
				[0, false, false, '£0.0s.0d'],
				[0, true, true, '£0.0s.0d'],
		];
	}
	
	/**
	 * @dataProvider dataProvider
	 */
    public function testFormatter($value, $leading, $trailing, $outcome)
    {
        $mint = new Mint('LSD');
        $output = $mint->formatDecimal($value, $leading, $trailing);
       	$this->assertEquals($outcome, $output);
       	echo "'$value' = $output \r\n";
    }
    public function testUnits()
    {
        $mint = new Mint('GBP');
        $denominations = $mint->getDenominations(['label']);
        var_dump($denominations);
    }
}
