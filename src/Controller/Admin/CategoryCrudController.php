<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Category::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Catégorie')
            ->setEntityLabelInPlural('Catégories')
            ->setPageTitle('new', "Création d'une catégorie")
            ->setPageTitle('edit', "Édition d'une catégorie")
            ->setSearchFields(['name'])
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name', "Nom"),
            TextField::new('icon', "Icône"),
        ];
    }

    public function createEntity(string $entityFqcn)
    {
        $category = new Category();
        $category->setCreatedAt(new \DateTimeImmutable());

        return $category;
    }

}
