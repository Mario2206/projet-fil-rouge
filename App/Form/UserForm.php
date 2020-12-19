<?php

namespace App\Form;

use Core\Controller\Controller;
use Core\Validator\AbstractForm;
use Core\Validator\StringValidator;

class UserForm extends AbstractForm{

    public function validate(){

        $this->checkPostKeys($this->formKeys, ["username", "email", "password", "password_retype", "firstname", "lastname"]);

        $validatePseudo = new StringValidator($this->formValues['username']);
        $validatePseudo->checkLength(2, 50, "pseudo");

        $validateEmail = new StringValidator($this->formValues['email']);
        $validateEmail
            ->checkLength(10, 150, "e-mail")
            ->isEmail();

        $validatePassword = new StringValidator($this->formValues['password']);
        $validatePassword->checkLength(10, 150, "mot de passe");

        $validateRetype = new StringValidator($this->formValues['password_retype']);
        $validateRetype->checkRetype($this->formValues['password']);

        $this->processValidatorErrors([$validatePseudo, $validateEmail, $validatePassword, $validateRetype]);
    }
}