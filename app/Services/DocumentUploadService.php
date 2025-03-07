<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DocumentUploadService
{
    public function uploadPartDocument(UploadedFile $file, string $partCode): string
    {
        $fileName = Str::slug($partCode) . '-' . time() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('part-documents', $fileName, 'public');
        return $path;
    }

    public function deleteDocument(string $filePath): bool
    {
        return Storage::disk('public')->delete($filePath);
    }
}