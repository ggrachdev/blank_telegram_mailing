<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\MailingData;

class ParsingFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
//        for ($i = 0; $i < 20; $i++) {
//            $product = new MailingData();
//            $product->setName('product '.$i);
//            $product->setPrice(mt_rand(10, 100));
//            $manager->persist($product);
//        }
//
//        $manager->flush();
    }
}