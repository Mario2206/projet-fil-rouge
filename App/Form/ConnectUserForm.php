<?php 

namespace App\Form;

use Core\Validator\AbstractForm;

class ConnectUserForm extends AbstractForm {

    public function validate() {
        $this->checkPostKeys($this->formKeys, ["username", "password"]);
    }
}