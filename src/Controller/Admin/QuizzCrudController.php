<?php

namespace App\Controller\Admin;

use App\Entity\Quizz;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;


class QuizzCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Quizz::class;
    }

    public function configureFields(string $pageName): iterable
    {

        $champs = [
            TextField::new('name'),
            ImageField::new('img')->setUploadDir('public/assets/images/')->setBasePath('/assets/images/'),
            TextField::new('description'),
            IntegerField::new('nb_questions'),

        ];

        if($pageName === Crud::PAGE_EDIT ){
            $champs[1]->setRequired(false);
        }

        if($pageName === Crud::PAGE_INDEX || $pageName === Crud::PAGE_EDIT ){

            $nouveauxChamps = [

                ChoiceField::new('status','état')->setFormTypeOptions(
                    [
                        'choices'=>[
                            'Brouillon' => 'draft',
                            'Publié' => 'published',
                        ],
                        'placeholder' =>false,
                    ]
                )

                // ChoiceField::new('status', 'etat')->setChoices($options)
                // Si on souhaite ajouter des champs sur la page index du crud (qui liste toutes les données)
                // c'est ici qu'il faut ajouter des champs.
            ];
            return array_merge($champs, $nouveauxChamps);
        }
        else{
            return $champs;
        }

    }

    public function createEntity(string $entityFqcn){
        $quizz= new Quizz();
        $quizz->setCreatedAt(new \DateTimeImmutable('now'));
        $quizz->setUpdatedAt(new \DateTimeImmutable('now'));
        $quizz->setStatus("brouillon");
    
        return $quizz;
    }
    
}
