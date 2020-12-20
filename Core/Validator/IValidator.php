<?php

namespace Core\Validator;

interface IValidator {
    public function getValue() ;
    public function getErrors() : array;
}