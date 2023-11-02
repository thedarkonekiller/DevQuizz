<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Quizz;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class DashboardController extends AbstractDashboardController
{
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/admin', name: 'admin')]
    

    public function index(ChartBuilderInterface $chartBuilder): Response
    {

        return $this->render('admin/dashboard.html.twig', );
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Administration DevQuizz');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::section('Général');
        yield MenuItem::linkToCrud('Utilisateurs', 'fa fa-user', User::class);
        yield MenuItem::section('Quiz');
        yield MenuItem::linkToCrud('Les Quiz', 'fa fa-question', Quizz::class);
<<<<<<< HEAD
=======
        yield MenuItem::section('Questions');
        yield MenuItem::linkToCrud('Questions', 'fa fa-question', Question::class);
        /* yield MenuItem::section('Propositions de réponse');
        yield MenuItem::linkToCrud('Propositions de réponse', 'fa fa-question', Choice::class); */
>>>>>>> bce6c157af2546ac4b2ad54f46628cf7a5ee1555
    }
}
