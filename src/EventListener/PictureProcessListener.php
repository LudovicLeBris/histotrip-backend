<?php

namespace App\EventListener;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\File\UploadedFile;

final class PictureProcessListener
{
    public function __construct(
        private ParameterBagInterface $parameterBag,
    )
    {}
    
    #[AsEventListener(event: 'vich_uploader.pre_upload')]
    public function onVichUploaderPreUpload($event): void
    {
        $imagePath = $this->parameterBag->get('kernel.project_dir') . '/public/images/';

        $picture = $event->getObject();
        $pictureFile = $picture->getImageFile();

        $originalPictureName = $pictureFile->getClientOriginalName();
        $newPictureName = pathinfo($originalPictureName, PATHINFO_FILENAME) . '.webp';
        
        $imageType = $pictureFile->getMimeType();

        switch ($imageType) {
            case 'image/jpeg':
                $image = imagecreatefromjpeg($pictureFile);
                break;
            case 'image/png':
                $image = imagecreatefrompng($pictureFile);
                break;
            case 'image/gif':
                $image = imagecreatefromgif($pictureFile);
                break;
            case 'image/bmp':
                $image = imagecreatefrombmp($pictureFile);
            default:
                return;
        }

        imagewebp($image, $imagePath . $newPictureName, 70);
        
        $webpFile = new UploadedFile($imagePath . $newPictureName, $newPictureName, 'image/webp');
        $picture->setImageFile($webpFile);
    }
}
