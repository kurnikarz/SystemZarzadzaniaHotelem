<?php

namespace App\Controller\Admin;

use App\Controller\ReservationController;
use App\Entity\AddidtionalResources;
use App\Entity\HotelGuest;
use App\Entity\Reservation;
use App\Entity\Room;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use function Symfony\Component\DependencyInjection\Loader\Configurator\param;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
//        return parent::index();
        $routeBuilder = $this->get(CrudUrlGenerator::class)->build();
        $url = $routeBuilder->setController(ReservationCrudController::class)->generateUrl();
        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('System Zarządzania Hotelem');
    }

    public function configureMenuItems(): iterable
    {

        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
        yield MenuItem::section("Encje");
        yield MenuItem::linkToCrud('Rezerwacje','fa fa-folder', Reservation::class);
        yield MenuItem::linkToCrud('Goście Hotelowi','fa fa-folder', HotelGuest::class);
        yield MenuItem::linkToCrud('Pokoje','fa fa-folder', Room::class);
        yield MenuItem::linkToCrud('Zasoby dodatkowe','fa fa-folder', AddidtionalResources::class);
    }
}
