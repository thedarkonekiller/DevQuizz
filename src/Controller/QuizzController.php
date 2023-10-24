<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\QuizzRepository;

class QuizzController extends AbstractController
{
    #[Route('/quizz/{name}', name: 'Quiz par name')]
    public function showOneBy(QuizzRepository $qr, $name): Response
    {

        // Récupérer un quizz par son nom et envoyer son contenu à la vue//

        return $this->render('quizz/single.html.twig', [
            'controller_name' => 'QuizzController',
            'quizz_name' => $name,
        ]);
    }

    // gestion des autres routes //
    #[Route('/quizz/edit/{name}', name: 'Edition du quizz par son nom')]
    public function showEditForm(QuizzRepository $qr, $name): Response
    {

        return $this->render('quizz/edit.html.twig', [
            'controller_name' => 'QuizzController',
            'quizz_name' => $name,
        ]);
    }
}
