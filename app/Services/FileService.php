<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileService
{
    public function saveFile(UploadedFile $file, $userId, $subfolder = null, $disk = 'comprobante_disk')
    {
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $this->buildPath($userId, $subfolder, $filename);
        $file->storeAs('', $path, $disk);
        return $path;
    }

    public function deleteFile($path, $disk = 'comprobante_disk')
    {
        if (empty($path)) {
            return false;
        }

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

    private function buildPath($userId, $subfolder, $filename)
    {
        $path = $userId . '/';

        if ($subfolder) {
            $path .= $subfolder . '/';
        }

        $path .= $filename;

        return $path;
    }
}
