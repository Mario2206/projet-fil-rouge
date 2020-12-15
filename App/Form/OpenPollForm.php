<?php 

namespace App\Form;

use Core\Validator\AbstractForm;

class OpenPollForm extends AbstractForm {

    public function validate() {

        $this->checkPostKeys($this->formValues, ["availableAt", "unAvailableAt"]);

        //TODO : DATE VALIDATOR


    }

}