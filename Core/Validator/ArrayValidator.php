<?php 

namespace Core\Validator;

class ArrayValidator {

    private  $_value = [];

    private $_errors = [];

    public function __construct(array $value )
    {
        $this->_value = $value;
    }

    public function getValues() : array {
        return $this->_value;
    }

    public function getErrors () : array {
        return $this->_errors;
    }

    public function noEmptyValue(string $keyname) : self {
        $key = count($this->_value);

         array_walk_recursive($this->_value, function($val)  use ($key, $keyname) {
             if(!$val) {
                $this->_errors[$key] = "$keyname n'ont pas de valeurs"; 
             }
        });

        return $this;
    }

}