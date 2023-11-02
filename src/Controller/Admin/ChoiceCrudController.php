<?php

namespace App\Controller\Admin;

use App\Entity\Choice;
use App\Entity\Quizz;
use App\Form\ChoiceType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use Doctrine\Persistence\ManagerRegistry;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Filter\TextFilter;


class ChoiceCrudController extends AbstractCrudController
{

    private $managerRegistry;
    
    public function __construct(ManagerRegistry $mr){
        $this->managerRegistry = $mr;
    }

    public static function getEntityFqcn(): string
    {
        return Choice::class;
    }

    public function configureCrud(Crud $crud): Crud
   {
        return $crud
            ->setEntityLabelInSingular('une proposition de réponse')
            ->setEntityLabelInPlural('Propositions de réponse');
        }

        public function configureFilters(Filters $filters): Filters
        {
            return $filters
            ->add(TextFilter::new('question'));
        }

/*         public function configureFilters(Filters $filters): Filters
        {
                return $filters
                   ->add(EntityFilter::new('answer'))
                ;
            } */

    
    public function configureFields(string $pageName): iterable
    {

        if($pageName === Crud::PAGE_INDEX){
            return [
                TextField::new('answer','Proposition de réponse'),
                TextField::new('question.titled', 'Question'),
                TextField::new('question.quizz.name', 'Quizz'),
                BooleanField::new('status','Valide')->renderAsSwitch(false)
                //AssociationField::new('choice', 'Thème associé')->setFormTypeOption('choice_label','choice'),
    
            ];
        }
        return [
            TextField::new('answer','Proposition de réponse'),
            AssociationField::new('question', 'Question associée')->setFormTypeOption('choice_label', 'titled'),
            BooleanField::new('status',"Il s'agit d'une bonne proposition"),
            //AssociationField::new('choice', 'Thème associé')->setFormTypeOption('choice_label','choice'),

        ];
    }

    // Récupérer l'ensemble des quizz dispo 
    // Affiche les quizz dans un champ ChoiceType
    // en fonction de ce qu'on a choisi préalablement, on affiche les questions associées au quizz sélectionné
    private function getAllQuizz(): array 
    {
        $allQuizz = $this->managerRegistry->getRepository(Quizz::class);
        $allQ = $allQuizz->findAll();

        $choices = [];

        foreach($allQ as $singleQuizz){
            $choices[$singleQuizz->getName()] = $singleQuizz->getId();
        }

        return $choices;
    }
}
