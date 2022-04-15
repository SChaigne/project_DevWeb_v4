<?php

namespace App\Controller\Admin;

use App\Entity\CryptoCurrency;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CryptoCurrencyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CryptoCurrency::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            // IdField::new('id'),
            // TextField::new('name'),
            // TextEditorField::new('description'),
        ];
    }
}
