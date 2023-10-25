<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use \Doctrine\ORM\EntityNotFoundException as NFException;
use App\Repository\QuizzRepository;
use App\Entity\Quizz;

class QuizzController extends AbstractController
{
/*     #[Route('/quizz/{name}', name: 'Quiz par name')]
    public function showOneBy(QuizzRepository $qr, $name): Response
    {
        $Onequizz =$qr->findOneBy(["name"=> $name]);

        return $this->render('quizz/single.html.twig', [
            'controller_name' => 'QuizzController',
            'quizz_name' => $name,
        ]);
    } */

    // gestion des autres routes //
    #[Route('/quizz/edit/{name}', name: 'Edition du quiz par son nom')]
    public function showEditForm(QuizzRepository $qr, $name): Response
    {

        return $this->render('quizz/edit.html.twig', [
            'controller_name' => 'QuizzController',
            'quizz_name' => $name,
        ]);
    }

/*     #[Route('/quizz/add', name: 'Ajout/Création de quiz')]
    public function index(): Response
    {
        return $this->render('quizz/add.html.twig', [
            'controller_name' => 'AddQuizzController',
        ]);
    } */

        // RESTE A SECURISER LA ROUTE DE SORTE A CE QU'ELLE NE SOIT PAS ACCESSIBLE TANT QUE L'ON EST PAS CONNECTE ET QUE L'ON EST PAS ADMIN //
        #[Route('/quizz/delete/{id}', name: "Suppression de quizz par son identifiant")]
        public function delete(EntityManagerInterface $entityManager, QuizzRepository $qr, $id): Response
        {

            $quizz = $qr->findOneBy(["id"=> $id]);

            if($quizz != NULL){
                try{
                    // Recuperer le quizz à supprimer 
        
                    // Executer la suppression en base de données 
                    $entityManager->remove($quizz);
                    $entityManager->flush();

                    // Rediriger vers une vue qui dit que le quizz a bien été supprimé
                    return $this->render('quizz/single.html.twig', [
                        'controller_name' => 'QuizzController',
                        'quizz_name' => 'Supprimé',
                    ]);

                }
                catch (NFException $ex) {
                    echo "Exception Found - " . $ex->getMessage() . "<br/>";
                }
            }
            
            else{
                // Il faut rediriger vers une vue d'erreur 404
                return $this->render('quizz/single.html.twig', [
                    'controller_name' => 'QuizzController',
                    'quizz_name' => "a pas pu être supprimé",
                ]);
            }


            // Si la suppression s'est passée alors :
                // Redirige vers la page d'administration qui resence l'ensemble des quizz
            // Sinon : 
                // Expliquer pourquoi ça n'a pas fonctionné
        }


        // RESTE A SECURISER LA ROUTE DE SORTE A CE QU'ELLE NE SOIT PAS ACCESSIBLE TANT QUE L'ON EST PAS CONNECTE ET QUE L'ON EST PAS ADMIN //
        #[Route('/quizz/add', name: "Ajouter un quizz")]
        public function add(EntityManagerInterface $entityManager): Response
        {   
            // Récupérer les saisies d'un formulaire.

            // Ce qu'il y a ci-dessous représente des données hypothétiquement récupérées du formulaire.
            $nomDuQuizz = "HTML";
            $image = "https://upload.wikimedia.org/wikipedia/commons/thumb/9/99/Unofficial_JavaScript_logo_2.svg/800px-Unofficial_JavaScript_logo_2.svg.png";
            $created = new \DateTimeImmutable('2023-01-01');
            $updated = $created;
            $status = "draft";
            $nbQuest = 10;

            $quizz = new Quizz;
            $quizz->setName($nomDuQuizz);
            $quizz->setImg($image);
            $quizz->setCreatedAt($created);
            $quizz->setUpdatedAt($updated);
            $quizz->setStatus($status);
            $quizz->setNbQuestions($nbQuest);

            $entityManager->persist($quizz);
            $entityManager->flush();

            return new Response('Saved new quizz with id '.$quizz->getId());

        }

}
