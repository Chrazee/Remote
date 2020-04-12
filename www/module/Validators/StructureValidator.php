<?php

namespace Module\Validators;

use Illuminate\Support\Facades\Storage;

class StructureValidator extends Validator {

    private $directoryName;

    public function __construct($directoryName)
    {
        $this->directoryName = $directoryName;
        $this->validate();
    }

    protected function validateController() {
        if(!Storage::disk('module')->exists($this->directoryName . "/Controller/SettingController.php")) {
            $this->failed('The Controller file does not exists.');
        }
        return true;
    }

    protected function validateView() {
        if(!Storage::disk('module')->exists($this->directoryName . "/View/View.blade.php")) {
            $this->failed('The View file does not exists.');
        }
        return true;
    }
}
