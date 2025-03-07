<?php

namespace App\Controller\Admin;

use App\Entity\Pokemon;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
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
            IntegerField::new('numero'),
            TextField::new('name'),
            TextField::new('image'),
            TextEditorField::new('description')->hideOnIndex(),
            NumberField::new('size')->setLabel('Taille (en m)')->hideOnIndex(),
            NumberField::new('weight')->hideOnIndex(),
            AssociationField::new('region')->hideOnIndex(),
            AssociationField::new('category')->hideOnIndex(),
            AssociationField::new('types')->hideOnIndex(),
            AssociationField::new('weaknesses')->hideOnIndex(),
            AssociationField::new('talents')->hideOnIndex(),
            AssociationField::new('genders')->hideOnIndex(),
        ];
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('numero')
            ->add('size')
            ->add('weight')
            ->add('region')
            ->add('category')
            ->add('types')
            ->add('weaknesses')
            ->add('talents')
            ->add('genders')
        ;
    }
}
