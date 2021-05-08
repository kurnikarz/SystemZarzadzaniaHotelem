<?php

namespace App\Controller;

use App\Entity\AddidtionalResources;
use App\Entity\HotelGuest;
use App\Entity\Reception;
use App\Entity\Reservation;
use App\Entity\Room;
use App\Repository\ReceptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
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

//use App\Entity\

class CreateReservationController extends AbstractController
{
    /**
     * @Route("/rezerwacja", name="create_reservation")
     */
    public function index(Request $request): Response
    {
        $rooms = $this->getDoctrine()->getRepository(Room::class)->findBy([
            'availablity' => '0'
        ]);
        $addidtionalResources = $this->getDoctrine()->getRepository(AddidtionalResources::class)->findAll();
        $arrayRooms = [];
        $arrayAddidtionalResources = [];

        foreach ($rooms as $room) {
            array_push($arrayRooms, [
                'Wybieram' => $room->getNumber()
            ]);
        }

        foreach ($addidtionalResources as $addidtionalResource) {
            array_push($arrayAddidtionalResources, [
                'Wybieram' => $addidtionalResource->getName()
            ]);
        }

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

        $form->add('rooms', ChoiceType::class, [
            'choices' => [
                $arrayRooms
            ],
            'multiple' => true,
            'expanded' => true,
            'required' => true
        ]);

        $form->add('addidtionalResources', ChoiceType::class, [
            'choices' => [
                $arrayAddidtionalResources
            ],
            'multiple' => true,
            'expanded' => true,
            'required' => false
        ]);

        $form = $form->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $postData = $request->request->get('form');
            $entityManager = $this->getDoctrine()->getManager();
            $reservation = new Reservation();
            $hotel_guest = new HotelGuest();
            $dateFrom = date_create_from_format('Y-m-d', $postData['dateFrom']);
            $dateTo = date_create_from_format('Y-m-d', $postData['dateTo']);

            //Hotel guest
            $hotel_guest->setName($postData['name']);
            $hotel_guest->setSurname($postData['surname']);
            $hotel_guest->setEmail($postData['email']);
            $hotel_guest->setPhone($postData['phone']);
            $hotel_guest->setReservation($reservation);

            //Reservation
            $reservation->setDateFrom($dateFrom);
            $reservation->setDateTo($dateTo);
            $reservation->setAccepted(false);

            //Rooms
            $rooms = $postData['rooms'];
            $priceForRooms = 0;
            foreach ($rooms as $room) {
                $roomAdd = $this->getDoctrine()->getRepository(Room::class)->findOneBy([
                    'number' => $room
                ]);
                $priceForRooms += $roomAdd->getPrice();
                $roomAdd->setAvailablity('1');
                $roomAdd->setReservation($reservation);
                $entityManager->persist($roomAdd);
            }

            //Addidtional resources
            $addidtionalResources = $postData['addidtionalResources'];
            $priceForAdditionalResources = 0;
            foreach ($addidtionalResources as $addidtionalResource) {
                $addidtionalResourceAdd = $this->getDoctrine()->getRepository(AddidtionalResources::class)->findOneBy([
                    'name' => $addidtionalResource
                ]);
                $priceForAdditionalResources += $addidtionalResourceAdd->getPrice();
                $addidtionalResourceAdd->addReservation($reservation);
                $entityManager->persist($addidtionalResourceAdd);
            }

            //Price
            $days = $dateFrom->diff($dateTo)->days;
            $priceForRooms *= $days;
            $priceForAdditionalResources *= $days;
            $price = $priceForRooms + $priceForAdditionalResources;
            $reservation->setPrice($price);

            $entityManager->persist($hotel_guest);
            $entityManager->persist($reservation);
            $entityManager->flush();

            return $this->render('homepage/index.html.twig', [
                'message' => "Dziękujemy za dokonanie rezerwacji"
            ]);
        }

        return $this->render('create_reservation/index.html.twig', [
            'form' => $form->createView(),
            'rooms' => $rooms,
            'addidtionalResources' => $addidtionalResources
        ]);
    }
}
