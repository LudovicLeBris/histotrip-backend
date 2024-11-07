<?php

namespace App\EventListener;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

final class PictureUploadListener
{  
    public function __construct(
        private ParameterBagInterface $parameterBag,
    )
    {}
    
    #[AsEventListener(event: 'vich_uploader.post_upload')]
    public function onVichUploaderPostUpload($event): void
    {
        $picture = $event->getObject();
        $s3Bucket = 'http://127.0.0.1:9000/place-pictures/';
        $picture->setCdnUrl($s3Bucket . $picture->getImageName());
        
        $imagePath = $this->parameterBag->get('kernel.project_dir') . '/public/images/';
        array_map('unlink', glob( "$imagePath*.webp"));
    }
}
