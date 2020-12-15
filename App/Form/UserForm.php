<?php

namespace App\Form;

use Core\Controller\Controller;
use Core\Validator\AbstractForm;
use Core\Validator\StringValidator;

class UserForm extends AbstractForm{

    public function validate(){

        $this->checkPostKeys($this->formValues, ["username", "email", "password", "password-retype", "firstName", "lastName"]);

        $validatePseudo = new StringValidator($this->formValues['username']);
        $validatePseudo->checkLength(2, 50);

        $validateEmail = new StringValidator($this->formValues['email']);
        $validateEmail
            ->checkLength(10, 150)
            ->isEmail();

        $validatePassword = new StringValidator($this->formValues['password']);
        $validatePassword->checkLength(10, 150);

        $validateRetype = new StringValidator($this->formValues['password-retype']);
        $validateRetype->checkRetype($this->formValues['password']);

        $this->processValidatorErrors([$validatePseudo, $validateEmail, $validatePassword, $validateRetype]);
    }
}