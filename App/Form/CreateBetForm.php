<?php

namespace App\Form;

use Core\Validator\ArrayValidator;
use Core\Validator\AbstractForm;
use Core\Validator\NumberValidator;
use Core\Validator\StringValidator;

class CreateBetForm extends AbstractForm {

    public function validate () {
        
        //TODO : DATE VALIDATION

        $this->checkPostKeys($this->formKeys, ["bet_name", "bet_description", "bet_questions", "bet_responses", "bet_available", "bet_unavailable", "bet_category"]);

        if(count($this->formValues["bet_responses"]) !== count($this->formValues["bet_questions"])) {
            throw new \Exception("It must have bet questions as much as bet responses group");
        }

        $betNameValidation = new StringValidator($this->formValues["bet_name"], "Nom");
        $betNameValidation->checkLength(2, 30, "Nom");

        $betDescValidation = new StringValidator($this->formValues["bet_description"], "Description");
        $betDescValidation->checkLength(5, 100, "Description");

        $betQuestionsValidation = new ArrayValidator($this->formValues["bet_questions"], "Questions");
        $betQuestionsValidation->noEmptyValue("Questions");
        

        $betResponseValidation = new ArrayValidator($this->formValues["bet_responses"], "Réponses");
        $betResponseValidation->noEmptyValue();

        $categoryValidation = new NumberValidator($this->formValues["bet_category"], "Catégorie");
        $categoryValidation->isNumber();

        
        $this->processValidatorErrors([$betDescValidation,$betQuestionsValidation, $betResponseValidation, $categoryValidation]);
    }

}