<?php 

namespace App\Form;

use Core\Validator\AbstractForm;
use Core\Validator\StringValidator;

class MessagesForm extends AbstractForm {


    public function validate() {

        $this->checkPostKeys($this->formValues,["poll-message"]);

        $messageValidation = new StringValidator($this->formValues["poll-message"]);
        $messageValidation->checkLength(1, 100);

        $this->processValidatorErrors([$messageValidation]);


    }


}