<?php


namespace App\Controller\Admin;

use App\Entity\Reservation;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ReservationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Reservation::class;
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