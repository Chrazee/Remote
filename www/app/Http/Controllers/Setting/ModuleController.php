<?php

namespace App\Http\Controllers\Setting;

use App\Device;
use App\Http\Requests\Module\Create;
use App\Http\Requests\Module\Delete;
use App\Http\Requests\Module\Update;
use App\Module;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Validator;

class ModuleController extends Controller
{
    private $title;
    public function __construct() {
        $this->title = [
            [
                'name' => Lang::get('common.settings'),
                'link' => route('settings')
            ],
            [
                'name' => Lang::get('common.modules'),
                'link' => route('settings.modules')
            ]
        ];
    }

    function index()
    {
        $userId = Auth::user()->id;
        $modules = Module::where('user_id', $userId)->orderBy('updated_at', 'desc')->get();

        return view('setting.module.index', [
            'title' => $this->title,
            'modules' => $modules,
        ]);
    }

    function show($id)
    {
        $userId = Auth::user()->id;
        $module = Module::where('user_id',$userId)->findOrFail($id);

        $this->title[] = [
            'name' => $module->name,
        ];

        return view('setting.module.show', [
            'title' => $this->title,
            'module' => $module,
        ]);
    }

    function add()
    {
        $this->title[] = [
            'name' => Lang::get('common.create_new'),
        ];

        return view('setting.module.add', [
            'title' => $this->title,
        ]);
    }

    function create(Create $request) {
        $validated = $request->validated();
        $directory = Str::random(16);
        $directoryPath = env('MODULE_DIRECTORY') . '/' . $directory;

        Storage::disk('module')->makeDirectory($directoryPath);
        Storage::disk('module')->putFileAs($directoryPath, $request->file('view_file'), env('MODULE_VIEW') . env('MODULE_VIEW_EXTENSION'));

        Module::create([
            'user_id' => $validated['user_id'],
            'name' => $validated['name'],
            'description' => $validated['description'],
            'directory' => $directory,
        ]);

        return response()->json(['message' => [Lang::get('response.module_create')]]);
    }

    function update(Update $request, $id) {
        $validated = $request->validated();
        $module = Module::findOrFail($id);

        if($request->file('view_file')) {
            // delete all file in the directory
            $files =  Storage::disk('module')->allFiles(env('MODULE_DIRECTORY') . '/' . $module->directory);
            Storage::disk('module')->delete($files);
            // upload new file
            $directoryPath = env('MODULE_DIRECTORY') . '/' . $module->directory;
            Storage::disk('module')->putFileAs($directoryPath, $request->file('view_file'), env('MODULE_VIEW') . env('MODULE_VIEW_EXTENSION'));
        }

        $module->update($validated);

        return response()->json(['message' => [Lang::get('response.module_update')]]);
    }

    function delete(Delete $request, $id) {
        $validated = $request->validated();

        $module = Module::findOrFail($id);
        $directory =  env('MODULE_DIRECTORY') . '/' . $module->directory;
        Storage::disk('module')->deleteDirectory($directory);

        $module->delete();

        return response()->json(['message' => [Lang::get('response.module_delete')]]);
    }
}
