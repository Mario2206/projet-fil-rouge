<?php 

namespace Core\Validator;

class StringValidator {

    private $value = "";

    private $error = [];

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function getErrors(){
        return $this->error;
    }


    public function isEmail()
    {
        if(!filter_var($this->value, FILTER_VALIDATE_EMAIL)){
            $this->error[] = "L'email n'est pas correctement formaté";
        }
        return $this;
    }

    public function checkLength(int $min, int $max, string $keyname){
        $length = strlen($this->value); 
        if($length < $min || $length > $max){
            $this->error[] = "$keyname doit être compris entre $min et $max caractères";
        }
        return $this;
    }

    public function checkRetype(string $passwordRetype){
        if($this->value != $passwordRetype){
            $this->error[] = "Les deux mots de passes ne correspondent pas";
        }
        return $this;
    }

    public function checkPassword(string $password){
        if(!password_verify($this->value, $password)){
            $this->error[] = "Le mot de passe est incorrect";
        }
        return $this;
    }
}