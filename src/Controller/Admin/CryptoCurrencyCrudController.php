<?php

namespace App\Controller\Admin;

use App\Entity\CryptoCurrency;
// use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
// use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
// use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
// use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
// use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

// /**
//  * @IsGranted("ROLE_ADMIN")
//  */
class CryptoCurrencyCrudController extends AbstractController
{
    public static function getEntityFqcn(): string
    {
        return CryptoCurrency::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            // // IdField::new('id'),
            // TextField::new('name'),
            // TextEditorField::new('description'),
            // TextField::new('symbole'),
            // TextField::new('category'),
            // IntegerField::new('price'),
            // TextField::new('marketcup'),
            // IntegerField::new('nb_follow_tt')
        ];
    }
}
