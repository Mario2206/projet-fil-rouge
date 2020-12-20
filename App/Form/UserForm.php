<?php

namespace App\Form;

use Core\Controller\Controller;
use Core\Validator\AbstractForm;
use Core\Validator\StringValidator;

class UserForm extends AbstractForm{

    public function validate(){

        $this->checkPostKeys($this->formKeys, ["username", "email", "password", "password_retype", "firstname", "lastname"]);

        $validatePseudo = new StringValidator($this->formValues['username'], "Pseudo");
        $validatePseudo->checkLength(2, 50);

        $validateEmail = new StringValidator($this->formValues['email'], "Mail");
        $validateEmail
            ->checkLength(10, 150, "e-mail")
            ->isEmail();

        $validatePassword = new StringValidator($this->formValues['password'], "Mot de passe");
        $validatePassword->checkLength(10, 150, "mot de passe");

        $validateRetype = new StringValidator($this->formValues['password_retype'], "Confirmation du mot de passe");
        $validateRetype->checkRetype($this->formValues['password']);

        $this->processValidatorErrors([$validatePseudo, $validateEmail, $validatePassword, $validateRetype]);
    }
}