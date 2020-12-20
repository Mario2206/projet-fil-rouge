<?php 

namespace Core\Validator;



class ArrayValidator extends AbstractValidator{


    public function noEmptyValue() : self {
        $key = count($this->value);

         array_walk_recursive($this->value, function($val)  use ($key) {
             if(!$val) {
                $this->errors[$key] = "$this->keyname n'ont pas de valeurs"; 
             }
        });

        return $this;
    }

}