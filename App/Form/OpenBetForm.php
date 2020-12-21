<?php 

namespace App\Form;

use Core\Validator\AbstractForm;

class OpenBetForm extends AbstractForm {

    public function validate() {

        $this->checkPostKeys($this->formKeys, ["availableAt", "unAvailableAt"]);

        //TODO : DATE VALIDATOR


    }

}