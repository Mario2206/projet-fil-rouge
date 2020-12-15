<?php 

namespace Core\Validator;

abstract class AbstractForm {

    protected $formValues = [];

    protected $errors = [];

    public function __construct(array $formValues)
    {
        $this->formValues = $formValues;
    }

    /*
     * @param $post : array
     * @param $requiredKeys : array
     *
     * return boolean
     * */
    protected function checkPostKeys(array $post, array $requiredKeys) : void {
        $postKeys = array_keys($post);
        $diff = array_diff($requiredKeys, $postKeys);
        if(count($diff) !== 0) {
            throw new \Exception("Post keys are missing", 400);
        }
    }

    /**
     * For grouping all errors from validators into only one error property (in Form)
     * 
     * @param array<Validator> $validators
     * 
     */
    public function processValidatorErrors(array $validators) {

        $errors = array_map(function ($validator) {
            return $validator->getErrors();
        }, $validators);

        $this->errors = array_merge(...$errors);    
    }
    
    public function getErrors() : array {
        return $this->errors;
    }

}