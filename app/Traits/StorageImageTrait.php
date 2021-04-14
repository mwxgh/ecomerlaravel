<?php

namespace App\Traits;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
trait StorageImageTrait
{
    function storageTraitUpload($request,$fieldName,$folderName)
    {
        if ($request->hasFile($fieldName)) {
            $file = $request->$fieldName;
            $fileNameOrigin = $file->getClientOriginalName();
            $fileNameDB = Str::random(20).'.'.$file->getClientOriginalExtension();
            $filePath = $request->file($fieldName)->storeAs('public/'. $folderName . '/' . auth()->id(),$fileNameDB);
            $dataUploadTrait = [
                'file_name' => $fileNameOrigin,
                'file_path' => Storage::url($filePath)
            ];
            return $dataUploadTrait;
        }
        return null;
    }
    function storageTraitUploadMulti($file,$folderName)
    {
            $fileNameOrigin = $file->getClientOriginalName();
            $fileNameDB = Str::random(20).'.'.$file->getClientOriginalExtension();
            $filePath = $file->storeAs('public/'. $folderName . '/' . auth()->id(),$fileNameDB);
            $dataUploadTrait = [
                'file_name' => $fileNameOrigin,
                'file_path' => Storage::url($filePath)
            ];
            return $dataUploadTrait;
    }
}

?>
