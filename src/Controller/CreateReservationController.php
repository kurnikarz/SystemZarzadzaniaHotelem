<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class CreateReservationController extends AbstractController
{
    /**
     * @Route("/rezerwacja", name="create_reservation")
     */
    public function index(Request $request): Response
    {
        $form = $this->createFormBuilder()
            ->add('dateFrom', DateType::class, [
                'label' => 'Od',
                'attr' => [
                    'class' => 'form-control'
                ],
                'widget' => 'single_text'
            ])
            ->add('dateTo', DateType::class, [
                'label' => 'Do',
                'attr' => [
                    'class' => 'form-control'
                ],
                'widget' => 'single_text'
            ])
            ->add('add', ButtonType::class, [
                'attr' => [
                    'class' => 'btn btn-primary pull-right repeater-add-btn'
                ],
                'label' => 'Dodaj pokój'
            ])
            ->add('room_type', ChoiceType::class,[
                'choices' => [
                    '2 osobowy' => 2,
                    '3 osobowy' => 3,
                    '4 osobowy' => 4
                ],
                'attr' => [
                    'class' => 'form-select',
                    'id' => 'room_type'
                ],
                'label' => 'Typ pokoju'
            ])
            ->add('people', NumberType::class, [
                'label' => 'Liczba osób',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('remove', ButtonType::class, [
                'label' => 'Usuń',
                'attr' => [
                    'class' => 'btn btn-danger remove-btn'
                ]
            ])
            ->add('name', TextType::class, [
                'label' => 'Imię',
                'attr' => [
                    'class' => 'form-control',
                    'maxlength' => '50'
                ]
            ])
            ->add('surname', TextType::class, [
                'label' => 'Nazwisko',
                'attr' => [
                    'class' => 'form-control',
                    'maxlength' => '50'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr' => [
                    'class' => 'form-control',
                    'maxlength' => '50'
                ]
            ])
            ->add('phone', TextType::class, [
                'label' => 'Numer telefonu',
                'attr' => [
                    'class' => 'form-control',
                    'maxlength' => '20'
                ]
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Złóż rezerwacje',
                'attr' => [
                    'class' => 'btn btn-success'
                ]
            ]);

        $form = $form->getForm();
        $form->handleRequest($request);

        return $this->render('create_reservation/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
