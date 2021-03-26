<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Users;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Factory::create();

        for ($i = 0; $i < 50; $i++) {
            $user = new Users();
            $user->setName($faker->unique()->firstName);
            $user->setSurname($faker->unique()->lastName);
            $manager->persist($user);
        }

        $manager->flush();
    }
}
