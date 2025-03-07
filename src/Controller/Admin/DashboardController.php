<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Gender;
use App\Entity\Pokemon;
use App\Entity\Region;
use App\Entity\Talent;
use App\Entity\Type;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;

#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{
    public function index(): Response
    {
        return $this->render('admin/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Pokedex');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Pokemons', 'fas fa-dragon', Pokemon::class);
        yield MenuItem::linkToCrud('Catégories', 'fas fa-list', Category::class);
        yield MenuItem::linkToCrud('Sexes', 'fas fa-venus-mars', Gender::class);
        yield MenuItem::linkToCrud('Talents', 'fas fa-book', Talent::class);
        yield MenuItem::linkToCrud('Régions', 'fas fa-map-location-dot', Region::class);
        yield MenuItem::linkToCrud('Types', 'fas fa-fire', Type::class);
    }
}
