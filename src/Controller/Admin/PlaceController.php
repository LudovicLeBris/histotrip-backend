<?php

namespace App\Controller\Admin;

use App\Repository\PlaceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route as AnnotationRoute;
use Symfony\Component\Routing\Attribute\Route;

class PlaceController extends AbstractController
{
    #[Route('admin/places', name: 'app_admin_place_list')]
    public function list(PlaceRepository $placeRepository): Response
    {
        $places = $placeRepository->findAll();
        
        return $this->render('admin/place/list.html.twig', ['places' => $places]);
    }
}
