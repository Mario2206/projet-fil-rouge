<?php

namespace App\Form;

use Core\Validator\ArrayValidator;
use Core\Validator\AbstractForm;
use Core\Validator\StringValidator;

class PollForm extends AbstractForm {

    public function validate () {
        
        //TODO : DATE VALIDATION

        $this->checkPostKeys($this->formValues, ["poll_name", "poll_description", "poll_questions", "poll_responses", "poll_available", "poll_unavailable"]);

        if(count($this->formValues["poll_responses"]) !== count($this->formValues["poll_questions"])) {
            throw new \Exception("It must have poll questions as much as poll responses group");
        }

        $pollNameValidation = new StringValidator($this->formValues["poll_name"]);
        $pollNameValidation->checkLength(2, 30);

        $pollDescValidation = new StringValidator($this->formValues["poll_description"]);
        $pollDescValidation->checkLength(5, 100);

        $pollQuestionsValidation = new ArrayValidator($this->formValues["poll_questions"]);
        $pollQuestionsValidation->noEmptyValue();
        

        $pollResponseValidation = new ArrayValidator($this->formValues["poll_responses"]);
        $pollResponseValidation->noEmptyValue();
        
        $this->processValidatorErrors([$pollDescValidation,$pollQuestionsValidation, $pollResponseValidation]);
    }

}