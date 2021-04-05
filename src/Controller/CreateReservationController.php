<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class CreateReservationController extends AbstractController
{
    /**
     * @Route("/reservation", name="create_reservation")
     */
    public function index(Request $request): Response
    {
        $form = $this->createFormBuilder()
            ->add('dateFrom', DateTimeType::class, [
                'label' => 'Od'
            ])
            ->add('dateTo', DateTimeType::class, [
                'label' => 'Do'
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
