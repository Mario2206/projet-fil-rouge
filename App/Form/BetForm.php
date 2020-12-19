<?php

namespace App\Form;

use Core\Validator\ArrayValidator;
use Core\Validator\AbstractForm;
use Core\Validator\StringValidator;

class BetForm extends AbstractForm {

    public function validate () {
        
        //TODO : DATE VALIDATION

        $this->checkPostKeys($this->formValues, ["bet_name", "bet_description", "bet_questions", "bet_responses", "bet_available", "bet_unavailable"]);

        if(count($this->formValues["bet_responses"]) !== count($this->formValues["bet_questions"])) {
            throw new \Exception("It must have bet questions as much as bet responses group");
        }

        $betNameValidation = new StringValidator($this->formValues["bet_name"]);
        $betNameValidation->checkLength(2, 30, "Nom");

        $betDescValidation = new StringValidator($this->formValues["bet_description"]);
        $betDescValidation->checkLength(5, 100, "Description");

        $betQuestionsValidation = new ArrayValidator($this->formValues["bet_questions"]);
        $betQuestionsValidation->noEmptyValue("Questions");
        

        $betResponseValidation = new ArrayValidator($this->formValues["bet_responses"]);
        $betResponseValidation->noEmptyValue("Réponses");
        
        $this->processValidatorErrors([$betDescValidation,$betQuestionsValidation, $betResponseValidation]);
    }

}