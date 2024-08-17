<?php

namespace App\Controller\Admin;

use App\Entity\Century;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CenturyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Century::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Siècle')
            ->setEntityLabelInPlural('Siècles')
            ->setPageTitle('new', "Création d'un siècle")
            ->setPageTitle('edit', "Édition d'un siècle")
            ->setSearchFields(['century', 'period'])
        ;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
