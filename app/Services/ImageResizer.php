<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Salva un'immagine caricata sul disco "public" in un formato standard.
 *
 * Qualunque sia l'origine (fotocamera, WhatsApp, screenshot, PNG/WebP), il file salvato è:
 * - JPEG qualità 82, con al massimo $maxSide px sul lato lungo;
 * - raddrizzato secondo l'orientamento EXIF (foto da telefono);
 * - senza metadati (EXIF, coordinate GPS), che GD non riscrive;
 * - con la trasparenza appiattita su sfondo bianco.
 *
 * Se GD non riesce a elaborarla, l'immagine viene salvata così com'è:
 * l'upload non fallisce mai per colpa della conversione.
 */
class ImageResizer
{
    private const JPEG_QUALITY = 82;

    public static function store(UploadedFile $file, string $directory, int $maxSide = 2000): string
    {
        // JPEG già conforme: lo salviamo com'è, ricomprimerlo peggiorerebbe solo la qualità
        if (self::isAlreadyStandard($file->getRealPath(), $maxSide)) {
            return $file->storeAs($directory, Str::random(40) . '.jpg', 'public');
        }

        try {
            $data = self::standardize($file->getRealPath(), $maxSide);
        } catch (\Throwable $e) {
            Log::warning('Image standardization failed, storing original', ['error' => $e->getMessage()]);
            $data = null;
        }

        if ($data === null) {
            return $file->store($directory, 'public');
        }

        $path = $directory . '/' . Str::random(40) . '.jpg';
        Storage::disk('public')->put($path, $data);

        return $path;
    }

    /**
     * Converte un file immagine in un JPEG standard.
     *
     * @return string|null  contenuto JPEG, o null se il formato non è elaborabile
     */
    public static function standardize(string $sourcePath, int $maxSide = 2000): ?string
    {
        $info = @getimagesize($sourcePath);
        if (! $info) {
            return null;
        }

        $type = $info[2];

        $image = match ($type) {
            IMAGETYPE_JPEG => function_exists('imagecreatefromjpeg') ? @imagecreatefromjpeg($sourcePath) : false,
            IMAGETYPE_PNG => function_exists('imagecreatefrompng') ? @imagecreatefrompng($sourcePath) : false,
            IMAGETYPE_WEBP => function_exists('imagecreatefromwebp') ? @imagecreatefromwebp($sourcePath) : false,
            default => false,
        };

        if (! $image) {
            return null;
        }

        if ($type === IMAGETYPE_JPEG) {
            $image = self::applyExifOrientation($image, $sourcePath);
        }

        $width = imagesx($image);
        $height = imagesy($image);
        $scale = min(1, $maxSide / max($width, $height));
        $targetWidth = max(1, (int) round($width * $scale));
        $targetHeight = max(1, (int) round($height * $scale));

        // Tela bianca: appiattisce la trasparenza di PNG/WebP (il JPEG non la supporta)
        $canvas = imagecreatetruecolor($targetWidth, $targetHeight);
        imagefill($canvas, 0, 0, imagecolorallocate($canvas, 255, 255, 255));
        imagecopyresampled($canvas, $image, 0, 0, 0, 0, $targetWidth, $targetHeight, $width, $height);
        imagedestroy($image);

        imageinterlace($canvas, true); // JPEG progressivo: si vede subito anche su connessioni lente

        ob_start();
        $ok = imagejpeg($canvas, null, self::JPEG_QUALITY);
        $data = ob_get_clean();
        imagedestroy($canvas);

        return $ok && $data ? $data : null;
    }

    /**
     * True se il file è già un JPEG entro $maxSide px e senza metadati EXIF.
     */
    public static function isAlreadyStandard(string $path, int $maxSide = 2000): bool
    {
        $info = @getimagesize($path);

        if (! $info || $info[2] !== IMAGETYPE_JPEG || max($info[0], $info[1]) > $maxSide) {
            return false;
        }

        // L'EXIF (orientamento, GPS) sta nel segmento APP1, all'inizio del file
        $head = (string) file_get_contents($path, false, null, 0, 65536);

        return ! str_contains($head, "Exif\x00\x00");
    }

    private static function applyExifOrientation(\GdImage $image, string $path): \GdImage
    {
        if (! function_exists('exif_read_data')) {
            return $image;
        }

        $orientation = (int) ((@exif_read_data($path) ?: [])['Orientation'] ?? 1);

        // 2, 4, 5, 7 sono le varianti specchiate (rare, ma alcuni telefoni le usano)
        if (in_array($orientation, [2, 4, 5, 7], true)) {
            imageflip($image, IMG_FLIP_HORIZONTAL);
        }

        $angle = match ($orientation) {
            3, 4 => 180,
            5, 6 => -90,
            7, 8 => 90,
            default => 0,
        };

        if ($angle === 0) {
            return $image;
        }

        $rotated = imagerotate($image, $angle, 0);
        imagedestroy($image);

        return $rotated;
    }
}
