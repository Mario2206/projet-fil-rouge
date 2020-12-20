<?php 

namespace Core\Validator;

class StringValidator extends AbstractValidator {


    public function isEmail()
    {
        if(!filter_var($this->value, FILTER_VALIDATE_EMAIL)){
            $this->errors[] = "L'email n'est pas correctement formaté";
        }
        return $this;
    }

    public function checkLength(int $min, int $max){
        $length = strlen($this->value); 
        if($length < $min || $length > $max){
            $this->errors[] = "$this->keyname doit être compris entre $min et $max caractères";
        }
        return $this;
    }

    public function checkRetype(string $passwordRetype){
        if($this->value != $passwordRetype){
            $this->errors[] = "Les deux mots de passes ne correspondent pas";
        }
        return $this;
    }

    public function checkPassword(string $password){
        if(!password_verify($this->value, $password)){
            $this->errors[] = "Le mot de passe est incorrect";
        }
        return $this;
    }
}