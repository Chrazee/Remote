<?php

namespace Module\Validators;

use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;

class StructureValidator extends Validator {

    public static function validateDirectory($directory = null) {
        $dir = ($directory !== null) ? $directory : self::$directory;

        $path = env('MODULE_DIRECTORY') . '/' . $dir;
        if(!Storage::disk('module')->exists($path)) {
            return self::return(false, Lang::get('common.module_directory_not_exists', ['name' => $dir]));
        }
        return true;
    }

    public static function validateView($inDirectory = null) {
        $path = env('MODULE_DIRECTORY') . '/' . self::$directory . '/' .  env('MODULE_VIEW') . env('MODULE_VIEW_EXTENSION');
        if($inDirectory !== null) {
            $path = env('MODULE_DIRECTORY') . '/' . $inDirectory . '/' .  env('MODULE_VIEW') . env('MODULE_VIEW_EXTENSION');
        }
        if(!Storage::disk('module')->exists($path)) {
            return self::return(false, Lang::get('common.view_file_not_exists'));
        }
        return true;
    }
}
