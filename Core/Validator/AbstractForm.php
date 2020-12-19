<?php 

namespace Core\Validator;

abstract class AbstractForm {

    protected $formValues = [];

    protected $formKeys = [];

    protected $errors = [];

    public function __construct(array $post)
    {
        $this->formValues = $post;
        $this->formKeys = array_keys($post);
    }

    /*
     * @param $post : array
     * @param $requiredKeys : array
     *
     * return boolean
     * */
    protected function checkPostKeys(array $postKeys, array $requiredKeys) : void {
        $diff = array_diff($requiredKeys, $postKeys);
        if(count($diff) !== 0) {
            
            throw new \Exception("Post keys are missing : the body request should contain the following keys :" . implode(", " , $requiredKeys) . " but it  contains : " . implode(", ", $postKeys) , HTTP_BAD_REQ);
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