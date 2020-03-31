<?php

namespace Module\Validators;


use Module\Exceptions\ValidationException;

class Validator
{
    public $message;
    public $passed;

    public function failed($message) {
        $this->message = $message;
        throw new ValidationException(422, $this->message);
    }

    public function passes() {
        return $this->passed;
    }

    public function validate() {
        $this->passed = false;
        foreach (get_class_methods($this) as $method) {
            if (strpos($method, "validate") === 0 && $method != "validate") {
                call_user_func_array([$this, $method], []);
            }
        }
        $this->passed = true;
    }
}
