<?php

namespace App\Controller;

use App\Entity\MediaObject;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

#[AsController]
final class CreateMediaObjectAction extends AbstractController
{
    public function __invoke(Request $request): MediaObject
    {
        $uploadedFile = $request->files->get('file');
        if (!$uploadedFile || false === $uploadedFile->getSize()) {
            throw new BadRequestHttpException('Upload failed: please check uploaded file size. Max 10M allowed');
        }

        $mediaObject = new MediaObject();
        $mediaObject->file = $uploadedFile;
        $mediaObject->sha256 = hash_file('sha256', $uploadedFile);
        $mediaObject->uploadDate = new \DateTimeImmutable();

        return $mediaObject;
    }
}
