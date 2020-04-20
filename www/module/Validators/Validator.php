<?php

namespace Module\Validators;

class Validator
{
    protected static $directory;
    protected static $messages;

    public static function return($status, $message = null) {
        return self::$messages[] = [
            'status' => $status,
            'message' => $message
        ];
    }

    public static function validate($inDirectory, $stopOnFirstError = false) {
        self::$directory = $inDirectory;
        $stop = false;

        foreach (get_class_methods(get_called_class()) as $method) {
            if (strpos($method, "validate") === 0 && $method != "validate" && $stop === false) {
                if($stopOnFirstError) {
                    $returnValue = call_user_func_array([get_called_class(), $method], []);
                    if($returnValue !== true) {
                        $stop = true;
                    }
                } else {
                    call_user_func_array([get_called_class(), $method], []);
                }
            }
        }

        return (empty(self::$messages));
    }

    public static function getMessages() {
        return self::$messages;
    }
}
