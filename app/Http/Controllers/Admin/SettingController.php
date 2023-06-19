<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Settings\GeneralSettings;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class SettingController extends Controller
{
    public function index()
    {
        $general_settings = resolve(GeneralSettings::class);

        return view('admin.setting.index', compact('general_settings'));
    }

    public function store(Request $request)
    {
        $general_settings = resolve(GeneralSettings::class);
        $data = [];

        $request->validate([
            'name' => ['required', Rule::in($this->filled_values())],
        ]);

        if ($request->name == 'background_type') {
            $request->validate([
                'value' => 'required|in:gambar,warna',
            ]);

            $data['background_type'] = $request->value;
        } else if ($request->name == 'background_app' && $general_settings->background_type == 'gambar') {
            $request->validate([
                'value' => 'required|file|image',
            ]);

            $data['background_app'] = $this->file_upload($request->value);
        } else if ($request->name == 'logo_app') {
            $request->validate([
                'value' => 'required|file|image',
            ]);

            $data['logo_app'] = $this->file_upload($request->value);
        } else {
            $data[$request->name] = $request->value;
        }

        $general_settings->fill($data)->save();

        return back()->with('status', 'Berhasil update pengaturan');
    }

    private function filled_values()
    {
        return [
            'background_type', 'background_app', 'logo_app',
        ];
    }

    private function file_upload(UploadedFile $file)
    {
        return Storage::disk('public')->url($file->storeAs(
            implode('/', [
                'setting',
                'app',
            ]),
            'background.' . $file->getClientOriginalExtension(),
            'public',
        ));
    }
}
