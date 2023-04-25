<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\MediaFile;

class MediaFileController extends Controller
{
    public function store(Request $request){
        $mediaFile = new MediaFile();
        $mediaFile->path = \Storage::disk('mediafiles_storage')->putFile(date("Ym"), $request->file('mediafile'));
        $mediaFile->url = \Storage::disk('mediafiles_storage')->url($mediaFile->path);
        $mediaFile->save();
        $mediaFile->refresh();
        return $mediaFile;
    }

    public function show($id){
        if(!$mediaFile = MediaFile::find($id)){abort(404);};
        return $mediaFile;
    }

}
