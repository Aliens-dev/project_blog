<?php


namespace app;


class Validator
{
    public $value;
    public $key;
    private $valid = true;
    private $invalid_messages = [];

    public function __construct($key,$value)
    {
        $this->key = $key;
        $this->value = $value;
    }

    private function invalidate($msg) {
        $this->invalid_messages [] = $msg;
        if($this->valid) {
            $this->valid = false;
        }
    }

    public function required() {
        if(strlen($this->value) == 0) {
            $this->invalidate("{$this->key} is Required!");
        }
        return $this;
    }
    public function email() {
        $email = "/^[a-zA-Z0-9\-\_\.]+@[a-zA-Z0-9]+.[a-zA-Z]{2,5}$/";
        if(! preg_match($email,$this->value)) {
            $this->invalidate("invalid Email");
        }
        return $this;
    }

    public function max($length)
    {
        if(strlen($this->value) > $length) {
            $this->invalidate("{$this->key} exceeded max length");
        }
        return $this;
    }
    public function min($length)
    {
        if(strlen($this->value) < $length) {
            $this->invalidate("{$this->key} is too short");
        }
        return $this;
    }

    public function isValid() {
        return $this->valid;
    }

    public function getErrors()
    {
        return $this->invalid_messages;
    }
}