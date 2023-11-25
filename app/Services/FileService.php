<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class FileService
{
    public function saveFile(UploadedFile $file, $disk = 'comprobante_disk')
    {
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('', $filename, $disk);

        return $path;
    }

    public function deleteFile($path, $disk = 'comprobante_disk')
    {
        if (Storage::disk($disk)->exists($path)) {
            Storage::disk($disk)->delete($path);
            return true;
        }
        return false;
    }

    public function getFileUrl($path, $disk = 'comprobante_disk')
    {
        if (Storage::disk($disk)->exists($path)) {
            return Storage::disk($disk)->url($path);
        }
        return null;
    }
}
