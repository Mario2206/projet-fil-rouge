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

    public function noEmptyValue() : self {
        $key = count($this->_value);

         array_walk_recursive($this->_value, function($val)  use ($key) {
             if(!$val) {
                $this->_errors[$key] = "Array is empty"; 
             }
        });

        return $this;
    }

}