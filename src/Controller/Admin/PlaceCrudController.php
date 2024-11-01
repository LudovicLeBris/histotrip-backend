<?php

namespace App\Controller\Admin;

use App\Entity\Place;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;

class PlaceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Place::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Lieu')
            ->setEntityLabelInPlural('Lieux')
            ->setPageTitle('new', "Création d'un lieu")
            ->setPageTitle('edit', "Édition d'un lieu")
            ->setSearchFields(['name', 'city', 'postcode'])
            ->setDefaultSort(['createdAt' => 'DESC'])
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            FormField::addFieldset('Titre'),
            TextField::new('name', "Nom"),
            SlugField::new('slug', "slug")->setTargetFieldName('name'),
            TextField::new('subtitle', "Sous-titre")->hideOnIndex(),
            BooleanField::new('isValid', "Lieu approuvé"),
            NumberField::new('rating', "Note")->hideOnForm(),
            FormField::addFieldset('Localisation')->collapsible()->renderCollapsed(),
            TextField::new('address', "Adresse")->hideOnIndex(),
            TextField::new('postcode', "Code postal"),
            TextField::new('city', "Ville"),
            TextField::new('country', "Pays"),
            NumberField::new('latitude', "Latitude")->hideOnIndex()->setColumns(3),
            NumberField::new('longitude', "Longitude")->hideOnIndex()->setColumns(3),
            FormField::addFieldset('Informations pratiques')->collapsible()->renderCollapsed(),
            UrlField::new('website', "Site internet")->hideOnIndex(),
            TextField::new('phone', "Téléphone")->hideOnIndex(),
            TextEditorField::new('description', "Description")->hideOnIndex(),
            TextEditorField::new('price', "Prix")->hideOnIndex(),
            TextEditorField::new('openingHours', "Heures d'ouvertures")->hideOnIndex(),
            BooleanField::new('accessibility', "Accès handicapés")->hideOnIndex()->setColumns(3),
            BooleanField::new('guidedTour', "Visite guidée")->hideOnIndex()->setColumns(3),
            FormField::addFieldset('Filtres')->collapsible(),
            AssociationField::new('categories', "Catégories")->hideOnIndex()->setSortProperty('category'),
            AssociationField::new('centuries', "Siècles - périodes")->hideOnIndex(),
            AssociationField::new('tags', "Tags")->hideOnIndex(),
        ];
    }

    public function createEntity(string $entityFqcn)
    {
        $place = new Place();
        $place->setRating(0);
        $place->setCreatedAt(new \DateTimeImmutable());

        return $place;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->add(Crud::PAGE_NEW, Action::SAVE_AND_CONTINUE)
        ;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('name')
            ->add('isValid')
            ->add('categories')
            ->add('centuries')
            ->add('tags')
        ;
    }

}
