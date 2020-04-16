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

    protected function validateDirectory() {
        if(!Storage::disk('module')->exists($this->directoryName)) {
            $this->failed("The Module directory ({$this->directoryName}) does not exists.");
        }
        return true;
    }

    protected function validateView() {
        $path = $this->directoryName . "/" . env('MODULE_VIEW') . env('MODULE_VIEW_EXTENSION');
        if(!Storage::disk('module')->exists($path)) {
            $this->failed('The View file does not exists.');
        }
        return true;
    }
}
