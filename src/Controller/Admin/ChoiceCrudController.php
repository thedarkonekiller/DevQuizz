<?php

namespace App\Controller\Admin;

use App\Entity\Choice;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;

class ChoiceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Choice::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('answer', 'proposition'),

        ];
    }
    
}
