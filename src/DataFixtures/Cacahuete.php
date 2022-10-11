<?php

namespace App\DataFixtures;

use Faker\Factory;

use App\Entity\Suppliers;

use AppBundle\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

class Cacahuete extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i=0; $i < 10; $i++) { 
            $Suppliers = new Suppliers();      
            $CompanyName = $faker->company();
            $ContactName = $faker->lastName();
            $ContactTitle = $faker->firstName();
            $Address = $faker->address();
            $City = $faker->city();
            $Region = $faker->region();
            $PostalCode = $faker->postcode();
            $Country = $faker->country();
            $Phone = $faker->phoneNumber();
            $Fax = $faker->mobileNumber();
            $HomePage = $faker->url();

            $Suppliers
                ->setCompanyName($CompanyName)
                ->setContactName($ContactName)
                ->setContactTitle($ContactTitle)
                ->setAddress($Address)
                ->setCity($City)
                ->setRegion($Region)
                ->setPostalCode($PostalCode)
                ->setCountry($Country)
                ->setPhone($Phone)
                ->setFax($Fax)
                ->setHomePage($HomePage);
        $manager->persist($Suppliers);
        }
        

        $manager->flush();
    }
}
