<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Salva un'immagine caricata sul disco "public", ridimensionandola se troppo grande.
 *
 * Le foto da telefono (4000px+, 3-8 MB) vengono ridotte a $maxSide px sul lato lungo
 * e raddrizzate secondo l'orientamento EXIF. Se GD non riesce a elaborarla,
 * l'immagine viene salvata così com'è: l'upload non fallisce mai per colpa del resize.
 */
class ImageResizer
{
    public static function store(UploadedFile $file, string $directory, int $maxSide = 2000): string
    {
        try {
            $resized = self::resize($file, $maxSide);
        } catch (\Throwable $e) {
            Log::warning('Image resize failed, storing original', ['error' => $e->getMessage()]);
            $resized = null;
        }

        if ($resized === null) {
            return $file->store($directory, 'public');
        }

        [$data, $extension] = $resized;
        $path = $directory . '/' . Str::random(40) . '.' . $extension;
        Storage::disk('public')->put($path, $data);

        return $path;
    }

    /**
     * @return array{0: string, 1: string}|null  [contenuto binario, estensione] o null se non serve/non possibile
     */
    private static function resize(UploadedFile $file, int $maxSide): ?array
    {
        $info = @getimagesize($file->getRealPath());
        if (! $info) {
            return null;
        }

        [$width, $height, $type] = $info;

        $image = match ($type) {
            IMAGETYPE_JPEG => function_exists('imagecreatefromjpeg') ? imagecreatefromjpeg($file->getRealPath()) : false,
            IMAGETYPE_PNG => function_exists('imagecreatefrompng') ? imagecreatefrompng($file->getRealPath()) : false,
            IMAGETYPE_WEBP => function_exists('imagecreatefromwebp') ? imagecreatefromwebp($file->getRealPath()) : false,
            default => false,
        };

        if (! $image) {
            return null;
        }

        $rotated = false;
        if ($type === IMAGETYPE_JPEG) {
            [$image, $rotated] = self::applyExifOrientation($image, $file->getRealPath());
            $width = imagesx($image);
            $height = imagesy($image);
        }

        // Già piccola e dritta: teniamo il file originale, senza perdere qualità
        if (! $rotated && max($width, $height) <= $maxSide) {
            imagedestroy($image);

            return null;
        }

        if (max($width, $height) > $maxSide) {
            $scale = $maxSide / max($width, $height);
            $scaled = imagescale($image, (int) round($width * $scale), (int) round($height * $scale), IMG_BICUBIC);
            imagedestroy($image);
            $image = $scaled;
        }

        // Mantiene la trasparenza di PNG e WebP
        imagealphablending($image, false);
        imagesavealpha($image, true);

        ob_start();
        $extension = match ($type) {
            IMAGETYPE_PNG => imagepng($image, null, 6) ? 'png' : null,
            IMAGETYPE_WEBP => imagewebp($image, null, 82) ? 'webp' : null,
            default => imagejpeg($image, null, 82) ? 'jpg' : null,
        };
        $data = ob_get_clean();
        imagedestroy($image);

        return $extension && $data ? [$data, $extension] : null;
    }

    /**
     * @return array{0: \GdImage, 1: bool}  [immagine, è stata ruotata]
     */
    private static function applyExifOrientation(\GdImage $image, string $path): array
    {
        if (! function_exists('exif_read_data')) {
            return [$image, false];
        }

        $orientation = (@exif_read_data($path) ?: [])['Orientation'] ?? 1;

        $angle = match ((int) $orientation) {
            3 => 180,
            6 => -90,
            8 => 90,
            default => 0,
        };

        if ($angle === 0) {
            return [$image, false];
        }

        $rotatedImage = imagerotate($image, $angle, 0);
        imagedestroy($image);

        return [$rotatedImage, true];
    }
}
