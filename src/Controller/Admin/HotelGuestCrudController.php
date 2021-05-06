<?php

namespace App\Controller\Admin;

use App\Entity\HotelGuest;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class HotelGuestCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return HotelGuest::class;
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
