<?php

namespace App\Controller\Admin;

use App\Entity\Place;
use App\Form\PlaceType;
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

    #[Route('admin/places/{placeId}', name: 'app_admin_place_show', requirements: ['placeId' => '\d+'])]
    public function show($placeId, PlaceRepository $placeRepository): Response
    {
        $place = $placeRepository->find($placeId);
        $pictures = [];
        foreach ($place->getPictures() as $picture) {
            array_push($pictures, $picture);
        }
        $categories = [];
        foreach ($place->getCategories() as $category) {
            array_push($categories, $category);
        }
        $centuries = [];
        foreach ($place->getCenturies() as $century) {
            array_push($centuries, $century);
        }
        $tags = [];
        foreach ($place->getTags() as $tag) {
            array_push($tags, $tag);
        }
        
        return $this->render('admin/place/show.html.twig', [
            'place' => $place,
            'pictures' => $pictures,
            'categories' => $categories,
            'centuries' => $centuries,
            'tags' => $tags,
        ]);
    }

    #[Route('admin/places/add', name: 'app_admin_place_add')]
    public function add(): Response
    {
        $place = new Place();
        $placeForm = $this->createForm(PlaceType::class, $place);

        return $this->render('admin/place/add.html.twig', ['placeForm' => $placeForm]);
    }
}
