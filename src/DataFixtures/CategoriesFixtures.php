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
        $parent = $this->createCategory("Guitares", null, $manager);
        $this->createCategory("Basses", $parent, $manager);
        $this->createCategory("Stratocaster", $parent, $manager);

        $manager->flush();
    }

    public function createCategory(string $name, Categories $parent = null, ObjectManager $manager)
    {
                $category = new Categories();
                $category->setName($name);
                $category->setParent($parent);
                $manager->persist($category);

                return $category;
    }
}
