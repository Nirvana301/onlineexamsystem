<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use League\Flysystem\Util;

/**
 * Class UploadController
 * @package App\Http\Controllers
 */
class UploadController extends Controller
{
    /**
     * @param Request $request
     * @param Exam $exam
     * @return \Illuminate\Http\RedirectResponse
     */
    public function upload(Request $request, Exam $exam)
    {

        $this->validate($request,['doc'=>'required']);
        $extension = Str::after($request->file('doc')->getClientOriginalName(), '.');

        $fileName = Util::normalizePath(trim($exam->name) . 'Solution' . trim(str_replace([':', '-', ' '], '', Carbon::now()->toDateTimeString())) . '.' . $extension);

        $path = $request->file('doc')->storeAs('solutions', $fileName);

        File::create([
            'path' => $path,
            'file_name' => $fileName,
            'uploaded_by' => auth()->user()->id,
            'exam_id' => $exam->id
        ]);

        return redirect()->back();
    }

    public function delete(Request $request, Exam $exam)
    {
        $file = File::find($request->post('file'));

        Storage::delete($file->path);

        $file->delete();

        return redirect()->back();
    }

    public function download(File $file)
    {
        return Storage::download($file->path, $file->exam()->first()->name . ' Answers' . '.' . Str::after($file->file_name, '.'));
    }
}
