<?php

namespace App\Http\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait UploadsImage
{
    public function upload(UploadedFile $file, string $path): string
    {
        return Storage::disk('public')->putFile($path, $file);
    }
}
