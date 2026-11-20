<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use InvalidArgumentException;

class FileUploadSanitizerService
{
    private const ALLOWED_MIME_TYPES = ['image/jpeg', 'image/png', 'image/webp'];
    private const MAX_SIZE_BYTES = 5 * 1024 * 1024; // 5MB

    /**
     * Memvalidasi dan menyimpan berkas foto ke disk public dengan nama UUID acak
     * Task ID: ARC-009 / BE-008
     */
    public function storeImage(UploadedFile $file, string $subfolder): string
    {
        // 1. Validasi Ukuran (Maks 5MB)
        if ($file->getSize() > self::MAX_SIZE_BYTES) {
            throw new InvalidArgumentException("Ukuran berkas melebihi batas maksimal 5MB.");
        }

        // 2. Validasi MIME Type Biner
        $mime = $file->getMimeType();
        if (!in_array($mime, self::ALLOWED_MIME_TYPES, true)) {
            throw new InvalidArgumentException("Format berkas [{$mime}] tidak didukung. Hanya format JPG dan PNG yang diperbolehkan.");
        }

        // 3. Sanitasi Nama Berkas dengan UUID v4
        $extension = $file->getClientOriginalExtension() ?: 'jpg';
        $fileName = Str::uuid()->toString() . '.' . strtolower($extension);

        // 4. Simpan ke storage/app/public/{subfolder}
        $storedPath = $file->storeAs($subfolder, $fileName, 'public');

        return $storedPath;
    }

    /**
     * Menghapus berkas jika terjadi rollback transaksi
     */
    public function deleteImage(?string $path): bool
    {
        if ($path && Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->delete($path);
        }
        return false;
    }
}

