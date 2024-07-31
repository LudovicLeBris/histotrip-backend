<?php

namespace App\DataFixtures;

use App\DataFixtures\Provider\AppProvider;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Place;
use App\Entity\Picture;
use App\Entity\Category;
use App\Entity\Century;
use App\Entity\Tag;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create("fr_FR");
        $faker->addProvider(new AppProvider());

        // ! CATEGORY
        $categoryList = [];
        foreach ($faker->getCategories() as $dataCategory) {
            $category = new Category();
            $category->setName($dataCategory[0]);
            $category->setIcon($dataCategory[1]);
            $category->setCreatedAt(new \DateTimeImmutable($faker->date()));
            $categoryList[] = $category;
            $manager->persist($category);
        }

        // ! CENTURY
        $centuryList = [];
        foreach ($faker->getCenturies() as $dataCentury) {
            $century = new Century();
            $century->setCentury($dataCentury['century']);
            $century->setPeriod($dataCentury['period']);
            $century->setCreatedAt(new \DateTimeImmutable($faker->date()));
            $centuryList[] = $century;
            $manager->persist($century);
        }
        // ! TAG
        $tagList = [];
        foreach ($faker->getTags() as $dataTag) {
            $tag = new Tag();
            $tag->setName($dataTag);
            $tag->setCreatedAt(new \DateTimeImmutable($faker->date()));
            $tagList[] = $tag;
            $manager->persist($tag);
        }

        // ! PLACE
        foreach ($faker->getPlaces() as $dataPlace) {
            $place = new Place();
            $place->setName($dataPlace['name']);
            $place->setLatitude($dataPlace['latitude']);
            $place->setLongitude($dataPlace['longitude']);
            $place->setAddress($dataPlace['adress']);
            $place->setPostcode($dataPlace['postcode']);
            $place->setCity($dataPlace['city']);
            $place->setCountry($dataPlace['country']);
            $place->setWebsite($dataPlace['website']);
            $place->setPhone($dataPlace['phone']);
            $place->setDescription($faker->paragraph(8));
            $place->setPrice($dataPlace['price']);
            $place->setOpeningHours($dataPlace['openingHours']);
            $place->setRating($faker->randomFloat(1, 1, 5));
            $place->setAccessibility($dataPlace['accessibility']);
            $place->setGuidedTour($dataPlace['guided_tour']);
            $place->setIsValid($dataPlace['isValid']);
            $place->setSlug($dataPlace['slug']);
            $place->setCreatedAt(new \DateTimeImmutable($faker->date()));

            $place->addCategory($categoryList[array_rand($categoryList)]);
            $place->addCentury($centuryList[array_rand($centuryList)]);
            $place->addTag($tagList[array_rand($tagList)]);

            // ! PICTURE
            $picture = new Picture();
            $picture->setName($place->getName());
            $picture->setPictureLegend($dataPlace['picture']['picture_legend']);
            $picture->setCdnUrl($dataPlace['picture']['url']);
            $picture->setIsMain($dataPlace['picture']['isMain']);
            $picture->setCreatedAt(new \DateTimeImmutable($faker->date()));
            $manager->persist($picture);

            $place->addPicture($picture);

            $manager->persist($place);
        }

        $manager->flush();
    }
}
