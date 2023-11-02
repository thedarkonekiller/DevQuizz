<?php

namespace App\Controller\Admin;

use App\Entity\Question;
use App\Entity\Quizz;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use Doctrine\Persistence\ManagerRegistry;

class QuestionCrudController extends AbstractCrudController
{

    private $managerRegistry;
    
    public function __construct(ManagerRegistry $mr){
        $this->managerRegistry = $mr;
    }

    public static function getEntityFqcn(): string
    {
        return Question::class;
    }
    
    public function configureFields(string $pageName): iterable
    {

        if($pageName === Crud::PAGE_INDEX){
            return[
                TextField::new('titled', 'Intitulé'),
                TextField::new('quizz.name', 'Quizz associé')
            ];
        }
        else{
            return [
                TextField::new('titled', 'Intitulé'),
                AssociationField::new('quizz', 'Quizz associé')->setFormTypeOption('choice_label', 'name')
            ];
        }
    }

    // Récupérer l'ensemble des quizz 
    // Puis de stocker dans un tableau : 
    // en guise de clé, l'identifiant du quizz (qui permettra d'être interprêté lors qu'on envoie le formulaire (en tant que quizz8id de l'entité question))
    // en guise de valeur, le nom du quizz (juste pour l'interface).

/*     private function getAllChoices(): array 
    {
        $allQuizz = $this->managerRegistry->getRepository(Quizz::class);
        $allQ = $allQuizz->findAll();

        $choices = [];

        foreach($allQ as $singleQuizz){
            $choices[$singleQuizz->getName()] = $singleQuizz->getId();
        }

        return $choices;
    } */
    
}
