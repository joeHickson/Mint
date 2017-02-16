<?php

namespace joeHickson\Mint;

abstract class GenericCollection  implements \ArrayAccess, \IteratorAggregate
{

    protected $array;

    public function __construct(){
    	$offset=0;
    	$array = [];
    }
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->array[] = $value;
        } else {
            $this->array[$offset] = $value;
        }
    }

    public function offsetExists($offset)
    {
        return isset($this->array[$offset]);
    }

    public function offsetUnset($offset)
    {
        unset($this->array[$offset]);
    }

    public function offsetGet($offset)
    {
        return isset($this->array[$offset]) ? $this->array[$offset] : null;
    } 
    
    public function getIterator()
    {
    	return new \ArrayIterator($this->array);
    }
}
