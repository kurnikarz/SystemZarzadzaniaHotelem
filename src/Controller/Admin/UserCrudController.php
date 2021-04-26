<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

//    public function createEntity(string $entityFqcn)
//    {
//        $form = $this->createFormBuilder()
//            ->add('email',TextType::class, [
//                'label' => 'rarar'
//            ]);
//        $form = $form->getForm();
//        return $form;
//    }

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
