<?php

namespace App\EventListener;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

final class PictureUploadListener
{  
    #[AsEventListener(event: 'vich_uploader.post_upload')]
    public function onVichUploaderPostUpload($event): void
    {
        $picture = $event->getObject();
        $s3Bucket = 'http://127.0.0.1:9000/place-pictures/';
        $picture->setCdnUrl($s3Bucket . $picture->getImageName());
    }
}
