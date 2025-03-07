<?php

namespace App\Controller\Admin;

use App\Entity\Pokemon;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PokemonCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Pokemon::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            TextField::new('image'),
            IntegerField::new('numero'),
            TextEditorField::new('description'),
            NumberField::new('size')->setLabel('Taille (en m)'),
            NumberField::new('weight'),
            AssociationField::new('region'),
            AssociationField::new('category'),
            AssociationField::new('types'),
            AssociationField::new('weaknesses'),
            AssociationField::new('talents'),
            AssociationField::new('genders'),
        ];
    }
}
