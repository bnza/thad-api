<?php

namespace App\Service;

use App\Entity\MediaObject;

class MediaObjectThumbnailer
{
    private array $supportedFormats = [
        'image/jpeg',
    ];

    public function support(MediaObject $mediaObject): bool
    {

        return in_array($mediaObject->mimeType, $this->supportedFormats);
    }

    public function generateThumbnail(MediaObject $mediaObject): void
    {
        if ($this->support($mediaObject)) {
            $this->createThumb($mediaObject, 256);
        }
    }

    public function geThumbnailPath(string $path): string
    {
        return preg_replace('/(?<filename>.+)(?<extension>\.\w+)?$/U', '$1.thumb.jpeg', $path);
    }

    /**
     * @see https://code.tutsplus.com/tutorials/how-to-create-a-thumbnail-image-in-php--cms-36421
     */
    private function createThumb(MediaObject $mediaObject, $thumbWidth = 100): void
    {
        $realPath = $mediaObject->file->getRealPath();
        file_put_contents('/tmp/jkjk', $this->geThumbnailPath($realPath));
        $sourceImage = imagecreatefromjpeg($realPath);
        $orgWidth = imagesx($sourceImage);
        $orgHeight = imagesy($sourceImage);
        $thumbHeight = floor($orgHeight * ($thumbWidth / $orgWidth));
        $destImage = imagecreatetruecolor($thumbWidth, $thumbHeight);
        imagecopyresampled($destImage, $sourceImage, 0, 0, 0, 0, $thumbWidth, $thumbHeight, $orgWidth, $orgHeight);
        imagejpeg($destImage, $this->geThumbnailPath($realPath));
        imagedestroy($sourceImage);
        imagedestroy($destImage);
    }
}
