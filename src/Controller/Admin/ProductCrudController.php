<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField; 
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField; 
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField; 
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField; 

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
           TextField::new('author'),
           TextField::new('album_name'),
           MoneyField::new('price')->setCurrency('EUR'),
           TextField::new('description'),
           ImageField::new('cover')
            ->setBasePath('uploads/')
            ->setUploadDir('public/uploads/')
            ->setUploadedFileNamePattern('[randomhash].[extension]')
            ->setRequired(false),
            DateTimeField::new('release_date'),
            TextField::new('country'),
            AssociationField::new('genre')

        ];
    }
    
}
