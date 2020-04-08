<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Produit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();
        $categories = [];

        for($i=0; $i < 10; $i++){

          $category = new Category();
          $category->setNom($faker->name());
          $categories[] = $category;

          $manager->persist($category);
        }

        for( $j = 0; $j < 10; $j++)
        {
          $produit = new Produit();
          $produit->setNom($faker->name());
          $produit->setPrix($faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = NULL));
          $produit->setDescription($faker->sentence());
          $produit->addCategory($categories[$j]);

          $manager->persist($produit);
        }

        $manager->flush();
    }
}
