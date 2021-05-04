<?php


namespace App\Controller\Admin;

use App\Entity\Reservation;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
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

    public function configureFields(string $pageName): iterable
    {
//        dump(AssociationField::new('rooms'));
        return [
            IdField::new('id'),
            DateTimeField::new('DateFrom'),
            DateTimeField::new('DateTo'),
            AssociationField::new('rooms')
        ];
    }

}