<?php


namespace App\Controller\Admin;

use App\Entity\AddidtionalResources;
use App\Entity\HotelGuest;
use App\Entity\Reservation;
use App\Entity\Room;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ReservationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Reservation::class;
    }

    public function createEntity(string $entityFqcn)
    {
//        $form = $this->createFormBuilder()
//            ->add('id', IntegerType::class)
//            ->add('dateFrom', DateType::class, [
//                'label' => 'Od',
//                'attr' => [
//                    'class' => 'form-control'
//                ],
//                'widget' => 'single_text'
//            ])
//            ->add('dateTo', DateType::class, [
//                'label' => 'Do',
//                'attr' => [
//                    'class' => 'form-control'
//                ],
//                'widget' => 'single_text'
//            ])
//            ->add('price', IntegerType::class, [
//                'label' => 'Cena'
//            ])
//            ->add('hotelGoues', TextType::class, [
//                'label' => 'Gość hotelowy'
//            ])
//            ->add('rooms', TextType::class, [
//                'label' => 'Pokoje'
//            ])
//            ->add('addidtionalResources', TextType::class, [
//                'label' => 'Zasoby dodatkowe'
//            ])
//            ;
//        $form = $form->getForm();
//        return $form->createView();
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            DateTimeField::new('DateFrom','Data od')->setFormat("yyyy-MM-dd"),
            DateTimeField::new('DateTo', 'Data do')->setFormat("yyyy-MM-dd"),
            IntegerField::new('price', 'Cena [PLN]'),
            AssociationField::new('hotelGuest', 'Gość hotelowy'),
            AssociationField::new('rooms', 'Pokoje'),
            AssociationField::new('addidtionalResources', 'Zasoby dodatkowe'),
            BooleanField::new('accepted', 'Zaakceptowana'),
        ];
    }

//    public function configureActions(Actions $actions): Actions
//    {
//        return $actions
//            ->add(Crud::PAGE_INDEX, Action::DETAIL);
//    }

}