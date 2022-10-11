<?php

namespace App\DataFixtures;

//Cette ligne permet de nourrir la table Categories dans la base de données.
use App\Entity\Categories;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoriesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $parent = new Categories();
        $parent->setName("Guitares");
        $manager->persist($parent);

        $category = new Categories();
        $category->setName("Basses");
        $category->setParent($parent);
        $manager->persist($category);

        $manager->flush();
    }
}
