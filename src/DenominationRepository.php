<?php

namespace joeHickson\Mint;


class DenominationRepository
{
    public static function output(Denomination $denomination, array $columns)
    {
    	assert(
    			'count(array_intersect($columns, joeHickson\Mint\Denomination::$columns))==count($columns)',
    			"validate requested params");
        if (count($columns) == 1) {
            $field = "get".ucfirst($columns[0]);

            return $denomination->{$field}();
        } elseif (count($columns) > 1) {
            $output = [];
            foreach ($columns as $col) {
                $field = "get".ucfirst($col);
                $output[$col] = $denomination->{$field}();
            }

            return $output;
        } else {
            throw new \Exception('Invalid columns specified. ');
        }
    }

}

?>
