<?php

namespace App\Controller\Admin;

use App\Entity\HotelGuest;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class HotelGuestCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return HotelGuest::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            EmailField::new('email'),
            TextField::new('name','Imię'),
            TextField::new('surname', 'Nazwisko'),
            TelephoneField::new('phone', 'Numer telefonu'),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->setPermission(Action::NEW, 'ROLE_RECEPTION')
            ->setPermission(Action::DELETE, 'ROLE_RECEPTION')
            ->setPermission(Action::EDIT, 'ROLE_RECEPTION')
            ;
    }
}
