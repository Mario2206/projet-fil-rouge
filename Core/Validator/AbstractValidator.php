<?php

namespace Core\Validator;

class AbstractValidator implements IValidator {

    protected $errors = [];

    protected $value;

    protected $keyname = "";

    public function __construct($value, string $keyname)
    {
        $this->value = $value;
        $this->keyname = $keyname;
    }

    public function getValue() {
        return $this->value;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}