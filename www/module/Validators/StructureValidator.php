<?php

namespace Module\Validators;

use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;

class StructureValidator extends Validator {

    private $directoryName;

    public function __construct($directoryName)
    {
        $this->directoryName = $directoryName;
        $this->validate();
    }

    protected function validateDirectory() {
        $path = env('MODULE_DIRECTORY') . '/' . $this->directoryName;
        if(!Storage::disk('module')->exists($path)) {
            $this->failed(Lang::get('common.module_directory_not_exists', ['name' => $this->directoryName]));
        }
        return true;
    }

    protected function validateView() {
        $path = env('MODULE_DIRECTORY') . '/' . $this->directoryName . '/' .  env('MODULE_VIEW') . env('MODULE_VIEW_EXTENSION');
        if(!Storage::disk('module')->exists($path)) {
            $this->failed(Lang::get('common.view_file_not_exists'));
        }
        return true;
    }
}
