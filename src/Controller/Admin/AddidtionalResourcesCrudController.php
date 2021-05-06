<?php

namespace App\Controller\Admin;

use App\Entity\AddidtionalResources;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AddidtionalResourcesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return AddidtionalResources::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('name', 'Nazwa'),
            IntegerField::new('price', 'Cena za dobę'),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->setPermission(Action::NEW, 'ROLE_MANAGEMENT')
            ->setPermission(Action::DELETE, 'ROLE_MANAGEMENT')
            ->setPermission(Action::EDIT, 'ROLE_MANAGEMENT')
            ;
    }
}
