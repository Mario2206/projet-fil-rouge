<?php 

namespace Core\Validator;

class NumberValidator extends AbstractValidator {

    public function isNumber () : self {
        if(!is_numeric($this->value)) {
            $this->errors[] = "$this->keyname n'est pas numérique";
        }
        return $this;
    }
}