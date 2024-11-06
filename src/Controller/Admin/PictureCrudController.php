<?php

namespace App\Controller\Admin;

use App\Entity\Picture;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class PictureCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Picture::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Image')
            ->setEntityLabelInPlural('Images')
            ->setPageTitle('new', "Création d'une image")
            ->setPageTitle('edit', "Édition d'une image")
        ;
    }

        public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('pictureLegend', "Légende de l'image")->hideOnIndex(),
            TextField::new('imageFile', 'Upload')->setFormType(VichImageType::class)->onlyOnForms(),
            ImageField::new('imageName', 'Fichier')->setBasePath('http://127.0.0.1:9000/place-pictures/')->hideOnForm(),
            UrlField::new('cdnUrl', "Url de l'image")->hideOnIndex()->setFormTypeOption('default_protocol', 'http'),
            BooleanField::new('isMain', "Image principale"),
            AssociationField::new('place', "Lieu")->hideOnForm(),
        ];
    }

    public function createEntity(string $entityFqcn)
    {       
        $picture = new Picture();
        $picture->setCreatedAt(new \DateTimeImmutable());

        return $picture;
    }

}
